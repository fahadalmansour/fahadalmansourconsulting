<?php
/**
 * The footer template
 *
 * Matches header.php detection modes:
 * 1. Elementor Canvas — minimal close tags only
 * 2. Elementor Theme Builder footer — close wrappers, skip FSC footer
 * 3. FSC native — full FSC footer
 *
 * @package FSC_Theme
 */

$is_rtl = is_rtl();

// Match the canvas flag from header.php
$fsc_elementor_canvas = function_exists('fsc_is_elementor_canvas') && fsc_is_elementor_canvas();
$fsc_elementor_footer = function_exists('fsc_has_elementor_location') && fsc_has_elementor_location('footer');
?>

<?php if ($fsc_elementor_canvas): ?>
    <?php // Canvas mode: just close body/html ?>
<?php else: ?>
    </div><!-- #content -->

    <?php if (!$fsc_elementor_footer): ?>
    <footer id="colophon" class="site-footer bg-slate-50 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 py-16">
            <!-- Footer Grid -->
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                <!-- Company Info -->
                <div class="lg:col-span-2">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="fsc-footer-logo inline-flex items-center gap-3 mb-4">
                        <svg class="fsc-logo-icon" width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- FSC Network Nodes -->
                            <line x1="28" y1="14" x2="21" y2="3" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="28" y1="14" x2="38" y2="6" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="28" y1="14" x2="42" y2="18" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="28" y1="14" x2="16" y2="28" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="16" y1="28" x2="5" y2="21" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="16" y1="28" x2="8" y2="40" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="16" y1="28" x2="28" y2="38" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="28" y1="38" x2="38" y2="44" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
                            <circle cx="28" cy="14" r="4.5" fill="#4A90D9"/>
                            <circle cx="16" cy="28" r="4" fill="#4A90D9"/>
                            <circle cx="21" cy="3" r="2.5" fill="#4A90D9"/>
                            <circle cx="38" cy="6" r="2.5" fill="#4A90D9"/>
                            <circle cx="42" cy="18" r="2.5" fill="#4A90D9"/>
                            <circle cx="5" cy="21" r="2.5" fill="#4A90D9"/>
                            <circle cx="8" cy="40" r="2.5" fill="#4A90D9"/>
                            <circle cx="28" cy="38" r="2.5" fill="#4A90D9"/>
                            <circle cx="38" cy="44" r="2.5" fill="#4A90D9"/>
                        </svg>
                        <span class="fsc-logo-text">
                            <span class="fsc-logo-name"><?php echo $is_rtl ? 'فهد المنصور للاستشارات' : 'Fahad Almansour Consulting'; ?></span>
                            <span class="fsc-logo-tagline"><?php echo $is_rtl ? 'شريكك التقني المتكامل' : 'Your Technology Partner'; ?></span>
                        </span>
                    </a>
                    <p class="text-sm text-slate-500 mb-4"><?php esc_html_e('Your Complete Technology Partner', 'fsc'); ?></p>
                    <p class="text-slate-600 mb-4 max-w-md">
                        <?php esc_html_e('We assess your needs, design the right solution, and deliver certified hardware and software. One partner, complete accountability.', 'fsc'); ?>
                    </p>
                </div>

                <!-- Legal Links -->
                <div>
                    <h4 class="font-medium text-slate-900 mb-4"><?php esc_html_e('Legal', 'fsc'); ?></h4>
                    <nav class="space-y-2">
                        <a href="<?php echo esc_url(home_url('/privacy/')); ?>" class="block text-slate-600 hover:text-slate-900 transition-colors text-sm">
                            <?php esc_html_e('Privacy Policy', 'fsc'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/cookies/')); ?>" class="block text-slate-600 hover:text-slate-900 transition-colors text-sm">
                            <?php esc_html_e('Cookie Policy', 'fsc'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/terms/')); ?>" class="block text-slate-600 hover:text-slate-900 transition-colors text-sm">
                            <?php esc_html_e('Terms of Use', 'fsc'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/disclaimer/')); ?>" class="block text-slate-600 hover:text-slate-900 transition-colors text-sm">
                            <?php esc_html_e('Disclaimer', 'fsc'); ?>
                        </a>
                        <a href="<?php echo esc_url(home_url('/disclosure/')); ?>" class="block text-slate-600 hover:text-slate-900 transition-colors text-sm">
                            <?php esc_html_e('Disclosure', 'fsc'); ?>
                        </a>
                    </nav>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-medium text-slate-900 mb-4"><?php esc_html_e('Contact', 'fsc'); ?></h4>
                    <div class="space-y-3">
                        <!-- Email -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-slate-500 mb-1"><?php esc_html_e('Email', 'fsc'); ?></p>
                                <a href="mailto:info@fahadalmansourconsulting.com" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
                                    info@fahadalmansourconsulting.com
                                </a>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-slate-500 mb-1"><?php esc_html_e('Phone / WhatsApp', 'fsc'); ?></p>
                                <a href="tel:+966570131122" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
                                    +966 57 013 1122
                                </a>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-slate-500 mb-1"><?php esc_html_e('Location', 'fsc'); ?></p>
                                <p class="text-slate-700 text-sm font-medium">
                                    <?php echo $is_rtl ? 'الرياض، المملكة العربية السعودية' : 'Riyadh, Saudi Arabia'; ?><br>
                                    RRMA8094
                                </p>
                            </div>
                        </div>

                        <!-- Working Hours -->
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <p class="text-xs text-slate-500 mb-1"><?php esc_html_e('Working Hours', 'fsc'); ?></p>
                                <p class="text-slate-700 text-sm font-medium">
                                    <?php esc_html_e('Sunday - Thursday', 'fsc'); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links & CTA -->
                    <div class="mt-6 pt-4 border-t border-slate-200">
                        <div class="mb-4">
                            <?php echo do_shortcode('[fsc_social_links]'); ?>
                        </div>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-slate-900 hover:text-slate-700 transition-colors">
                            <?php esc_html_e('Request a Consultation', 'fsc'); ?>
                            <svg class="w-4 h-4 <?php echo $is_rtl ? 'rtl-flip' : ''; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <p class="text-xs text-slate-500 mt-2">
                            <?php esc_html_e('We respond within one business day.', 'fsc'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500">
                    © <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html($is_rtl ? 'فهد المنصور للاستشارات' : 'Fahad Almansour Consulting'); ?>. <?php esc_html_e('All rights reserved.', 'fsc'); ?>
                </p>
                <a href="#page" class="text-sm text-slate-600 hover:text-slate-900 transition-colors inline-flex items-center gap-1">
                    <?php esc_html_e('Back to top', 'fsc'); ?>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                    </svg>
                </a>
            </div>
        </div>
    </footer>
    <?php endif; ?>

</div><!-- #page -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
