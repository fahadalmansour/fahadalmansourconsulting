<?php
/**
 * Template Name: About
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
            <h1 class="text-4xl md:text-6xl font-light text-slate-900 mb-6 tracking-tight">
                <?php _e('About Fahad Almansour Consultant Office', 'fsc'); ?>
            </h1>
            <p class="text-xl text-slate-600 max-w-2xl mx-auto leading-relaxed">
                <?php _e('Your complete technology partner. We assess your needs, design the right solution, and deliver certified hardware and software.', 'fsc'); ?>
            </p>
        </div>
    </section>

    <!-- Why -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-light text-slate-900 mb-6"><?php _e('Why?', 'fsc'); ?></h2>
                <div class="w-16 h-1 bg-emerald-600 mx-auto rounded-full mb-8"></div>

                <div class="prose prose-lg prose-slate mx-auto text-slate-600 leading-relaxed">
                    <p class="mb-6">
                        <?php _e('Businesses in Saudi Arabia face a common problem: consultants who give advice but leave you to navigate procurement alone, and vendors who sell products without understanding your real needs. The gap between consulting and procurement creates incompatibility, wasted budgets, and finger-pointing.', 'fsc'); ?>
                    </p>
                    <p class="font-medium text-slate-900 text-xl">
                        <?php _e('We bridged that gap.', 'fsc'); ?>
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-emerald-50 p-8 rounded-2xl border border-emerald-100">
                    <h3 class="text-lg font-medium text-emerald-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <?php _e("End-to-End Solutions", 'fsc'); ?>
                    </h3>
                    <p class="text-emerald-800 text-sm">
                        <?php _e('From initial assessment to hardware on your desk. No gaps, no handoffs to third parties.', 'fsc'); ?>
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl border border-emerald-100">
                    <h3 class="text-lg font-medium text-emerald-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <?php _e("Assessment-First Approach", 'fsc'); ?>
                    </h3>
                    <p class="text-emerald-800 text-sm">
                        <?php _e('We assess your real needs before recommending or supplying anything. No upselling, no unnecessary products.', 'fsc'); ?>
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl border border-emerald-100">
                    <h3 class="text-lg font-medium text-emerald-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <?php _e("Certified Products", 'fsc'); ?>
                    </h3>
                    <p class="text-emerald-800 text-sm">
                        <?php _e('We supply only certified, genuine hardware and software. No gray market, no compatibility surprises.', 'fsc'); ?>
                    </p>
                </div>
                <div class="bg-emerald-50 p-8 rounded-2xl border border-emerald-100">
                    <h3 class="text-lg font-medium text-emerald-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <?php _e("Single Accountability", 'fsc'); ?>
                    </h3>
                    <p class="text-emerald-800 text-sm">
                        <?php _e('One partner, one invoice, one point of contact. If something isn\'t right, you call us.', 'fsc'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Values -->
    <section class="py-20 px-6 bg-slate-50 border-y border-slate-200">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-light text-slate-900 mb-12 text-center"><?php _e('Our Values', 'fsc'); ?></h2>
            <div class="grid md:grid-cols-3 gap-8">

                <!-- Independence -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center mb-4 text-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-medium text-slate-900 mb-2"><?php _e('End-to-End', 'fsc'); ?></h3>
                    <p class="text-sm text-slate-600 leading-relaxed"><?php _e('Assessment through delivery. We handle the entire technology journey so you don\'t have to.', 'fsc'); ?></p>
                </div>

                <!-- Structure -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center mb-4 text-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    </div>
                    <h3 class="font-medium text-slate-900 mb-2"><?php _e('Structure', 'fsc'); ?></h3>
                    <p class="text-sm text-slate-600 leading-relaxed"><?php _e('Documented frameworks, not verbal opinions. Every recommendation traceable to evidence.', 'fsc'); ?></p>
                </div>

                <!-- Transparency -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center mb-4 text-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h3 class="font-medium text-slate-900 mb-2"><?php _e('Transparency', 'fsc'); ?></h3>
                    <p class="text-sm text-slate-600 leading-relaxed"><?php _e('We state limitations upfront. We disclose any potential conflicts or referral fees clearly.', 'fsc'); ?></p>
                </div>

                <!-- Integrity -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center mb-4 text-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                    </div>
                    <h3 class="font-medium text-slate-900 mb-2"><?php _e('Integrity', 'fsc'); ?></h3>
                    <p class="text-sm text-slate-600 leading-relaxed"><?php _e("We provide the right advice, even when it's not what clients want to hear.", 'fsc'); ?></p>
                </div>

                <!-- Clarity -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-100">
                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center mb-4 text-slate-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-medium text-slate-900 mb-2"><?php _e('Clarity', 'fsc'); ?></h3>
                    <p class="text-sm text-slate-600 leading-relaxed"><?php _e('Complex decisions made understandable. Trade-offs explained in business terms.', 'fsc'); ?></p>
                </div>

            </div>
        </div>
    </section>

    <!-- Company Info -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-4xl mx-auto border border-slate-200 rounded-3xl p-8 md:p-12">
            <h2 class="text-2xl font-light text-slate-900 mb-8"><?php _e('Company Information', 'fsc'); ?></h2>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div>
                        <span class="block text-xs uppercase text-slate-400 tracking-wider font-semibold mb-1"><?php _e('Legal Identity', 'fsc'); ?></span>
                        <p class="text-slate-800"><?php _e('Fahad Almansour Consultant Office', 'fsc'); ?></p>
                    </div>
                    <div>
                         <span class="block text-xs uppercase text-slate-400 tracking-wider font-semibold mb-1"><?php _e('Jurisdiction', 'fsc'); ?></span>
                        <p class="text-slate-800"><?php _e('Riyadh, Saudi Arabia', 'fsc'); ?></p>
                    </div>
                    <div>
                         <span class="block text-xs uppercase text-slate-400 tracking-wider font-semibold mb-1"><?php _e('Established', 'fsc'); ?></span>
                        <p class="text-slate-800">2020</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <span class="block text-xs uppercase text-slate-400 tracking-wider font-semibold mb-1"><?php _e('Service Area', 'fsc'); ?></span>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            <?php _e('We serve clients in Saudi Arabia, the Gulf Cooperation Council (GCC), and internationally. Engagements are conducted remotely with in-person sessions available for GCC-based clients.', 'fsc'); ?>
                        </p>
                    </div>
                    <div>
                         <span class="block text-xs uppercase text-slate-400 tracking-wider font-semibold mb-1"><?php _e('Operating Hours', 'fsc'); ?></span>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            <?php _e('Sunday - Thursday, 9:00 AM - 5:00 PM (Arabia Standard Time). We accommodate client time zones for scheduled sessions.', 'fsc'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-24 px-6 bg-slate-900 text-white text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-light mb-6"><?php _e('Work With Us', 'fsc'); ?></h2>
            <p class="text-lg text-slate-300 mb-10">
                <?php _e("If you need the right technology solution — assessed, designed, and delivered — we'd welcome a conversation.", 'fsc'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="inline-flex items-center justify-center px-8 py-4 bg-emerald-600 text-white rounded-full font-medium text-lg hover:bg-emerald-500 transition-colors shadow-lg">
                <?php _e('Request a Consultation', 'fsc'); ?>
            </a>
        </div>
    </section>

<?php endif; ?>
</main>

<?php
get_footer();
