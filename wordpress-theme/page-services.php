<?php
/**
 * Template Name: Services
 *
 * @package FSC_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
<?php if (function_exists('fsc_is_elementor_page') && fsc_is_elementor_page(get_the_ID())): ?>
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
<?php else: ?>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 px-6 bg-white border-b border-slate-100">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-slate-50 border border-slate-200 text-emerald-600 text-xs font-medium tracking-wide uppercase mb-6">
                <?php _e('Our Capabilities', 'fsc'); ?>
            </span>
            <h1 class="text-4xl md:text-6xl font-light text-slate-900 mb-6 tracking-tight">
                <?php _e('Our Services', 'fsc'); ?>
            </h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                <?php _e('End-to-end technology solutions. We assess, design, procure, and deliver.', 'fsc'); ?>
            </p>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12">

                <!-- Service 1: Cloud & Infrastructure -->
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 md:p-10 transition-shadow hover:shadow-lg">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-medium text-slate-900 mb-4"><?php _e('Cloud & Infrastructure', 'fsc'); ?></h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        <?php _e('We assess your infrastructure, evaluate cloud options, and design the right solution. Then we procure and deliver the certified hardware and software you need — ready for your environment.', 'fsc'); ?>
                    </p>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('We Help With', 'fsc'); ?></h3>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Cloud vs. on-premise vs. hybrid architecture decisions', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Multi-cloud strategy evaluation and provider comparison', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Migration approach assessment and sequencing', 'fsc'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-6 border-t border-slate-200">
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('Deliverables', 'fsc'); ?></h3>
                            <p class="text-sm text-slate-600">
                                <?php _e('Cloud readiness assessment, Provider comparison matrix, Migration trade-off analysis.', 'fsc'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Service 2: Digital Transformation -->
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 md:p-10 transition-shadow hover:shadow-lg">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-medium text-slate-900 mb-4"><?php _e('Digital Presence & E-Commerce', 'fsc'); ?></h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        <?php _e('Domain, hosting, e-commerce platforms, and the tools your business needs — assessed, selected, and delivered. Saudi-specific: Mada, SADAD, ZATCA compliance.', 'fsc'); ?>
                    </p>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('We Help With', 'fsc'); ?></h3>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Current state assessment and technology landscape mapping', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Platform and technology stack evaluation', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-purple-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Process automation opportunity identification', 'fsc'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-6 border-t border-slate-200">
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('Deliverables', 'fsc'); ?></h3>
                            <p class="text-sm text-slate-600">
                                <?php _e('Technology landscape map, Transformation options analysis, Platform evaluation framework.', 'fsc'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Service 3: Cybersecurity & Compliance -->
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 md:p-10 transition-shadow hover:shadow-lg">
                    <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-medium text-slate-900 mb-4"><?php _e('Cybersecurity & Compliance', 'fsc'); ?></h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        <?php _e('Security and compliance decisions require balancing risk, investment, and operational impact. We help you prioritize and select the right approach for your organization.', 'fsc'); ?>
                    </p>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('We Help With', 'fsc'); ?></h3>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Security framework selection (ISO 27001, NIST, SOC 2)', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Compliance gap analysis and readiness assessment', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Security vendor evaluation criteria', 'fsc'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-6 border-t border-slate-200">
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('Deliverables', 'fsc'); ?></h3>
                            <p class="text-sm text-slate-600">
                                <?php _e('Security posture assessment, Compliance roadmap, Risk register with prioritizations.', 'fsc'); ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Service 4: Vendor Selection -->
                <div class="bg-slate-50 border border-slate-200 rounded-3xl p-8 md:p-10 transition-shadow hover:shadow-lg">
                    <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mb-8">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-medium text-slate-900 mb-4"><?php _e('Vendor Selection & Governance', 'fsc'); ?></h2>
                    <p class="text-slate-600 mb-8 leading-relaxed">
                        <?php _e('Selecting the right technology vendors requires structured evaluation beyond sales presentations. We help you ask the right questions and compare objectively.', 'fsc'); ?>
                    </p>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('We Help With', 'fsc'); ?></h3>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Requirements definition and RFP development', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Vendor shortlisting and evaluation criteria', 'fsc'); ?>
                                </li>
                                <li class="flex items-start gap-3 text-slate-700 text-sm">
                                    <svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    <?php _e('Reference check frameworks', 'fsc'); ?>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-6 border-t border-slate-200">
                            <h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3"><?php _e('Deliverables', 'fsc'); ?></h3>
                            <p class="text-sm text-slate-600">
                                <?php _e('Requirements specification, Vendor evaluation scorecard, Selection recommendation.', 'fsc'); ?>
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- The FSC Advantage -->
    <section class="py-20 px-6 bg-slate-50 border-t border-slate-200">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-2xl font-light text-slate-900 mb-6"><?php _e('The FSC Advantage', 'fsc'); ?></h2>
            <p class="text-lg text-slate-600 mb-8 leading-relaxed">
                <?php _e('By procuring through FSC, you eliminate the risk of incompatibility or incorrect specifications. We ensure you get the right technology, delivered ready for your environment, with a single point of accountability.', 'fsc'); ?>
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-slate-200 text-sm text-slate-700">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <?php _e('Assessment First', 'fsc'); ?>
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-slate-200 text-sm text-slate-700">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <?php _e('Certified Products', 'fsc'); ?>
                </span>
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-lg border border-slate-200 text-sm text-slate-700">
                    <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <?php _e('Single Accountability', 'fsc'); ?>
                </span>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 px-6 bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-5xl font-light mb-6"><?php _e('Discuss Your Situation', 'fsc'); ?></h2>
            <p class="text-xl text-slate-300 mb-10 max-w-2xl mx-auto">
                <?php _e("Every organization's context is different. Contact us to discuss your specific decision and determine if our advisory approach is appropriate.", 'fsc'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-emerald-600 text-white rounded-full font-medium text-lg hover:bg-emerald-500 transition-colors shadow-lg hover:shadow-emerald-600/30">
                <?php _e('Request a Conversation', 'fsc'); ?>
                <svg class="w-5 h-5 ml-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>

<?php endif; ?>
</main>

<?php
get_footer();
