<?php
/**
 * Template Name: Service Disclaimer
 *
 * @package FSC_Theme
 */

get_header();
?>

<main id="primary" class="site-main min-h-screen bg-white pt-12 pb-20 px-6">
<?php if (function_exists('fsc_is_elementor_page') && fsc_is_elementor_page(get_the_ID())): ?>
    <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
<?php else: ?>
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl sm:text-5xl text-slate-900 mb-4 tracking-tight font-light">
            <?php _e('Service Disclaimer', 'fsc'); ?>
        </h1>
        <p class="text-sm text-slate-600 mb-12"><?php _e('Last updated: January 2026', 'fsc'); ?></p>

        <div class="prose prose-slate max-w-none space-y-8">
            <section>
                <h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e('Scope of Services', 'fsc'); ?></h2>
                <p class="text-slate-700 leading-relaxed mb-4">
                    <?php _e('Fahad Almansour Consultant Office provides technology assessment, solution design, hardware/software procurement, and delivery services.', 'fsc'); ?>
                </p>
                <div class="grid md:grid-cols-2 gap-8 mb-6">
                    <div class="bg-emerald-50 p-6 rounded-xl border border-emerald-100">
                        <strong class="block text-emerald-900 mb-2"><?php _e('We Provide:', 'fsc'); ?></strong>
                        <ul class="list-disc pl-5 text-emerald-800 text-sm space-y-1">
                            <li><?php _e('Technology requirements assessment', 'fsc'); ?></li>
                            <li><?php _e('Solution design and architecture', 'fsc'); ?></li>
                            <li><?php _e('Certified hardware and software procurement', 'fsc'); ?></li>
                            <li><?php _e('Product delivery and initial configuration support', 'fsc'); ?></li>
                        </ul>
                    </div>
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                        <strong class="block text-slate-900 mb-2"><?php _e('We Do Not Provide:', 'fsc'); ?></strong>
                        <ul class="list-disc pl-5 text-slate-600 text-sm space-y-1">
                            <li><?php _e('Ongoing IT support or managed services', 'fsc'); ?></li>
                            <li><?php _e('Software development or custom coding', 'fsc'); ?></li>
                            <li><?php _e('Staffing or temporary personnel', 'fsc'); ?></li>
                            <li><?php _e('Guarantees of specific business outcomes', 'fsc'); ?></li>
                        </ul>
                    </div>
                </div>
            </section>

            <section>
                <h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e('No Guarantees', 'fsc'); ?></h2>
                <p class="text-slate-700 leading-relaxed mb-4">
                    <?php _e('Technology decisions involve inherent uncertainty. We do not guarantee specific business outcomes, return on investment, project success, or vendor performance.', 'fsc'); ?>
                </p>
                <p class="text-slate-700 italic">
                    <?php _e('Our recommendations represent our professional judgment based on information available at the time of engagement.', 'fsc'); ?>
                </p>
            </section>

            <section>
                <h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e('Client Responsibility', 'fsc'); ?></h2>
                <ul class="space-y-4 text-slate-700">
                    <li>
                        <strong class="text-slate-900"><?php _e('Final Decisions:', 'fsc'); ?></strong>
                        <?php _e(' All technology decisions are made by you. Our recommendations are inputs to your process.', 'fsc'); ?>
                    </li>
                    <li>
                        <strong class="text-slate-900"><?php _e('Implementation:', 'fsc'); ?></strong>
                        <?php _e(' Execution of any recommendations is your responsibility. We do not supervise implementation.', 'fsc'); ?>
                    </li>
                    <li>
                        <strong class="text-slate-900"><?php _e('Vendor Contracts:', 'fsc'); ?></strong>
                        <?php _e(' Relationships with vendors are between you and those vendors directly.', 'fsc'); ?>
                    </li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e('Not Professional Advice', 'fsc'); ?></h2>
                <p class="text-slate-700 leading-relaxed">
                    <?php _e('Our services do not constitute legal, tax, or financial advice. For such matters, please engage appropriate licensed professionals.', 'fsc'); ?>
                </p>
            </section>

            <section>
                <h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e('Limitation of Liability', 'fsc'); ?></h2>
                <ul class="list-disc pl-5 text-slate-700 space-y-2">
                    <li><?php _e('Our liability is limited to the fees paid for the engagement.', 'fsc'); ?></li>
                    <li><?php _e('We are not liable for indirect, incidental, or consequential damages.', 'fsc'); ?></li>
                    <li><?php _e('We are not liable for lost profits, lost data, or business interruption.', 'fsc'); ?></li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e('Contact', 'fsc'); ?></h2>
                <p class="text-slate-700">
                    <?php _e('Questions about this disclaimer:', 'fsc'); ?>
                    <a href="mailto:info@fahadalmansourconsulting.com" class="text-emerald-600 underline">info@fahadalmansourconsulting.com</a>
                </p>
            </section>
        </div>
    </div>
<?php endif; ?>
</main>

<?php
get_footer();
