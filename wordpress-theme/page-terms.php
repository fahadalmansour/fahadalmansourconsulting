<?php
/**
 * Template Name: Terms of Use
 *
 * @package FSC_Theme
 */

get_header();
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
		<h1 class="text-4xl sm:text-5xl text-slate-900 mb-4 tracking-tight font-light">
			<?php _e( 'Terms of Use', 'fsc' ); ?>
		</h1>
		<p class="text-sm text-slate-600 mb-12"><?php _e( 'Last updated: January 11, 2026', 'fsc' ); ?></p>

		<div class="prose prose-slate max-w-none space-y-8">
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Acceptance of terms', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'By accessing and using this website (fahadalmansourconsulting.com), you accept and agree to be bound by these Terms of Use. If you do not agree to these terms, please do not use this website.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Website usage', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed mb-4">
					<?php _e( 'You agree to use this website only for lawful purposes and in a way that does not infringe the rights of, restrict, or inhibit anyone else\'s use of the website. Prohibited behavior includes:', 'fsc' ); ?>
				</p>
				<ul class="space-y-2 text-slate-700">
					<li class="flex items-start gap-3">
						<span class="w-1.5 h-1.5 bg-slate-400 rounded-full mt-2 flex-shrink-0"></span>
						<span><?php _e( 'Harassing, threatening, or intimidating others', 'fsc' ); ?></span>
					</li>
					<li class="flex items-start gap-3">
						<span class="w-1.5 h-1.5 bg-slate-400 rounded-full mt-2 flex-shrink-0"></span>
						<span><?php _e( 'Transmitting harmful, unlawful, or objectionable material', 'fsc' ); ?></span>
					</li>
					<li class="flex items-start gap-3">
						<span class="w-1.5 h-1.5 bg-slate-400 rounded-full mt-2 flex-shrink-0"></span>
						<span><?php _e( 'Attempting to gain unauthorized access to our systems', 'fsc' ); ?></span>
					</li>
				</ul>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Intellectual property', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'All content on this website, including text, graphics, logos, and images, is the property of Fahad Almansour Consultant Office or its content suppliers and is protected by intellectual property laws. You may not reproduce, distribute, or create derivative works from this content without our prior written permission.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Advisory services disclaimer', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Fahad Almansour Consultant Office provides IT consulting services. All information on this website is for general informational purposes and does not constitute professional advice for your specific situation. Consulting engagements are governed by separate service agreements.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'No warranties', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'This website is provided "as is" without any representations or warranties, express or implied. We make no representations or warranties regarding the completeness, accuracy, reliability, suitability, or availability of the website or the information contained on it.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Limitation of liability', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Fahad Almansour Consultant Office shall not be liable for any indirect, incidental, special, consequential, or punitive damages arising out of or relating to your use of, or inability to use, this website. Our total liability shall not exceed the amount you paid us (if any) for using our services.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Third-party links', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'This website may contain links to third-party websites. These links are provided for your convenience only. We have no control over the content of third-party websites and accept no responsibility for them or for any loss or damage that may arise from your use of them.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Changes to terms', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'We reserve the right to modify these Terms of Use at any time. Changes will be effective immediately upon posting to this website. Your continued use of the website after any changes constitutes your acceptance of the new terms.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Governing law', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'These Terms of Use shall be governed by and construed in accordance with the laws of Riyadh, Saudi Arabia. Any disputes arising from these terms shall be subject to the exclusive jurisdiction of the courts of Riyadh, Saudi Arabia.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Contact', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'For questions about these Terms of Use, please contact us at', 'fsc' ); ?>
					<a href="mailto:info@fahadalmansourconsulting.com" class="text-slate-900 underline font-medium">
						info@fahadalmansourconsulting.com
					</a>
				</p>
			</section>
		</div>
	</div>
<?php endif; ?>
</main>

<?php
get_footer();
