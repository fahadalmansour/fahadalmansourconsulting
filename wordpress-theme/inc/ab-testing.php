<?php
/**
 * FSC A/B Testing System
 *
 * Simple, privacy-respecting A/B testing for WordPress
 * No external dependencies, cookie-based variant assignment
 *
 * @package FSC_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * FSC A/B Testing Class
 */
class FSC_AB_Testing {

    /**
     * Cookie name for storing variants
     */
    const COOKIE_NAME = 'fsc_ab_variants';

    /**
     * Cookie expiry (30 days)
     */
    const COOKIE_EXPIRY = 2592000;

    /**
     * Option name for storing test results
     */
    const OPTION_NAME = 'fsc_ab_test_results';

    /**
     * Active tests configuration
     */
    private static $tests = [];

    /**
     * Visitor's assigned variants
     */
    private static $visitor_variants = [];

    /**
     * Initialize A/B testing
     */
    public static function init() {
        // Load visitor variants from cookie
        self::load_visitor_variants();

        // Register shortcodes
        add_shortcode('fsc_ab_test', [__CLASS__, 'shortcode_ab_test']);
        add_shortcode('fsc_ab_variant', [__CLASS__, 'shortcode_ab_variant']);

        // Track conversions via AJAX
        add_action('wp_ajax_fsc_ab_conversion', [__CLASS__, 'track_conversion']);
        add_action('wp_ajax_nopriv_fsc_ab_conversion', [__CLASS__, 'track_conversion']);

        // Add admin menu
        add_action('admin_menu', [__CLASS__, 'add_admin_menu']);

        // Enqueue tracking script
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_scripts']);

        // Register default tests
        self::register_default_tests();

        /**
         * Allow plugins / mu-plugins to register additional A/B tests.
         * Use FSC_AB_Testing::register_test( $test_id, $config ) inside the callback.
         */
        do_action('fsc_register_ab_tests');

        // One-time migration: stop autoloading the results option (admin only).
        if (is_admin()) {
            self::maybe_disable_results_autoload();
        }
    }

    /**
     * One-time migration to flip OPTION_NAME from autoload=yes to autoload=no.
     * Runs in admin only and exits early once the flag option exists.
     */
    private static function maybe_disable_results_autoload() {
        if (get_option('fsc_ab_results_autoload_migrated')) {
            return;
        }
        // Touch the option with autoload=false. If it does not exist yet, no-op
        // (next write will use autoload=false anyway).
        $existing = get_option(self::OPTION_NAME, null);
        if (null !== $existing) {
            delete_option(self::OPTION_NAME);
            add_option(self::OPTION_NAME, $existing, '', false);
        }
        update_option('fsc_ab_results_autoload_migrated', 1, false);
    }

    /**
     * Register default A/B tests
     */
    private static function register_default_tests() {
        // Hero headline test
        self::register_test('hero_headline', [
            'name' => 'Hero Headline',
            'variants' => [
                'a' => 'Your Complete Technology Partner',
                'b' => 'Assess. Design. Deliver.',
                'c' => 'The Right Technology. Delivered.'
            ],
            'default' => 'a'
        ]);

        // CTA button text test
        self::register_test('cta_button', [
            'name' => 'CTA Button Text',
            'variants' => [
                'a' => 'Request a Consultation',
                'b' => 'Start Your Assessment',
                'c' => 'Get a Solution Designed'
            ],
            'default' => 'a'
        ]);

        // Hero subheadline test
        self::register_test('hero_subheadline', [
            'name' => 'Hero Subheadline',
            'variants' => [
                'a' => 'We bridge the gap between your business needs and the complex IT market. Assessment, solution design, and certified hardware and software — delivered ready for your environment.',
                'b' => 'From assessment to delivery, we handle every step of your technology journey. Certified products. Single accountability.',
                'c' => 'We assess your needs, design the right solution, and deliver certified hardware and software. One partner. Complete accountability.'
            ],
            'default' => 'a'
        ]);

        // Why Us section title test
        self::register_test('why_us_title', [
            'name' => 'Why Us Section Title',
            'variants' => [
                'a' => 'Why Organizations Choose Us',
                'b' => 'The FSC Difference',
                'c' => 'Why Work With Us'
            ],
            'default' => 'a'
        ]);

        // Contact CTA test
        self::register_test('contact_cta', [
            'name' => 'Contact Page CTA',
            'variants' => [
                'a' => 'Request a Free Consultation',
                'b' => 'Schedule Your Assessment Call',
                'c' => 'Let\'s Discuss Your Technology Needs'
            ],
            'default' => 'a'
        ]);
    }

    /**
     * Register a new A/B test
     */
    public static function register_test($test_id, $config) {
        self::$tests[$test_id] = wp_parse_args($config, [
            'name' => $test_id,
            'variants' => ['a' => '', 'b' => ''],
            'default' => 'a',
            'active' => true
        ]);
    }

    /**
     * Load visitor variants from cookie
     */
    private static function load_visitor_variants() {
        if (isset($_COOKIE[self::COOKIE_NAME])) {
            $raw     = wp_unslash($_COOKIE[self::COOKIE_NAME]);
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                self::$visitor_variants = $decoded;
            }
        }
    }

    /**
     * Save visitor variants to cookie.
     *
     * Lazy variant assignment may run during shortcode render, by which time
     * headers have been sent. Skip silently in that case — the visitor will be
     * reassigned on the next page load instead of triggering a PHP warning.
     */
    private static function save_visitor_variants() {
        if (headers_sent()) {
            return;
        }
        $value = wp_json_encode(self::$visitor_variants);
        setcookie(self::COOKIE_NAME, $value, [
            'expires'  => time() + self::COOKIE_EXPIRY,
            'path'     => '/',
            'domain'   => '',
            'secure'   => is_ssl(),
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
    }

    /**
     * Get variant for a test
     */
    public static function get_variant($test_id) {
        // Check if test exists
        if (!isset(self::$tests[$test_id])) {
            return null;
        }

        $test = self::$tests[$test_id];

        // Check if test is active
        if (!$test['active']) {
            return $test['default'];
        }

        // Check if visitor already has a variant
        if (isset(self::$visitor_variants[$test_id])) {
            $stored = self::$visitor_variants[$test_id];
            if (isset($test['variants'][$stored])) {
                return $stored;
            }
            // Invalid variant in cookie — fall through to reassign
        }

        // Assign random variant
        $variant_keys = array_keys($test['variants']);
        $assigned = $variant_keys[array_rand($variant_keys)];

        // Store variant
        self::$visitor_variants[$test_id] = $assigned;
        self::save_visitor_variants();

        // Track impression
        self::track_impression($test_id, $assigned);

        return $assigned;
    }

    /**
     * Get variant content
     */
    public static function get_variant_content($test_id) {
        $variant = self::get_variant($test_id);

        if ($variant && isset(self::$tests[$test_id]['variants'][$variant])) {
            return self::$tests[$test_id]['variants'][$variant];
        }

        return '';
    }

    /**
     * Track impression
     *
     * NOTE: get → mutate → update_option is non-atomic. Concurrent first-time
     * variant assignments may drop a small number of impression increments.
     * Acceptable for the current low-traffic context; if a higher-precision
     * counter is ever needed, switch to a custom table with INSERT … ON
     * DUPLICATE KEY UPDATE or to wp_cache_incr() with a periodic flush.
     */
    private static function track_impression($test_id, $variant) {
        $results = get_option(self::OPTION_NAME, []);

        if (!isset($results[$test_id])) {
            $results[$test_id] = [];
        }

        if (!isset($results[$test_id][$variant])) {
            $results[$test_id][$variant] = [
                'impressions' => 0,
                'conversions' => 0
            ];
        }

        $results[$test_id][$variant]['impressions']++;

        update_option(self::OPTION_NAME, $results, false);
    }

    /**
     * Track conversion via AJAX
     *
     * Anonymous-callable. Defends against abuse with: registered-test
     * allowlist, per-session dedupe cookie, and per-IP transient rate limit.
     */
    public static function track_conversion() {
        check_ajax_referer('fsc_ab_nonce', 'nonce');

        $raw_test_id = isset($_POST['test_id']) ? wp_unslash($_POST['test_id']) : '';
        $test_id     = sanitize_key($raw_test_id);

        // Reject anything that is not a registered, currently-loaded test.
        if ('' === $test_id || !isset(self::$tests[$test_id])) {
            wp_send_json_error('invalid_test', 400);
        }
        if (!isset(self::$visitor_variants[$test_id])) {
            wp_send_json_error('no_variant_assigned', 400);
        }

        // Per-session dedupe: if we have already counted a conversion for this
        // test on this device, return success without writing.
        $session_cookie = 'fsc_ab_conv_' . $test_id;
        if (isset($_COOKIE[$session_cookie])) {
            wp_send_json_success(['duplicate' => true]);
        }

        // Per-IP rate limit (5 conversions / minute / IP).
        $ip = isset($_SERVER['REMOTE_ADDR'])
            ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR']))
            : '';
        if ('' !== $ip) {
            $rate_key   = 'fsc_ab_rl_' . md5($ip);
            $rate_count = (int) get_transient($rate_key);
            if ($rate_count >= 5) {
                wp_send_json_error('rate_limited', 429);
            }
            set_transient($rate_key, $rate_count + 1, MINUTE_IN_SECONDS);
        }

        $variant = self::$visitor_variants[$test_id];
        $results = get_option(self::OPTION_NAME, []);

        if (isset($results[$test_id][$variant])) {
            $results[$test_id][$variant]['conversions']++;
            update_option(self::OPTION_NAME, $results, false);
        }

        // Set the dedupe cookie last so we only mark conversions we actually counted.
        if (!headers_sent()) {
            setcookie($session_cookie, '1', [
                'expires'  => time() + DAY_IN_SECONDS,
                'path'     => '/',
                'domain'   => '',
                'secure'   => is_ssl(),
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
        }

        wp_send_json_success();
    }

    /**
     * Shortcode: [fsc_ab_test test="hero_headline"]
     */
    public static function shortcode_ab_test($atts) {
        $atts = shortcode_atts([
            'test' => '',
            'class' => '',
            'tag' => 'span'
        ], $atts);

        if (!$atts['test']) {
            return '';
        }

        $content = self::get_variant_content($atts['test']);
        $variant = self::get_variant($atts['test']);

        $class = $atts['class'] ? ' class="' . esc_attr($atts['class']) . '"' : '';
        $data = ' data-ab-test="' . esc_attr($atts['test']) . '" data-ab-variant="' . esc_attr($variant) . '"';

        return '<' . esc_attr($atts['tag']) . $class . $data . '>' . esc_html($content) . '</' . esc_attr($atts['tag']) . '>';
    }

    /**
     * Shortcode: [fsc_ab_variant test="hero_headline" variant="a"]Content[/fsc_ab_variant]
     */
    public static function shortcode_ab_variant($atts, $content = null) {
        $atts = shortcode_atts([
            'test' => '',
            'variant' => ''
        ], $atts);

        if (!$atts['test'] || !$atts['variant']) {
            return '';
        }

        $current_variant = self::get_variant($atts['test']);

        if ($current_variant === $atts['variant']) {
            return do_shortcode($content);
        }

        return '';
    }

    /**
     * Enqueue tracking scripts
     */
    public static function enqueue_scripts() {
        wp_enqueue_script(
            'fsc-ab-tracking',
            get_template_directory_uri() . '/js/ab-tracking.js',
            [],
            '1.0.0',
            true
        );

        wp_localize_script('fsc-ab-tracking', 'fscAB', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('fsc_ab_nonce'),
            'variants' => self::$visitor_variants
        ]);
    }

    /**
     * Add admin menu
     */
    public static function add_admin_menu() {
        add_submenu_page(
            'themes.php',
            'A/B Testing',
            'A/B Testing',
            'manage_options',
            'fsc-ab-testing',
            [__CLASS__, 'admin_page']
        );
    }

    /**
     * Admin page
     */
    public static function admin_page() {
        // Handle reset
        if (isset($_POST['fsc_reset_ab']) && check_admin_referer('fsc_reset_ab_nonce')) {
            delete_option(self::OPTION_NAME);
            echo '<div class="notice notice-success"><p>A/B test results have been reset.</p></div>';
        }

        $results = get_option(self::OPTION_NAME, []);
        ?>
        <div class="wrap">
            <h1>FSC A/B Testing Dashboard</h1>

            <div class="card" style="max-width: 100%; margin-top: 20px;">
                <h2>Active Tests</h2>

                <?php if (empty(self::$tests)) : ?>
                    <p>No A/B tests configured.</p>
                <?php else : ?>
                    <table class="widefat striped" style="margin-top: 15px;">
                        <thead>
                            <tr>
                                <th>Test Name</th>
                                <th>Variant</th>
                                <th>Content</th>
                                <th>Impressions</th>
                                <th>Conversions</th>
                                <th>Conv. Rate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (self::$tests as $test_id => $test) : ?>
                                <?php
                                $first = true;
                                $row_count = count($test['variants']);
                                foreach ($test['variants'] as $variant_key => $variant_content) :
                                    $impressions = isset($results[$test_id][$variant_key]['impressions'])
                                        ? $results[$test_id][$variant_key]['impressions'] : 0;
                                    $conversions = isset($results[$test_id][$variant_key]['conversions'])
                                        ? $results[$test_id][$variant_key]['conversions'] : 0;
                                    $rate = $impressions > 0 ? round(($conversions / $impressions) * 100, 2) : 0;
                                ?>
                                <tr>
                                    <?php if ($first) : ?>
                                        <td rowspan="<?php echo $row_count; ?>" style="vertical-align: middle;">
                                            <strong><?php echo esc_html($test['name']); ?></strong><br>
                                            <code style="font-size: 11px;"><?php echo esc_html($test_id); ?></code>
                                        </td>
                                    <?php endif; ?>
                                    <td>
                                        <span style="background: <?php echo $variant_key === $test['default'] ? '#d1fae5' : '#e5e7eb'; ?>; padding: 2px 8px; border-radius: 4px; font-weight: 600;">
                                            <?php echo strtoupper(esc_html($variant_key)); ?>
                                        </span>
                                        <?php if ($variant_key === $test['default']) : ?>
                                            <span style="color: #059669; font-size: 11px;">(default)</span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo esc_html(substr($variant_content, 0, 60)); ?>
                                        <?php if (strlen($variant_content) > 60) echo '...'; ?>
                                    </td>
                                    <td style="text-align: center;"><?php echo number_format($impressions); ?></td>
                                    <td style="text-align: center;"><?php echo number_format($conversions); ?></td>
                                    <td style="text-align: center;">
                                        <span style="background: <?php echo $rate > 5 ? '#d1fae5' : ($rate > 2 ? '#fef3c7' : '#fee2e2'); ?>; padding: 2px 8px; border-radius: 4px;">
                                            <?php echo $rate; ?>%
                                        </span>
                                    </td>
                                </tr>
                                <?php
                                $first = false;
                                endforeach;
                                ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <div class="card" style="max-width: 600px; margin-top: 20px;">
                <h2>Usage</h2>
                <p>Use these shortcodes in your pages:</p>

                <h4>Display variant content automatically:</h4>
                <pre style="background: #f1f5f9; padding: 10px; border-radius: 4px;">[fsc_ab_test test="hero_headline"]</pre>

                <h4>Show different content per variant:</h4>
                <pre style="background: #f1f5f9; padding: 10px; border-radius: 4px;">[fsc_ab_variant test="hero_headline" variant="a"]
    Content for variant A
[/fsc_ab_variant]

[fsc_ab_variant test="hero_headline" variant="b"]
    Content for variant B
[/fsc_ab_variant]</pre>

                <h4>Track conversions:</h4>
                <pre style="background: #f1f5f9; padding: 10px; border-radius: 4px;">&lt;button onclick="fscTrackConversion('hero_headline')"&gt;
    Book Consultation
&lt;/button&gt;</pre>
            </div>

            <div class="card" style="max-width: 600px; margin-top: 20px;">
                <h2>Reset Data</h2>
                <p>Clear all A/B test results and start fresh.</p>
                <form method="post">
                    <?php wp_nonce_field('fsc_reset_ab_nonce'); ?>
                    <button type="submit" name="fsc_reset_ab" class="button button-secondary"
                            onclick="return confirm('Are you sure? This will delete all test data.');">
                        Reset All Test Data
                    </button>
                </form>
            </div>
        </div>
        <?php
    }

    /**
     * Get all tests (for external use)
     */
    public static function get_tests() {
        return self::$tests;
    }

    /**
     * Check if a test exists
     */
    public static function test_exists($test_id) {
        return isset(self::$tests[$test_id]);
    }
}

// Initialize A/B Testing
add_action('init', ['FSC_AB_Testing', 'init']);

/**
 * Helper functions for template use
 */

/**
 * Get A/B test variant content
 */
function fsc_ab($test_id) {
    return FSC_AB_Testing::get_variant_content($test_id);
}

/**
 * Get current variant key
 */
function fsc_ab_variant($test_id) {
    return FSC_AB_Testing::get_variant($test_id);
}

/**
 * Echo A/B test variant content
 */
function fsc_ab_e($test_id) {
    echo esc_html(FSC_AB_Testing::get_variant_content($test_id));
}
