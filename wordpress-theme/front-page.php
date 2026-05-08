<?php
/**
 * The template for displaying the front page (homepage)
 *
 * @package FSC_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
<?php if (function_exists('fsc_is_elementor_page') && fsc_is_elementor_page(get_the_ID())): ?>
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
<?php else: ?>
    <?php
    // Homepage sections using shortcodes - White Premium layout
    // 1. Hero with Advisory Badge + Trust
    echo do_shortcode('[fsc_hero]');

    // 2. How We Work (4 cards)
    echo do_shortcode('[fsc_how_we_work]');

    // 3. The FSC Advantage (premium card)
    echo do_shortcode('[fsc_neutrality_card]');

    // 4. Solution Areas (grid)
    echo do_shortcode('[fsc_decision_areas]');

    // 5. What You Receive (deliverables)
    echo do_shortcode('[fsc_what_you_receive]');

    // 6. Why Procure Through FSC (advantages)
    echo do_shortcode('[fsc_boundaries]');

    // 7. Why Us (value cards)
    echo do_shortcode('[fsc_why_us]');

    // 8. Trust Badges
    echo do_shortcode('[fsc_trust_badges]');
    ?>

    <!-- 9. CTA Section -->
    <section class="py-16 px-6 bg-white">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900">
                <?php _e('Ready to Get Started?', 'fsc'); ?>
            </h2>
            <p class="text-xl text-slate-600 mb-8">
                <?php _e('Request a consultation and let us assess your technology needs. The right solution is closer than you think.', 'fsc'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-primary inline-flex items-center gap-2 rounded-full px-8 py-4">
                <?php _e('Request a Consultation', 'fsc'); ?>
            </a>
            <p class="text-sm text-slate-500 mt-4">
                <?php _e('We respond within one business day.', 'fsc'); ?>
            </p>
        </div>
    </section>

    <!-- 10. Contact Form -->
    <section id="contact" class="py-16 px-6 bg-slate-50 border-t border-b border-slate-200">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900">
                    <?php _e('Contact Us', 'fsc'); ?>
                </h2>
                <p class="text-xl text-slate-600">
                    <?php _e('Send your inquiry and we\'ll respond within one business day', 'fsc'); ?>
                </p>
            </div>
            <?php echo do_shortcode('[fsc_contact_form]'); ?>
        </div>
    </section>
<?php endif; ?>
</main>

<?php
get_footer();
