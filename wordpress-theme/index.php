<?php
/**
 * The main template file
 *
 * @package FSC_Theme
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title('<h1 class="entry-title text-4xl font-light tracking-tight text-slate-900 mb-6">', '</h1>'); ?>
                </header>

                <div class="entry-content prose prose-slate max-w-none">
                    <?php the_content(); ?>
                </div>
            </article>
            <?php
        endwhile;
    else :
        ?>
        <section class="py-20 px-6 text-center">
            <h1 class="text-4xl font-light text-slate-900 mb-4"><?php _e('Nothing found', 'fsc'); ?></h1>
            <p class="text-slate-600"><?php _e('It looks like nothing was found at this location.', 'fsc'); ?></p>
        </section>
        <?php
    endif;
    ?>
</main>

<?php
get_footer();
