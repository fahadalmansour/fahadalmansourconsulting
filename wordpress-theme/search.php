<?php
/**
 * The template for displaying search results
 *
 * @package FSC_Theme
 */

get_header();

$is_rtl = is_rtl();
?>

<main id="primary" class="site-main min-h-screen bg-white">
	<div class="max-w-4xl mx-auto px-6 py-12">

		<!-- Search Header -->
		<header class="page-header mb-12">
			<h1 class="text-3xl sm:text-4xl text-slate-900 font-light tracking-tight mb-4">
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( 'Search Results for: %s', 'fsc' ),
					'<span class="font-medium">' . esc_html( get_search_query() ) . '</span>'
				);
				?>
			</h1>

			<!-- Search Form -->
			<div class="max-w-lg">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="relative">
						<input type="search"
								class="w-full px-4 py-3 pr-12 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-slate-200 focus:border-slate-500 transition-colors"
								placeholder="<?php echo esc_attr_x( 'Search again...', 'placeholder', 'fsc' ); ?>"
								value="<?php echo esc_attr( get_search_query() ); ?>"
								name="s" />
						<button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
							<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
							</svg>
							<span class="sr-only"><?php _e( 'Search', 'fsc' ); ?></span>
						</button>
					</div>
				</form>
			</div>
		</header>

		<?php if ( have_posts() ) : ?>

			<!-- Results Count -->
			<p class="text-slate-600 mb-8">
				<?php
				global $wp_query;
				printf(
					/* translators: %d: number of results */
					_n(
						'Found %d result',
						'Found %d results',
						$wp_query->found_posts,
						'fsc'
					),
					$wp_query->found_posts
				);
				?>
			</p>

			<!-- Search Results -->
			<div class="space-y-8">
				<?php
				while ( have_posts() ) :
					the_post();
					?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'border-b border-slate-200 pb-8' ); ?>>
						<header class="entry-header mb-3">
							<?php the_title( sprintf( '<h2 class="text-xl font-medium text-slate-900 hover:text-slate-700 transition-colors"><a href="%s">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

							<?php if ( 'post' === get_post_type() ) : ?>
								<div class="flex items-center gap-4 text-sm text-slate-500 mt-2">
									<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
										<?php echo get_the_date(); ?>
									</time>
									<?php if ( get_the_category_list() ) : ?>
										<span class="text-slate-300">|</span>
										<?php the_category( ', ' ); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</header>

						<div class="entry-summary text-slate-600">
							<?php the_excerpt(); ?>
						</div>

						<footer class="entry-footer mt-4">
							<a href="<?php the_permalink(); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-slate-700 hover:text-slate-900 transition-colors">
								<?php _e( 'Read more', 'fsc' ); ?>
								<svg class="w-4 h-4 <?php echo $is_rtl ? 'rotate-180' : ''; ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
								</svg>
							</a>
						</footer>
					</article>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<nav class="mt-12 pt-8 border-t border-slate-200">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => sprintf(
							'<span class="flex items-center gap-2"><svg class="w-4 h-4 %s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>%s</span>',
							$is_rtl ? 'rotate-180' : '',
							__( 'Previous', 'fsc' )
						),
						'next_text' => sprintf(
							'<span class="flex items-center gap-2">%s<svg class="w-4 h-4 %s" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></span>',
							__( 'Next', 'fsc' ),
							$is_rtl ? 'rotate-180' : ''
						),
					)
				);
				?>
			</nav>

		<?php else : ?>

			<!-- No Results -->
			<div class="text-center py-16">
				<svg class="w-16 h-16 mx-auto text-slate-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
				</svg>
				<h2 class="text-2xl text-slate-900 font-light mb-4">
					<?php _e( 'No Results Found', 'fsc' ); ?>
				</h2>
				<p class="text-slate-600 mb-8 max-w-md mx-auto">
					<?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'fsc' ); ?>
				</p>

				<!-- Suggestions -->
				<div class="bg-slate-50 rounded-2xl p-8 max-w-lg mx-auto text-left">
					<h3 class="font-medium text-slate-900 mb-4"><?php _e( 'Suggestions:', 'fsc' ); ?></h3>
					<ul class="space-y-2 text-slate-600">
						<li class="flex items-start gap-2">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
							</svg>
							<?php _e( 'Check the spelling of your keywords', 'fsc' ); ?>
						</li>
						<li class="flex items-start gap-2">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
							</svg>
							<?php _e( 'Try using fewer or more general words', 'fsc' ); ?>
						</li>
						<li class="flex items-start gap-2">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
							</svg>
							<?php _e( 'Browse our pages using the navigation menu', 'fsc' ); ?>
						</li>
					</ul>
				</div>

				<!-- Action Buttons -->
				<div class="flex flex-col sm:flex-row items-center justify-center gap-4 mt-8">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
						<?php _e( 'Go to Homepage', 'fsc' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-secondary">
						<?php _e( 'Contact Us', 'fsc' ); ?>
					</a>
				</div>
			</div>

		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
