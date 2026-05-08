<?php
/**
 * The template for displaying archive pages (blog, categories, tags, dates)
 *
 * @package FSC_Theme
 */

get_header();

$is_rtl = is_rtl();
?>

<main id="primary" class="site-main min-h-screen bg-white">
    <!-- Archive Header -->
    <header class="archive-header bg-slate-50 py-16 px-6 border-b border-slate-200">
        <div class="max-w-4xl mx-auto">
            <?php
            // Determine archive type and display appropriate title
            if (is_category()) :
                ?>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-2">
                    <?php esc_html_e('Category', 'fsc'); ?>
                </p>
                <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
                    <?php echo esc_html(single_cat_title('', false)); ?>
                </h1>
                <?php if (category_description()) : ?>
                    <p class="text-lg text-slate-600 max-w-2xl">
                        <?php echo wp_kses_post(category_description()); ?>
                    </p>
                <?php endif; ?>

            <?php elseif (is_tag()) : ?>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-2">
                    <?php esc_html_e('Tag', 'fsc'); ?>
                </p>
                <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
                    <?php echo esc_html(single_tag_title('', false)); ?>
                </h1>
                <?php if (tag_description()) : ?>
                    <p class="text-lg text-slate-600 max-w-2xl">
                        <?php echo wp_kses_post(tag_description()); ?>
                    </p>
                <?php endif; ?>

            <?php elseif (is_author()) : ?>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-2">
                    <?php esc_html_e('Author', 'fsc'); ?>
                </p>
                <div class="flex items-center gap-4 mb-4">
                    <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'rounded-full']); ?>
                    <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight">
                        <?php the_author(); ?>
                    </h1>
                </div>
                <?php if (get_the_author_meta('description')) : ?>
                    <p class="text-lg text-slate-600 max-w-2xl">
                        <?php echo wp_kses_post(get_the_author_meta('description')); ?>
                    </p>
                <?php endif; ?>

            <?php elseif (is_date()) : ?>
                <p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-2">
                    <?php esc_html_e('Archive', 'fsc'); ?>
                </p>
                <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
                    <?php
                    if (is_day()) :
                        /* translators: %s: human-readable date */
                        printf(esc_html__('Daily Archives: %s', 'fsc'), esc_html(get_the_date()));
                    elseif (is_month()) :
                        /* translators: %s: month and year (e.g. "March 2026") */
                        printf(esc_html__('Monthly Archives: %s', 'fsc'), esc_html(get_the_date('F Y')));
                    elseif (is_year()) :
                        /* translators: %s: 4-digit year */
                        printf(esc_html__('Yearly Archives: %s', 'fsc'), esc_html(get_the_date('Y')));
                    endif;
                    ?>
                </h1>

            <?php elseif (is_home() && !is_front_page()) : ?>
                <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
                    <?php esc_html_e('Insights & Articles', 'fsc'); ?>
                </h1>
                <p class="text-lg text-slate-600 max-w-2xl">
                    <?php esc_html_e('Explore our latest thoughts on IT consulting, technology strategy, and digital transformation.', 'fsc'); ?>
                </p>

            <?php else : ?>
                <h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
                    <?php esc_html_e('Archive', 'fsc'); ?>
                </h1>
            <?php endif; ?>

            <!-- Post Count -->
            <?php
            global $wp_query;
            if ($wp_query->found_posts) :
            ?>
                <p class="text-slate-500 mt-4">
                    <?php
                    /* translators: %d: number of posts in the archive */
                    printf(
                        esc_html(_n('%d article', '%d articles', $wp_query->found_posts, 'fsc')),
                        (int) $wp_query->found_posts
                    );
                    ?>
                </p>
            <?php endif; ?>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-6 py-12">
        <?php if (have_posts()) : ?>

            <!-- Posts Grid -->
            <div class="space-y-8">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('group border-b border-slate-200 pb-8'); ?>>
                        <div class="grid md:grid-cols-3 gap-6">
                            <!-- Featured Image -->
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="md:col-span-1">
                                    <a href="<?php the_permalink(); ?>" class="block rounded-xl overflow-hidden">
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>

                            <!-- Content -->
                            <div class="<?php echo has_post_thumbnail() ? 'md:col-span-2' : 'md:col-span-3'; ?>">
                                <!-- Categories -->
                                <?php if (has_category()) : ?>
                                    <div class="mb-2">
                                        <?php
                                        $categories = get_the_category();
                                        $cat = $categories[0];
                                        ?>
                                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                           class="text-xs font-medium text-slate-500 uppercase tracking-wider hover:text-slate-700 transition-colors">
                                            <?php echo esc_html($cat->name); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <!-- Title -->
                                <?php the_title(sprintf('<h2 class="text-xl font-medium text-slate-900 mb-2"><a href="%s" class="hover:text-slate-700 transition-colors">', esc_url(get_permalink())), '</a></h2>'); ?>

                                <!-- Excerpt -->
                                <div class="text-slate-600 mb-4 line-clamp-2">
                                    <?php the_excerpt(); ?>
                                </div>

                                <!-- Meta -->
                                <div class="flex items-center gap-4 text-sm text-slate-500">
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                    <span class="text-slate-300">|</span>
                                    <span>
                                        <?php
                                        $content = get_the_content();
                                        $word_count = str_word_count(strip_tags($content));
                                        $reading_time = max(1, (int) ceil($word_count / 200));
                                        /* translators: %d: estimated minutes to read the post */
                                        printf(
                                            esc_html(_n('%d min read', '%d min read', $reading_time, 'fsc')),
                                            $reading_time
                                        );
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <nav class="navigation posts-navigation mt-12 pt-8 border-t border-slate-200">
                <?php
                the_posts_pagination(array(
                    'mid_size'  => 2,
                    'prev_text' => sprintf(
                        '<span class="flex items-center gap-2"><svg class="w-4 h-4 %s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>%s</span>',
                        $is_rtl ? 'rotate-180' : '',
                        esc_html__('Previous', 'fsc')
                    ),
                    'next_text' => sprintf(
                        '<span class="flex items-center gap-2">%s<svg class="w-4 h-4 %s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>',
                        esc_html__('Next', 'fsc'),
                        $is_rtl ? 'rotate-180' : ''
                    ),
                ));
                ?>
            </nav>

        <?php else : ?>

            <!-- No Posts Found -->
            <div class="text-center py-16">
                <svg class="w-16 h-16 mx-auto text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
                <h2 class="text-2xl text-slate-900 font-light mb-4">
                    <?php esc_html_e('No Articles Found', 'fsc'); ?>
                </h2>
                <p class="text-slate-600 mb-8 max-w-md mx-auto">
                    <?php esc_html_e('There are no articles in this archive yet. Check back soon for new content.', 'fsc'); ?>
                </p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                    <?php esc_html_e('Go to Homepage', 'fsc'); ?>
                </a>
            </div>

        <?php endif; ?>
    </div>

    <!-- Categories Sidebar (for blog index only) -->
    <?php if (is_home() && !is_front_page()) : ?>
        <section class="bg-slate-50 border-t border-slate-200 py-12 px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-lg font-medium text-slate-900 mb-6">
                    <?php esc_html_e('Browse by Category', 'fsc'); ?>
                </h2>
                <div class="flex flex-wrap gap-3">
                    <?php
                    $categories = get_categories(array(
                        'orderby' => 'count',
                        'order' => 'DESC',
                        'number' => 10,
                    ));
                    foreach ($categories as $cat) :
                    ?>
                        <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                           class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 rounded-full text-sm text-slate-700 hover:border-slate-300 hover:text-slate-900 transition-colors">
                            <?php echo esc_html($cat->name); ?>
                            <span class="text-slate-400"><?php echo (int) $cat->count; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php
get_footer();
