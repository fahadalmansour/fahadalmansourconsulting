<?php
/**
 * The template for displaying all pages
 *
 * @package FSC_Theme
 */

get_header();
?>

<main id="primary" class="site-main min-h-screen bg-white pt-12 pb-20 px-6">
	<div class="max-w-4xl mx-auto">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header mb-8">
					<?php the_title( '<h1 class="text-4xl sm:text-5xl text-slate-900 mb-4 tracking-tight font-light">', '</h1>' ); ?>
				</header>

				<div class="entry-content prose prose-slate max-w-none">
					<?php the_content(); ?>
				</div>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
