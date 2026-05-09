<?php
/**
 * Template Name: Disclosure Policy
 *
 * Disclosure Policy for Procurement Transparency & Pricing
 *
 * @package FSC_Theme
 */

get_header();
$is_rtl = is_rtl();
?>

<main id="primary" class="site-main min-h-screen bg-white pt-12 pb-20 px-6">
<?php if ( function_exists( 'fsc_is_elementor_page' ) && fsc_is_elementor_page( get_the_ID() ) ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
endwhile;
	?>
<?php else : ?>
	<div class="max-w-4xl mx-auto">
		<!-- Page Header -->
		<h1 class="text-4xl sm:text-5xl text-slate-900 mb-2 tracking-tight font-light">
			<?php _e( 'Disclosure Policy', 'fsc' ); ?>
		</h1>
		<p class="text-lg text-slate-600 mb-4">
			<?php _e( 'Procurement Transparency & Pricing', 'fsc' ); ?>
		</p>
		<p class="text-sm text-slate-500 mb-12">
			<?php _e( 'Fahad Almansour Consultant Office', 'fsc' ); ?> &bull;
			<?php _e( 'Last updated: January 2026', 'fsc' ); ?>
		</p>

		<div class="prose prose-slate max-w-none space-y-8">

			<!-- Purpose -->
			<section class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
				<h2 class="text-xl text-slate-900 mb-4 font-medium"><?php _e( 'Purpose', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Fahad Almansour Consultant Office is a complete technology partner providing assessment, design, procurement, and delivery services. This Disclosure Policy explains our pricing transparency practices for hardware and software procurement.', 'fsc' ); ?>
				</p>
			</section>

			<!-- 1) Procurement Transparency -->
			<section class="bg-slate-900 text-white rounded-2xl p-8">
				<h2 class="text-2xl mb-4 font-medium"><?php _e( '1) Procurement Transparency', 'fsc' ); ?></h2>
				<p class="leading-relaxed text-slate-200">
					<?php _e( 'All product procurement pricing is transparent. Clients receive a detailed breakdown of products, quantities, unit costs, and FSC service margins before any purchase is made.', 'fsc' ); ?>
				</p>
			</section>

			<!-- 2) Assessment Independence -->
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( '2) Assessment Independence', 'fsc' ); ?></h2>
				<p class="text-sm text-slate-500 mb-3"><?php _e( 'Assessment-First Approach', 'fsc' ); ?></p>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Our assessments are conducted independently of procurement decisions. We assess your actual needs first and recommend solutions based on your requirements — not on product margins or vendor incentives.', 'fsc' ); ?>
				</p>
			</section>

			<!-- 3) Pricing Structure -->
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( '3) Pricing Structure', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed mb-4">
					<?php _e( 'For all hardware and software procurement, clients receive:', 'fsc' ); ?>
				</p>
				<ul class="space-y-3 text-slate-700">
					<li class="flex items-start gap-3">
						<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
						<span><?php _e( 'Detailed product specifications and quantities', 'fsc' ); ?></span>
					</li>
					<li class="flex items-start gap-3">
						<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
						</svg>
						<span><?php _e( 'Clear pricing breakdown before any purchase is made', 'fsc' ); ?></span>
					</li>
				</ul>
				<div class="mt-6 p-4 bg-slate-100 rounded-xl">
					<p class="text-slate-700 font-medium">
						<?php _e( 'No hidden fees, no undisclosed margins. All pricing is agreed in advance.', 'fsc' ); ?>
					</p>
				</div>
			</section>

			<!-- 4) Client Freedom of Choice -->
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( '4) Client Freedom of Choice', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed mb-4">
					<?php _e( 'Clients are always free to:', 'fsc' ); ?>
				</p>
				<ul class="space-y-3 text-slate-700">
					<li class="flex items-start gap-3">
						<span class="w-1.5 h-1.5 bg-slate-400 rounded-full mt-2 flex-shrink-0"></span>
						<span><?php _e( 'Procure through FSC for a complete solution', 'fsc' ); ?></span>
					</li>
					<li class="flex items-start gap-3">
						<span class="w-1.5 h-1.5 bg-slate-400 rounded-full mt-2 flex-shrink-0"></span>
						<span><?php _e( 'Use our assessment only and procure independently', 'fsc' ); ?></span>
					</li>
					<li class="flex items-start gap-3">
						<span class="w-1.5 h-1.5 bg-slate-400 rounded-full mt-2 flex-shrink-0"></span>
						<span><?php _e( 'Request alternative product options at any time', 'fsc' ); ?></span>
					</li>
				</ul>
				<p class="text-slate-700 leading-relaxed mt-4 font-medium">
					<?php _e( 'Clients have no obligation to procure through FSC. Our assessment is valuable regardless of procurement choice.', 'fsc' ); ?>
				</p>
			</section>

			<!-- 5) Product Authenticity -->
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( '5) Product Authenticity & Warranty', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'All hardware and software procured through FSC is certified, genuine, and sourced from authorized distribution channels. Products carry full manufacturer warranty. We do not supply gray market, refurbished, or counterfeit products.', 'fsc' ); ?>
				</p>
			</section>

			<!-- 6) Conflicts of Interest -->
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( '6) Conflicts of Interest', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'We aim to avoid conflicts of interest. Where a potential conflict may exist, we disclose it and document the client\'s acknowledgement.', 'fsc' ); ?>
				</p>
			</section>

			<!-- 7) Contact -->
			<section class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( '7) Contact', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed mb-4">
					<?php _e( 'For questions related to this policy, contact:', 'fsc' ); ?>
				</p>
				<div class="space-y-2">
					<p>
						<a href="mailto:info@fahadalmansourconsulting.com" class="text-slate-900 underline font-medium">
							info@fahadalmansourconsulting.com
						</a>
					</p>
					<p class="text-slate-600">
						<?php _e( 'Privacy inquiries:', 'fsc' ); ?>
						<a href="mailto:privacy@fahadalmansourconsulting.com" class="text-slate-900 underline font-medium">
							privacy@fahadalmansourconsulting.com
						</a>
					</p>
				</div>
			</section>

		</div>
	</div>
<?php endif; ?>
</main>

<?php
get_footer();
