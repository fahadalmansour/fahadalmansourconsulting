<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package FSC_Theme
 */

get_header();

$is_rtl = is_rtl();
?>

<main id="primary" class="site-main min-h-screen bg-white">
    <div class="max-w-4xl mx-auto px-6 py-20 text-center">
        <!-- 404 Icon -->
        <div class="mb-8">
            <svg class="w-24 h-24 mx-auto text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>

        <!-- Error Code -->
        <p class="text-8xl font-light text-slate-200 mb-4">404</p>

        <!-- Title -->
        <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
            <?php esc_html_e('Page Not Found', 'fsc'); ?>
        </h1>

        <!-- Description -->
        <p class="text-lg text-slate-600 mb-8 max-w-md mx-auto">
            <?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'fsc'); ?>
        </p>

        <!-- Search Form -->
        <div class="mb-8 max-w-md mx-auto">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <div class="relative">
                    <input type="search"
                           class="w-full px-4 py-3 pr-12 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-200 focus:border-slate-500 transition-colors"
                           placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'fsc'); ?>"
                           value="<?php echo esc_attr(get_search_query()); ?>"
                           name="s" />
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span class="sr-only"><?php esc_html_e('Search', 'fsc'); ?></span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                <svg class="w-4 h-4 <?php echo $is_rtl ? 'ml-2' : 'mr-2'; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <?php esc_html_e('Go to Homepage', 'fsc'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-secondary">
                <?php esc_html_e('Contact Us', 'fsc'); ?>
            </a>
        </div>

        <!-- Helpful Links -->
        <div class="mt-16 pt-8 border-t border-slate-200">
            <h2 class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-6">
                <?php esc_html_e('Helpful Links', 'fsc'); ?>
            </h2>
            <div class="flex flex-wrap items-center justify-center gap-6">
                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="text-slate-600 hover:text-slate-900 transition-colors">
                    <?php esc_html_e('Services', 'fsc'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/about/')); ?>" class="text-slate-600 hover:text-slate-900 transition-colors">
                    <?php esc_html_e('About Us', 'fsc'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/how-we-work/')); ?>" class="text-slate-600 hover:text-slate-900 transition-colors">
                    <?php esc_html_e('How We Work', 'fsc'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="text-slate-600 hover:text-slate-900 transition-colors">
                    <?php esc_html_e('Contact', 'fsc'); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
