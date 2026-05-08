<?php
/**
 * Fahad Almansour Consulting - Theme Functions & Shortcodes
 *
 * @package FSC_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/* ============================================
   LANGUAGE SWITCHING SYSTEM (No Plugin Required)
   ============================================ */

/**
 * Get current language from cookie or URL parameter
 */
function fsc_get_current_language() {
    // Check URL parameter first (for switching)
    if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar', 'en'])) {
        $lang = sanitize_text_field($_GET['lang']);
        // Set cookie for 30 days
        setcookie('fsc_language', $lang, [
            'expires'  => time() + (30 * 24 * 60 * 60),
            'path'     => '/',
            'domain'   => '',
            'secure'   => is_ssl(),
            'httponly'  => true,
            'samesite' => 'Lax',
        ]);
        return $lang;
    }

    // Check cookie
    if (isset($_COOKIE['fsc_language']) && in_array($_COOKIE['fsc_language'], ['ar', 'en'])) {
        return sanitize_text_field($_COOKIE['fsc_language']);
    }

    // Default to Arabic
    return 'ar';
}

/**
 * Switch WordPress locale based on language preference
 */
function fsc_switch_locale($locale) {
    // Don't switch in admin
    if (is_admin()) {
        return $locale;
    }

    $lang = fsc_get_current_language();

    if ($lang === 'ar') {
        return 'ar';
    }

    return 'en_US';
}
add_filter('locale', 'fsc_switch_locale', 1);

/**
 * Fix text direction for English locale
 * WP_Locale is constructed before theme loads, so is_rtl() reflects
 * the site default (Arabic). We override it after theme setup.
 */
function fsc_fix_text_direction() {
    if (fsc_get_current_language() === 'en') {
        global $wp_locale;
        if (isset($wp_locale)) {
            $wp_locale->text_direction = 'ltr';
        }
    }
}
add_action('after_setup_theme', 'fsc_fix_text_direction', 99);

/**
 * Check if site is in Arabic mode
 */
function fsc_is_arabic() {
    return fsc_get_current_language() === 'ar';
}

/**
 * Add language parameter to URLs for language switching
 */
function fsc_language_switcher_url($lang) {
    $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    // Remove existing lang parameter
    $current_url = remove_query_arg('lang', $current_url);

    // Add new lang parameter
    return add_query_arg('lang', $lang, $current_url);
}

/**
 * Theme Setup
 */
function fsc_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', [
        'height'      => 60,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ]);
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Elementor compatibility
    add_theme_support('elementor');

    // Register navigation menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'fsc'),
        'footer'  => __('Footer Menu', 'fsc'),
    ]);

    // Load text domain for translations
    load_theme_textdomain('fsc', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'fsc_setup');

/**
 * Enqueue Scripts & Styles
 */
function fsc_enqueue_scripts() {
    // Main stylesheet
    wp_enqueue_style(
        'fsc-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_style(
        'fsc-animations',
        get_template_directory_uri() . '/assets/css/animations.css',
        [],
        '1.0.0'
    );

    // Navigation script
    wp_enqueue_script(
        'fsc-navigation',
        get_template_directory_uri() . '/js/navigation.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    // Cookie consent script
    wp_enqueue_script(
        'fsc-cookie-consent',
        get_template_directory_uri() . '/js/cookie-consent.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );

    // Form tools script (copy, print, PDF)
    wp_enqueue_script(
        'fsc-form-tools',
        get_template_directory_uri() . '/js/form-tools.js',
        [],
        wp_get_theme()->get('Version'),
        true
    );
}
add_action('wp_enqueue_scripts', 'fsc_enqueue_scripts');

/**
 * Body Classes
 */
function fsc_body_classes($classes) {
    if (is_rtl()) {
        $classes[] = 'rtl';
    }

    // Elementor page detection for CSS scoping
    if (function_exists('fsc_is_elementor_page') && fsc_is_elementor_page()) {
        $classes[] = 'fsc-elementor-page';
    } else {
        $classes[] = 'fsc-native-page';
    }

    return $classes;
}
add_filter('body_class', 'fsc_body_classes');

/**
 * Register Widget Areas
 */
function fsc_widgets_init() {
    register_sidebar([
        'name'          => __('Blog Sidebar', 'fsc'),
        'id'            => 'blog-sidebar',
        'description'   => __('Widgets in this area will appear on blog pages.', 'fsc'),
        'before_widget' => '<div id="%1$s" class="widget %2$s bg-white border border-slate-200 rounded-xl p-6 mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-lg font-medium text-slate-900 mb-4">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('Footer Widgets', 'fsc'),
        'id'            => 'footer-widgets',
        'description'   => __('Widgets in this area will appear in the footer.', 'fsc'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title font-medium text-slate-900 mb-4">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'fsc_widgets_init');

/**
 * Helper: SVG Icons
 */
function fsc_get_icon($name) {
    $icons = [
        'arrow-right' => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
        'arrow-left'  => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>',
        'check'       => '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
        'mail'        => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
    ];
    return isset($icons[$name]) ? $icons[$name] : '';
}

/* ============================================
   SHORTCODES: Homepage Sections
   ============================================ */

/**
 * Load Shortcodes from external file
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Load A/B Testing functionality
 */
require get_template_directory() . '/inc/ab-testing.php';

/**
 * Load Elementor compatibility layer
 */
require get_template_directory() . '/inc/elementor-compat.php';

/* ============================================
   SOCIAL MEDIA SETTINGS & SHORTCODE
   ============================================ */

/**
 * Register Social Media Customizer Settings
 */
function fsc_customize_social($wp_customize) {
    // Section: Social Media
    $wp_customize->add_section('fsc_social_section', [
        'title'       => __('Social Media Links', 'fsc'),
        'description' => __('Add your social media profile URLs here.', 'fsc'),
        'priority'    => 121,
    ]);

    // LinkedIn
    $wp_customize->add_setting('fsc_linkedin', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('fsc_linkedin', [
        'type'     => 'url',
        'label'    => __('LinkedIn URL', 'fsc'),
        'section'  => 'fsc_social_section',
    ]);

    // Twitter / X
    $wp_customize->add_setting('fsc_twitter', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('fsc_twitter', [
        'type'     => 'url',
        'label'    => __('Twitter / X URL', 'fsc'),
        'section'  => 'fsc_social_section',
    ]);

    // YouTube
    $wp_customize->add_setting('fsc_youtube', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('fsc_youtube', [
        'type'     => 'url',
        'label'    => __('YouTube URL', 'fsc'),
        'section'  => 'fsc_social_section',
    ]);
}
add_action('customize_register', 'fsc_customize_social');

/* ============================================
   CUSTOMIZER & TRACKING SCRIPTS
   ============================================ */

/**
 * Register Customizer Settings for Tracking
 */
function fsc_customize_register($wp_customize) {
    // Section: Tracking & Scripts
    $wp_customize->add_section('fsc_tracking_section', [
        'title'       => __('Tracking & Scripts', 'fsc'),
        'description' => __('Add tracking IDs. These will normally be loaded via the Cookie Consent banner for compliance.', 'fsc'),
        'priority'    => 120,
    ]);

    // 1. Google Analytics ID
    $wp_customize->add_setting('fsc_ga_id', ['sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('fsc_ga_id', [
        'type'     => 'text',
        'label'    => __('Google Analytics ID (G-XXXXXXXXXX)', 'fsc'),
        'section'  => 'fsc_tracking_section',
    ]);

    // 2. Google Tag Manager ID
    $wp_customize->add_setting('fsc_gtm_id', ['sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('fsc_gtm_id', [
        'type'     => 'text',
        'label'    => __('Google Tag Manager ID (GTM-XXXXXXX)', 'fsc'),
        'section'  => 'fsc_tracking_section',
    ]);

    // 3. Meta Pixel ID (New)
    $wp_customize->add_setting('fsc_pixel_id', ['sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('fsc_pixel_id', [
        'type'     => 'text',
        'label'    => __('Meta Pixel ID (1234567890)', 'fsc'),
        'section'  => 'fsc_tracking_section',
    ]);

    // 4. Custom Head Scripts (Always loaded)
    $wp_customize->add_setting('fsc_header_scripts', ['sanitize_callback' => 'fsc_sanitize_scripts']);
    $wp_customize->add_control('fsc_header_scripts', [
        'type'     => 'textarea',
        'label'    => __('Custom Header Scripts (Always Loaded)', 'fsc'),
        'description' => __('Scripts essential for the site (e.g., verification tags). NOT for tracking.', 'fsc'),
        'section'  => 'fsc_tracking_section',
    ]);
}
add_action('customize_register', 'fsc_customize_register');

/**
 * Sanitize Scripts
 */
function fsc_sanitize_scripts($input) {
    return wp_kses($input, [
        'script'   => ['src' => [], 'async' => [], 'defer' => [], 'type' => [], 'id' => [], 'nonce' => []],
        'noscript' => [],
        'style'    => ['type' => []],
    ]);
}

/**
 * Pass IDs to JavaScript (for Cookie Consent)
 */
function fsc_localize_tracking_scripts() {
    $data = [
        'ga_id'    => get_theme_mod('fsc_ga_id'),
        'gtm_id'   => get_theme_mod('fsc_gtm_id'),
        'pixel_id' => get_theme_mod('fsc_pixel_id'),
    ];
    wp_localize_script('fsc-cookie-consent', 'fscParams', $data);
}
add_action('wp_enqueue_scripts', 'fsc_localize_tracking_scripts', 20);

/**
 * Output Essential Scripts only
 */
function fsc_essential_scripts_head() {
    $header_scripts = get_theme_mod('fsc_header_scripts');
    if ($header_scripts) {
        echo $header_scripts . "\n";
    }
}
add_action('wp_head', 'fsc_essential_scripts_head', 1);

/* ============================================
   SEO OPTIMIZATION - AI RECOMMENDED
   ============================================ */

/**
 * SEO: Custom Title Tag Optimization
 */
function fsc_seo_title($title) {
    $is_rtl = is_rtl();
    $brand = 'Fahad Almansour Consulting';

    if (is_front_page()) {
        return $is_rtl
            ? 'فهد المنصور للاستشارات | شريكك التقني المتكامل | تقييم وتصميم وتوريد | السعودية'
            : 'Fahad Almansour Consulting | Your Complete Technology Partner | Assessment, Design & Delivery | Saudi Arabia';
    }

    if (is_page('contact')) {
        return $is_rtl
            ? 'تواصل معنا | استشارة مجانية | فهد المنصور للاستشارات'
            : 'Contact Us | Free IT Consultation | Fahad Almansour Consulting';
    }

    if (is_page('services')) {
        return $is_rtl
            ? 'خدماتنا | السحابة، التحول الرقمي، الأمن السيبراني | FSC'
            : 'IT Consulting Services | Cloud Strategy, Digital Transformation, Cybersecurity | FSC';
    }

    if (is_page('about')) {
        return $is_rtl
            ? 'من نحن | شريكك التقني المتكامل في الرياض | FSC'
            : 'About Us | Complete Technology Partner in Riyadh | Fahad Almansour Consulting';
    }

    return $title;
}
add_filter('pre_get_document_title', 'fsc_seo_title', 10);

/**
 * SEO: Meta Description & Open Graph Tags
 */
function fsc_seo_meta_tags() {
    $is_rtl = is_rtl();
    $site_url = home_url('/');
    $logo_url = get_template_directory_uri() . '/assets/brand/social-square.svg';

    // Default meta descriptions
    $meta_desc_en = 'FSC is your complete technology partner in Riyadh. We assess your needs, design solutions, and supply certified hardware and software. One partner, one accountability.';
    $meta_desc_ar = 'FSC شريكك التقني المتكامل في الرياض. نقيّم احتياجاتك، نصمم الحلول، ونوفر الأجهزة والبرامج المعتمدة. شريك واحد، مسؤولية واحدة.';

    $meta_keywords_en = 'IT consulting Saudi Arabia, cloud consulting Riyadh, digital transformation, cybersecurity consulting, IT strategy, cloud migration, enterprise technology, IT advisory, technology consulting GCC, Saudi Arabia IT consultant';
    $meta_keywords_ar = 'استشارات تقنية المعلومات، استشارات السحابة، التحول الرقمي، استشارات الأمن السيبراني، استراتيجية تقنية المعلومات، الترحيل السحابي، تقنية المؤسسات، مستشار تقنية المعلومات';

    // Page-specific descriptions
    if (is_page('contact')) {
        $meta_desc_en = 'Schedule a free discovery call with Fahad Almansour Consulting. Get expert IT consulting advice on cloud strategy, digital transformation, and cybersecurity. Response within 1 business day.';
        $meta_desc_ar = 'احجز مكالمة استكشافية مجانية مع فهد المنصور للاستشارات. احصل على استشارات تقنية متخصصة في استراتيجية السحابة والتحول الرقمي والأمن السيبراني. رد خلال يوم عمل واحد.';
    } elseif (is_page('services')) {
        $meta_desc_en = 'End-to-end technology solutions: assessments, cloud strategy, security, ISO compliance, and certified hardware and software procurement. Assessment to delivery.';
        $meta_desc_ar = 'حلول تقنية متكاملة: تقييمات، استراتيجية سحابية، أمن، امتثال ISO، وتوريد أجهزة وبرامج معتمدة. من التقييم حتى التسليم.';
    } elseif (is_page('about')) {
        $meta_desc_en = 'Fahad Almansour Consulting is your complete technology partner. We assess, design, and deliver certified hardware and software. 15+ years experience. Riyadh, Saudi Arabia. CR: 7053130576.';
        $meta_desc_ar = 'فهد المنصور للاستشارات شريكك التقني المتكامل. نقيّم ونصمم ونسلّم الأجهزة والبرامج المعتمدة. أكثر من 15 عاماً خبرة. الرياض، المملكة العربية السعودية. سجل تجاري: 7053130576.';
    }

    $meta_desc = $is_rtl ? $meta_desc_ar : $meta_desc_en;
    $meta_keywords = $is_rtl ? $meta_keywords_ar : $meta_keywords_en;
    $current_url = (is_ssl() ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $og_title = wp_get_document_title();

    ?>
    <!-- SEO Meta Tags - AI Optimized -->
    <meta name="description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta name="keywords" content="<?php echo esc_attr($meta_keywords); ?>">
    <meta name="author" content="Fahad Almansour Consulting">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <link rel="canonical" href="<?php echo esc_url($current_url); ?>">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo esc_url($current_url); ?>">
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta property="og:image" content="<?php echo esc_url($logo_url); ?>">
    <meta property="og:image:width" content="512">
    <meta property="og:image:height" content="512">
    <meta property="og:site_name" content="Fahad Almansour Consulting">
    <meta property="og:locale" content="<?php echo $is_rtl ? 'ar_SA' : 'en_US'; ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="<?php echo esc_url($current_url); ?>">
    <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($meta_desc); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($logo_url); ?>">

    <!-- Geo Tags - Riyadh, Saudi Arabia -->
    <meta name="geo.region" content="SA-01">
    <meta name="geo.placename" content="<?php echo $is_rtl ? 'الرياض، المملكة العربية السعودية' : 'Riyadh, Saudi Arabia'; ?>">
    <meta name="geo.position" content="24.7136;46.6753">
    <meta name="ICBM" content="24.7136, 46.6753">

    <!-- Language Alternates - Arabic First -->
    <link rel="alternate" hreflang="ar" href="<?php echo esc_url($site_url . '?lang=ar'); ?>">
    <link rel="alternate" hreflang="en" href="<?php echo esc_url($site_url . '?lang=en'); ?>">
    <link rel="alternate" hreflang="x-default" href="<?php echo esc_url($site_url . '?lang=ar'); ?>">
    <?php
}
add_action('wp_head', 'fsc_seo_meta_tags', 2);

/**
 * SEO: Schema.org Structured Data (JSON-LD)
 */
function fsc_schema_markup() {
    $is_rtl = is_rtl();
    $site_url = home_url('/');
    $logo_url = get_template_directory_uri() . '/assets/brand/social-square.svg';

    // Organization Schema
    $organization_schema = [
        '@context' => 'https://schema.org',
        '@type' => 'ProfessionalService',
        '@id' => $site_url . '#organization',
        'name' => 'Fahad Almansour Consulting',
        'alternateName' => $is_rtl ? 'FSC' : 'فهد المنصور للاستشارات',
        'url' => $site_url,
        'logo' => [
            '@type' => 'ImageObject',
            'url' => $logo_url,
            'width' => 400,
            'height' => 400
        ],
        'image' => $logo_url,
        'description' => $is_rtl
            ? 'شريكك التقني المتكامل — نقيّم احتياجاتك، نصمم الحلول، ونوفر الأجهزة والبرامج المعتمدة مباشرة. شريك واحد، مسؤولية واحدة.'
            : 'Your complete technology partner — we assess your needs, design solutions, and supply certified hardware and software directly. One partner, one accountability.',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'RRMA8094', // Saudi National Address
            'addressLocality' => $is_rtl ? 'الرياض' : 'Riyadh',
            'addressRegion' => 'Riyadh',
            'postalCode' => 'RRMA8094',
            'addressCountry' => 'SA'
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => 24.7136,
            'longitude' => 46.6753
        ],
        'telephone' => '+966-57-013-1122',
        'email' => 'info@fahadalmansourconsulting.com',
        'foundingDate' => '2020',
        'areaServed' => [
            ['@type' => 'Country', 'name' => $is_rtl ? 'المملكة العربية السعودية' : 'Saudi Arabia'],
            ['@type' => 'Country', 'name' => $is_rtl ? 'الإمارات العربية المتحدة' : 'United Arab Emirates'],
            ['@type' => 'Country', 'name' => $is_rtl ? 'الكويت' : 'Kuwait'],
            ['@type' => 'Country', 'name' => $is_rtl ? 'البحرين' : 'Bahrain'],
            ['@type' => 'Country', 'name' => $is_rtl ? 'قطر' : 'Qatar'],
            ['@type' => 'Country', 'name' => $is_rtl ? 'عُمان' : 'Oman'],
            ['@type' => 'GeoShape', 'name' => $is_rtl ? 'دول مجلس التعاون الخليجي' : 'GCC Countries']
        ],
        'serviceType' => [
            'IT Consulting',
            'Cloud Strategy Consulting',
            'Technology Assessment',
            'Cybersecurity Consulting',
            'Hardware Procurement',
            'Software Licensing',
            'IT Solutions Delivery',
            'ISO Compliance Consulting'
        ],
        'priceRange' => '$$$$',
        'paymentAccepted' => $is_rtl
            ? ['تحويل بنكي', 'حوالة مصرفية']
            : ['Bank Transfer', 'Wire Transfer'],
        'currenciesAccepted' => ['SAR', 'USD', 'AED'],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'],
                'opens' => '09:00',
                'closes' => '17:00'
            ]
        ],
        'sameAs' => array_filter([
            get_theme_mod('fsc_linkedin'),
            get_theme_mod('fsc_twitter'),
            get_theme_mod('fsc_youtube')
        ]),
        'knowsAbout' => [
            'Cloud Computing',
            'AWS',
            'Microsoft Azure',
            'Google Cloud Platform',
            'Digital Transformation',
            'Cybersecurity',
            'IT Strategy',
            'Enterprise Architecture',
            'Vendor Management',
            'IT Governance'
        ],
        'slogan' => $is_rtl
            ? 'شريكك التقني المتكامل — من التقييم حتى التسليم'
            : 'Your Complete Technology Partner — Assessment to Delivery'
    ];

    // WebSite Schema
    $website_schema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => $site_url . '#website',
        'url' => $site_url,
        'name' => 'Fahad Almansour Consulting',
        'description' => $is_rtl
            ? 'شريكك التقني المتكامل — تقييم وتصميم وتوريد حلول تقنية معتمدة'
            : 'Your Complete Technology Partner — Assessment, Design & Certified Technology Delivery',
        'publisher' => [
            '@id' => $site_url . '#organization'
        ],
        'inLanguage' => $is_rtl ? 'ar-SA' : 'en-US',
        'potentialAction' => [
            '@type' => 'SearchAction',
            'target' => $site_url . '?s={search_term_string}',
            'query-input' => 'required name=search_term_string'
        ]
    ];

    // Page-specific schemas
    $page_schema = null;

    if (is_front_page()) {
        // Homepage: Add WebPage schema
        $page_schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            '@id' => $site_url . '#webpage',
            'url' => $site_url,
            'name' => $is_rtl ? 'فهد المنصور للاستشارات | استشارات تقنية المعلومات' : 'Fahad Almansour Consulting | IT Consulting Services',
            'isPartOf' => ['@id' => $site_url . '#website'],
            'about' => ['@id' => $site_url . '#organization'],
            'description' => $is_rtl
                ? 'خدمات استشارات تقنية المعلومات المتخصصة: استراتيجية السحابة، التحول الرقمي، الأمن السيبراني'
                : 'Expert IT consulting services: cloud strategy, digital transformation, cybersecurity consulting',
            'inLanguage' => $is_rtl ? 'ar-SA' : 'en-US'
        ];
    } elseif (is_page('contact')) {
        // Contact page: Add ContactPage schema
        $page_schema = [
            '@context' => 'https://schema.org',
            '@type' => 'ContactPage',
            '@id' => home_url('/contact/') . '#contactpage',
            'url' => home_url('/contact/'),
            'name' => $is_rtl ? 'تواصل معنا' : 'Contact Us',
            'isPartOf' => ['@id' => $site_url . '#website'],
            'about' => ['@id' => $site_url . '#organization'],
            'description' => $is_rtl
                ? 'تواصل مع فهد المنصور للاستشارات للحصول على استشارة مجانية'
                : 'Contact Fahad Almansour Consulting for a free IT consultation',
            'mainEntity' => ['@id' => $site_url . '#organization']
        ];
    } elseif (is_page('services')) {
        // Services page: Add Service schema
        $page_schema = [
            '@context' => 'https://schema.org',
            '@type' => 'ItemList',
            '@id' => home_url('/services/') . '#services',
            'name' => $is_rtl ? 'خدماتنا' : 'Our Services',
            'description' => $is_rtl
                ? 'خدمات استشارات تقنية المعلومات الشاملة'
                : 'Comprehensive IT consulting services',
            'numberOfItems' => 4,
            'itemListElement' => [
                [
                    '@type' => 'Service',
                    'position' => 1,
                    'name' => $is_rtl ? 'السحابة والبنية التحتية' : 'Cloud & Infrastructure',
                    'description' => $is_rtl
                        ? 'تقييم البنية التحتية، تصميم الحلول السحابية، وتوريد الأجهزة والبرامج'
                        : 'Infrastructure assessment, cloud solution design, and hardware/software procurement',
                    'provider' => ['@id' => $site_url . '#organization']
                ],
                [
                    '@type' => 'Service',
                    'position' => 2,
                    'name' => $is_rtl ? 'الأمن والامتثال' : 'Security & Compliance',
                    'description' => $is_rtl
                        ? 'تقييمات أمنية، تحليل فجوات ISO، وحلول أمنية معتمدة'
                        : 'Security assessments, ISO gap analysis, and certified security solutions',
                    'provider' => ['@id' => $site_url . '#organization']
                ],
                [
                    '@type' => 'Service',
                    'position' => 3,
                    'name' => $is_rtl ? 'الحضور الرقمي' : 'Digital Presence',
                    'description' => $is_rtl
                        ? 'النطاقات، الاستضافة، منصات التجارة الإلكترونية، والأدوات الرقمية'
                        : 'Domains, hosting, e-commerce platforms, and digital tools',
                    'provider' => ['@id' => $site_url . '#organization']
                ],
                [
                    '@type' => 'Service',
                    'position' => 4,
                    'name' => $is_rtl ? 'الأجهزة والبرامج' : 'Hardware & Software',
                    'description' => $is_rtl
                        ? 'توريد شامل لمنتجات تقنية معتمدة مصممة وفق متطلباتك'
                        : 'End-to-end procurement of certified technology products tailored to your requirements',
                    'provider' => ['@id' => $site_url . '#organization']
                ]
            ]
        ];
    }

    // FAQ Schema for homepage
    $faq_schema = null;
    if (is_front_page()) {
        $faq_schema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => $is_rtl ? 'ما هي خدمات فهد المنصور للاستشارات؟' : 'What services does Fahad Almansour Consulting provide?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $is_rtl
                            ? 'نقدم استشارات تقنية المعلومات بما في ذلك استراتيجية السحابة والتحول الرقمي والأمن السيبراني واستراتيجية تقنية المعلومات.'
                            : 'We provide IT consulting services including cloud strategy, digital transformation, cybersecurity consulting, and IT strategy advisory.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => $is_rtl ? 'كيف أبدأ مع فهد المنصور للاستشارات؟' : 'How do I get started with Fahad Almansour Consulting?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $is_rtl
                            ? 'ابدأ بطلب مكالمة استكشافية مجانية مدتها 15-30 دقيقة. سنفهم تحدياتك ونحدد إذا كنا مناسبين لك.'
                            : 'Start by requesting a free 15-30 minute discovery call. We will understand your challenges and determine if we are a good fit for your needs.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => $is_rtl ? 'ما هي مناطق خدمتكم؟' : 'What areas do you serve?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $is_rtl
                            ? 'مقرنا في الرياض، المملكة العربية السعودية، ونخدم عملاء في السعودية ودول الخليج ودولياً.'
                            : 'We are based in Riyadh, Saudi Arabia and serve clients in Saudi Arabia, the GCC region, and internationally.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => $is_rtl ? 'ماذا يعني "شريك تقني متكامل"؟' : 'What does "complete technology partner" mean?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => $is_rtl
                            ? 'نتولى الرحلة بأكملها — من تقييم احتياجاتك، إلى تصميم الحل الأمثل، إلى توريد وتسليم الأجهزة والبرامج المعتمدة. شريك واحد بدلاً من التعامل مع عدة موردين.'
                            : 'We handle the entire journey — from assessing your business needs, to designing the right solution, to procuring and delivering certified hardware and software. One partner instead of juggling multiple vendors.'
                    ]
                ]
            ]
        ];
    }

    // Output JSON-LD
    echo "\n<!-- Schema.org Structured Data - AI Optimized for SEO -->\n";
    echo '<script type="application/ld+json">' . wp_json_encode($organization_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
    echo '<script type="application/ld+json">' . wp_json_encode($website_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";

    if ($page_schema) {
        echo '<script type="application/ld+json">' . wp_json_encode($page_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }

    if ($faq_schema) {
        echo '<script type="application/ld+json">' . wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . '</script>' . "\n";
    }
}
add_action('wp_head', 'fsc_schema_markup', 3);

/**
 * SEO: Breadcrumb Schema
 */
function fsc_breadcrumb_schema() {
    if (is_front_page()) return;

    $is_rtl = is_rtl();
    $site_url = home_url('/');
    $breadcrumbs = [
        [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => $is_rtl ? 'الرئيسية' : 'Home',
            'item' => $site_url
        ]
    ];

    $position = 2;

    if (is_page()) {
        $page_title = get_the_title();
        $page_url = get_permalink();
        $breadcrumbs[] = [
            '@type' => 'ListItem',
            'position' => $position,
            'name' => $page_title,
            'item' => $page_url
        ];
    }

    $breadcrumb_schema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumbs
    ];

    echo '<script type="application/ld+json">' . wp_json_encode($breadcrumb_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'fsc_breadcrumb_schema', 4);

/**
 * SEO: Preload Critical Resources
 */
function fsc_preload_resources() {
    ?>
    <!-- Preload Critical Resources -->
    <link rel="preload" as="style" href="<?php echo get_stylesheet_uri(); ?>">
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/inter/v18/UcCO3FwrK3iLTeHuS_nVMrMxCp50SjIw2boKoduKmMEVuLyfAZ9hjp-Ek-_0.woff2" crossorigin>
    <?php if (is_rtl()): ?>
    <link rel="preload" as="font" type="font/woff2" href="https://fonts.gstatic.com/s/tajawal/v9/Iura6YBj_oCad4k1nzSBC45I.woff2" crossorigin>
    <?php endif; ?>

    <!-- DNS Prefetch for Performance -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <?php
}
add_action('wp_head', 'fsc_preload_resources', 1);

/**
 * SEO: Add Skip Links for Accessibility (also helps SEO)
 */
function fsc_skip_links() {
    $is_rtl = is_rtl();
    ?>
    <a class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-slate-900 text-white px-4 py-2 rounded-lg z-[100]" href="#primary">
        <?php echo $is_rtl ? 'تخطي إلى المحتوى الرئيسي' : 'Skip to main content'; ?>
    </a>
    <?php
}
add_action('wp_body_open', 'fsc_skip_links');

/**
 * SEO: Optimize Image Alt Text
 */
function fsc_auto_alt_text($attr, $attachment, $size) {
    if (empty($attr['alt'])) {
        $attr['alt'] = get_the_title($attachment->ID);
        if (empty($attr['alt'])) {
            $attr['alt'] = 'Fahad Almansour Consulting - IT Consulting';
        }
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'fsc_auto_alt_text', 10, 3);

/**
 * SEO: Add Loading=lazy to Images
 */
function fsc_lazy_load_images($content) {
    if (is_admin()) return $content;
    return preg_replace('/<img((?:(?!loading=).)*?)(\s*\/?>)/i', '<img$1 loading="lazy"$2', $content);
}
add_filter('the_content', 'fsc_lazy_load_images');

/**
 * SEO: Security Headers (helps with rankings)
 */
function fsc_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'fsc_security_headers');

/**
 * SEO: Remove WordPress Version for Security
 */
remove_action('wp_head', 'wp_generator');

/**
 * SEO: Optimize RSS Feeds
 */
function fsc_rss_featured_image($content) {
    global $post;
    if (has_post_thumbnail($post->ID)) {
        $content = '<p>' . get_the_post_thumbnail($post->ID, 'medium') . '</p>' . $content;
    }
    return $content;
}
add_filter('the_excerpt_rss', 'fsc_rss_featured_image');
add_filter('the_content_feed', 'fsc_rss_featured_image');

/**
 * FSC Page Templates Configuration
 */
function fsc_get_page_templates() {
    return [
        'case-studies' => ['title' => __('Case Studies', 'fsc'), 'template' => 'page-case-studies.php'],
        'about'        => ['title' => __('About', 'fsc'), 'template' => 'page-about.php'],
        'contact'      => ['title' => __('Contact', 'fsc'), 'template' => 'page-contact.php'],
        'services'     => ['title' => __('Services', 'fsc'), 'template' => 'page-services.php'],
        'how-we-work'  => ['title' => __('How We Work', 'fsc'), 'template' => 'page-how-we-work.php'],
        'privacy'      => ['title' => __('Privacy Policy', 'fsc'), 'template' => 'page-privacy.php'],
        'cookies'      => ['title' => __('Cookie Policy', 'fsc'), 'template' => 'page-cookies.php'],
        'terms'        => ['title' => __('Terms of Use', 'fsc'), 'template' => 'page-terms.php'],
        'disclaimer'   => ['title' => __('Disclaimer', 'fsc'), 'template' => 'page-disclaimer.php'],
        'disclosure'   => ['title' => __('Disclosure', 'fsc'), 'template' => 'page-disclosure.php'],
    ];
}

/**
 * Create Required Pages on Theme Activation
 */
function fsc_create_pages() {
    $pages = fsc_get_page_templates();

    foreach ($pages as $slug => $page_data) {
        $existing_page = get_page_by_path($slug);

        if (!$existing_page) {
            // Create the page
            $page_id = wp_insert_post([
                'post_title'     => $page_data['title'],
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_content'   => '',
                'comment_status' => 'closed',
            ]);

            if ($page_id && !is_wp_error($page_id) && !empty($page_data['template'])) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
            }
        } else {
            // Page exists - don't overwrite if built with Elementor
            if (get_post_meta($existing_page->ID, '_elementor_edit_mode', true) === 'builder') {
                continue;
            }
            // Ensure template is assigned for non-Elementor pages
            $current_template = get_post_meta($existing_page->ID, '_wp_page_template', true);
            if (empty($current_template) || $current_template === 'default') {
                update_post_meta($existing_page->ID, '_wp_page_template', $page_data['template']);
            }
        }
    }
}
add_action('after_switch_theme', 'fsc_create_pages');

/**
 * Fix Page Templates - Admin Tool
 * Visit: Use wp_nonce_url(admin_url('admin.php?fsc_fix_templates=1'), 'fsc_fix_templates_action')
 */
function fsc_fix_templates_tool() {
    if (!current_user_can('manage_options')) return;
    if (!isset($_GET['fsc_fix_templates'])) return;

    // Verify nonce to prevent CSRF
    if (!isset($_GET['_wpnonce']) || !wp_verify_nonce($_GET['_wpnonce'], 'fsc_fix_templates_action')) {
        wp_die(__('Security check failed.', 'fsc'), 403);
    }

    $pages = fsc_get_page_templates();
    $fixed = [];

    foreach ($pages as $slug => $page_data) {
        $page = get_page_by_path($slug);

        if ($page) {
            update_post_meta($page->ID, '_wp_page_template', $page_data['template']);
            $fixed[] = $slug;
        } else {
            // Create missing page
            $page_id = wp_insert_post([
                'post_title'     => $page_data['title'],
                'post_name'      => $slug,
                'post_status'    => 'publish',
                'post_type'      => 'page',
                'post_content'   => '',
                'comment_status' => 'closed',
            ]);
            if ($page_id && !is_wp_error($page_id)) {
                update_post_meta($page_id, '_wp_page_template', $page_data['template']);
                $fixed[] = $slug . ' (created)';
            }
        }
    }

    wp_die(
        '<h1>FSC Templates Fixed</h1>' .
        '<p>Fixed templates for: ' . esc_html(implode(', ', $fixed)) . '</p>' .
        '<p><a href="' . esc_url(admin_url()) . '">Back to Dashboard</a></p>',
        'FSC Templates Fixed'
    );
}
add_action('admin_init', 'fsc_fix_templates_tool');

/**
 * Admin Notice: Pages Created
 */
function fsc_admin_notice_pages_created() {
    if (get_transient('fsc_pages_created_notice')) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e('FSC Theme: Required pages have been created automatically.', 'fsc'); ?></p>
        </div>
        <?php
        delete_transient('fsc_pages_created_notice');
    }
}
add_action('admin_notices', 'fsc_admin_notice_pages_created');
