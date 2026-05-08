<?php
/**
 * The template for displaying single blog posts
 *
 * @package FSC_Theme
 */

get_header();

$is_rtl = is_rtl();
?>

<main id="primary" class="site-main min-h-screen bg-white">
    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <!-- Post Header -->
            <header class="entry-header bg-slate-50 py-16 px-6 border-b border-slate-200">
                <div class="max-w-3xl mx-auto">
                    <!-- Categories -->
                    <?php if (has_category()) : ?>
                        <div class="mb-4">
                            <?php
                            $categories = get_the_category();
                            foreach ($categories as $cat) :
                            ?>
                                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"
                                   class="inline-block text-sm font-medium text-slate-600 hover:text-slate-900 transition-colors">
                                    <?php echo esc_html($cat->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Title -->
                    <?php the_title('<h1 class="text-3xl sm:text-4xl lg:text-5xl text-slate-900 font-light tracking-tight mb-6">', '</h1>'); ?>

                    <!-- Meta -->
                    <div class="flex flex-wrap items-center gap-4 text-slate-600">
                        <!-- Date -->
                        <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <?php echo get_the_date(); ?>
                        </time>

                        <span class="text-slate-300">|</span>

                        <!-- Reading Time -->
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <?php
                            $content = get_the_content();
                            $word_count = str_word_count(strip_tags($content));
                            $reading_time = ceil($word_count / 200);
                            printf(
                                /* translators: %d: reading time in minutes */
                                _n('%d min read', '%d min read', $reading_time, 'fsc'),
                                $reading_time
                            );
                            ?>
                        </span>

                        <?php if (has_tag()) : ?>
                            <span class="text-slate-300">|</span>
                            <!-- Tags -->
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                <?php the_tags('', ', ', ''); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="max-w-4xl mx-auto px-6 -mt-8">
                    <figure class="rounded-2xl overflow-hidden shadow-lg">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-auto']); ?>
                        <?php if (get_the_post_thumbnail_caption()) : ?>
                            <figcaption class="bg-slate-100 px-4 py-2 text-sm text-slate-600 text-center">
                                <?php echo get_the_post_thumbnail_caption(); ?>
                            </figcaption>
                        <?php endif; ?>
                    </figure>
                </div>
            <?php endif; ?>

            <!-- Post Content -->
            <div class="entry-content max-w-3xl mx-auto px-6 py-12">
                <div class="prose prose-slate prose-lg max-w-none prose-headings:font-light prose-headings:tracking-tight prose-a:text-slate-700 prose-a:underline hover:prose-a:text-slate-900">
                    <?php the_content(); ?>
                </div>

                <!-- Post Navigation (Next/Previous) -->
                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links mt-8 pt-8 border-t border-slate-200">' . __('Pages:', 'fsc'),
                    'after'  => '</div>',
                ));
                ?>
            </div>

            <!-- Post Footer -->
            <footer class="entry-footer border-t border-slate-200">
                <div class="max-w-3xl mx-auto px-6 py-8">
                    <!-- Share Section -->
                    <div class="mb-8">
                        <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-4">
                            <?php _e('Share this article', 'fsc'); ?>
                        </h3>
                        <div class="flex items-center gap-4">
                            <!-- LinkedIn -->
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors"
                               aria-label="<?php _e('Share on LinkedIn', 'fsc'); ?>">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            <!-- Twitter/X -->
                            <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors"
                               aria-label="<?php _e('Share on Twitter', 'fsc'); ?>">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                </svg>
                            </a>
                            <!-- Email -->
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>"
                               class="p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors"
                               aria-label="<?php _e('Share via Email', 'fsc'); ?>">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </a>
                            <!-- Copy Link -->
                            <button onclick="navigator.clipboard.writeText('<?php echo esc_js(get_permalink()); ?>'); this.innerHTML='<svg class=\'w-5 h-5 text-green-600\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'/></svg>'; setTimeout(() => this.innerHTML='<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'/></svg>', 2000)"
                                    class="p-2 text-slate-500 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors"
                                    aria-label="<?php _e('Copy link', 'fsc'); ?>">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Author Bio -->
                    <div class="bg-slate-50 rounded-2xl p-6 mb-8">
                        <div class="flex items-start gap-4">
                            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'rounded-full']); ?>
                            <div>
                                <h3 class="font-medium text-slate-900 mb-1">
                                    <?php the_author(); ?>
                                </h3>
                                <p class="text-slate-600 text-sm">
                                    <?php echo get_the_author_meta('description') ?: __('IT Consultant at Fahad Almansour Consultant Office', 'fsc'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Post Navigation -->
                <div class="border-t border-slate-200">
                    <div class="max-w-4xl mx-auto px-6 py-8">
                        <nav class="navigation post-navigation grid sm:grid-cols-2 gap-8">
                            <?php
                            $prev_post = get_previous_post();
                            $next_post = get_next_post();
                            ?>

                            <?php if ($prev_post) : ?>
                                <a href="<?php echo get_permalink($prev_post); ?>" class="group block p-4 border border-slate-200 rounded-xl hover:border-slate-300 transition-colors">
                                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider flex items-center gap-2 mb-2">
                                        <svg class="w-4 h-4 <?php echo $is_rtl ? 'rotate-180' : ''; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                        </svg>
                                        <?php _e('Previous', 'fsc'); ?>
                                    </span>
                                    <span class="text-slate-700 group-hover:text-slate-900 transition-colors line-clamp-2">
                                        <?php echo get_the_title($prev_post); ?>
                                    </span>
                                </a>
                            <?php else : ?>
                                <div></div>
                            <?php endif; ?>

                            <?php if ($next_post) : ?>
                                <a href="<?php echo get_permalink($next_post); ?>" class="group block p-4 border border-slate-200 rounded-xl hover:border-slate-300 transition-colors text-right">
                                    <span class="text-xs font-medium text-slate-500 uppercase tracking-wider flex items-center justify-end gap-2 mb-2">
                                        <?php _e('Next', 'fsc'); ?>
                                        <svg class="w-4 h-4 <?php echo $is_rtl ? 'rotate-180' : ''; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                    <span class="text-slate-700 group-hover:text-slate-900 transition-colors line-clamp-2">
                                        <?php echo get_the_title($next_post); ?>
                                    </span>
                                </a>
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
            </footer>
        </article>

        <!-- Related Posts -->
        <?php
        $categories = get_the_category();
        if ($categories) :
            $category_ids = array_map(function($cat) { return $cat->term_id; }, $categories);
            $related_query = new WP_Query(array(
                'category__in' => $category_ids,
                'post__not_in' => array(get_the_ID()),
                'posts_per_page' => 3,
                'orderby' => 'rand',
            ));

            if ($related_query->have_posts()) :
        ?>
            <section class="related-posts bg-slate-50 border-t border-slate-200 py-16 px-6">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-2xl font-light text-slate-900 mb-8">
                        <?php _e('Related Articles', 'fsc'); ?>
                    </h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                            <article class="bg-white border border-slate-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', ['class' => 'w-full h-40 object-cover']); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="p-4">
                                    <?php the_title(sprintf('<h3 class="font-medium text-slate-900 mb-2 line-clamp-2"><a href="%s" class="hover:text-slate-700 transition-colors">', esc_url(get_permalink())), '</a></h3>'); ?>
                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="text-sm text-slate-500">
                                        <?php echo get_the_date(); ?>
                                    </time>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                </div>
            </section>
        <?php
            endif;
            wp_reset_postdata();
        endif;
        ?>

    <?php endwhile; ?>
</main>

<?php
get_footer();
