<?php
/**
 * Template Name: Cookie Policy
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
			<?php _e( 'Cookie Policy', 'fsc' ); ?>
		</h1>
		<p class="text-sm text-slate-600 mb-12"><?php _e( 'Last updated: January 2026', 'fsc' ); ?></p>

		<div class="prose prose-slate max-w-none space-y-8">
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'What Are Cookies', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Cookies are small text files stored on your device when you visit a website. They help websites function properly, remember your preferences, and understand how you use the site.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Cookies We Use', 'fsc' ); ?></h2>

				<h3 class="text-lg font-medium text-slate-900 mb-2"><?php _e( 'Essential Cookies', 'fsc' ); ?></h3>
				<p class="text-slate-700 mb-3 text-sm">
					<?php _e( 'These cookies are necessary for the website to function. They enable basic features like page navigation and form submission. You cannot opt out of essential cookies.', 'fsc' ); ?>
				</p>
				<div class="overflow-x-auto mb-6">
					<table class="w-full text-left text-sm border-collapse">
						<thead class="bg-slate-50 text-slate-900">
							<tr>
								<th class="p-3 border border-slate-200"><?php _e( 'Cookie', 'fsc' ); ?></th>
								<th class="p-3 border border-slate-200"><?php _e( 'Purpose', 'fsc' ); ?></th>
								<th class="p-3 border border-slate-200"><?php _e( 'Duration', 'fsc' ); ?></th>
							</tr>
						</thead>
						<tbody class="text-slate-700">
							<tr>
								<td class="p-3 border border-slate-200 font-mono text-xs">session_id</td>
								<td class="p-3 border border-slate-200"><?php _e( 'Maintains your session state', 'fsc' ); ?></td>
								<td class="p-3 border border-slate-200"><?php _e( 'Session', 'fsc' ); ?></td>
							</tr>
							<tr>
								<td class="p-3 border border-slate-200 font-mono text-xs">cookie_consent</td>
								<td class="p-3 border border-slate-200"><?php _e( 'Stores your cookie preferences', 'fsc' ); ?></td>
								<td class="p-3 border border-slate-200"><?php _e( '1 Year', 'fsc' ); ?></td>
							</tr>
						</tbody>
					</table>
				</div>

				<h3 class="text-lg font-medium text-slate-900 mb-2"><?php _e( 'Analytics Cookies (Optional)', 'fsc' ); ?></h3>
				<p class="text-slate-700 mb-3 text-sm">
					<?php _e( 'These cookies help us understand how visitors use our website. They collect aggregated, anonymized data about page views and traffic sources. They are only set if you consent.', 'fsc' ); ?>
				</p>
				<div class="overflow-x-auto">
					<table class="w-full text-left text-sm border-collapse">
						<thead class="bg-slate-50 text-slate-900">
							<tr>
								<th class="p-3 border border-slate-200"><?php _e( 'Cookie', 'fsc' ); ?></th>
								<th class="p-3 border border-slate-200"><?php _e( 'Purpose', 'fsc' ); ?></th>
								<th class="p-3 border border-slate-200"><?php _e( 'Duration', 'fsc' ); ?></th>
							</tr>
						</thead>
						<tbody class="text-slate-700">
							<tr>
								<td class="p-3 border border-slate-200 font-mono text-xs">_ga</td>
								<td class="p-3 border border-slate-200"><?php _e( 'Google Analytics unique ID', 'fsc' ); ?></td>
								<td class="p-3 border border-slate-200"><?php _e( '2 Years', 'fsc' ); ?></td>
							</tr>
							<tr>
								<td class="p-3 border border-slate-200 font-mono text-xs">_gid</td>
								<td class="p-3 border border-slate-200"><?php _e( 'Google Analytics session ID', 'fsc' ); ?></td>
								<td class="p-3 border border-slate-200"><?php _e( '24 Hours', 'fsc' ); ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Your Choices', 'fsc' ); ?></h2>
				<ul class="list-disc pl-5 text-slate-700 space-y-2">
					<li>
						<strong class="text-slate-900"><?php _e( 'Cookie Banner:', 'fsc' ); ?></strong>
						<?php _e( ' When you first visit, you can accept or decline optional cookies.', 'fsc' ); ?>
					</li>
					<li>
						<strong class="text-slate-900"><?php _e( 'Browser Settings:', 'fsc' ); ?></strong>
						<?php _e( ' You can block all cookies via your browser settings.', 'fsc' ); ?>
					</li>
					<li>
						<strong class="text-slate-900"><?php _e( 'Withdraw Consent:', 'fsc' ); ?></strong>
						<?php _e( ' You can clear your cookies and revisit the site to reset your preferences.', 'fsc' ); ?>
					</li>
				</ul>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Third-Party Cookies', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed mb-4">
					<?php _e( 'We use Google Analytics for website analytics. Google\'s privacy policy applies to data collected through their services.', 'fsc' ); ?>
				</p>
				<p class="text-slate-700 italic">
					<?php _e( 'We do not use advertising cookies or allow third-party advertising on our website.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Contact', 'fsc' ); ?></h2>
				<p class="text-slate-700">
					<?php _e( 'Questions about cookies:', 'fsc' ); ?>
					<a href="mailto:privacy@fahadalmansourconsulting.com" class="text-emerald-600 underline">privacy@fahadalmansourconsulting.com</a>
				</p>
			</section>
		</div>
	</div>
<?php endif; ?>
</main>

<?php
get_footer();
