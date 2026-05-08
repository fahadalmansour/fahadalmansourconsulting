<?php
/**
 * Template Name: Privacy Policy
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
			<?php _e( 'Privacy Policy', 'fsc' ); ?>
		</h1>
		<p class="text-sm text-slate-600 mb-12"><?php _e( 'Last updated: January 2026', 'fsc' ); ?></p>

		<div class="prose prose-slate max-w-none space-y-8">
			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Introduction', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Fahad Almansour Consultant Office ("we," "us," or "our") respects your privacy and is committed to protecting your personal data. This Privacy Policy explains how we collect, use, store, and protect information when you use our website or engage our services.', 'fsc' ); ?>
				</p>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'This policy is designed with awareness of the Saudi Personal Data Protection Law (PDPL) and privacy requirements across the Gulf Cooperation Council. We apply consistent privacy practices regardless of where you are located.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Information We Collect', 'fsc' ); ?></h2>

				<h3 class="text-lg font-medium text-slate-900 mb-2"><?php _e( 'Information You Provide', 'fsc' ); ?></h3>
				<ul class="list-disc pl-5 text-slate-700 mb-4 space-y-1">
					<li><?php _e( 'Contact information (name, email address, phone number)', 'fsc' ); ?></li>
					<li><?php _e( 'Professional information (job title, company name, industry)', 'fsc' ); ?></li>
					<li><?php _e( 'Inquiry details (decision type, situation description, timeline)', 'fsc' ); ?></li>
					<li><?php _e( 'Communications you send to us', 'fsc' ); ?></li>
				</ul>

				<h3 class="text-lg font-medium text-slate-900 mb-2"><?php _e( 'Information Collected Automatically', 'fsc' ); ?></h3>
				<ul class="list-disc pl-5 text-slate-700 mb-4 space-y-1">
					<li><?php _e( 'Device and browser information', 'fsc' ); ?></li>
					<li><?php _e( 'IP address and general location (country/region)', 'fsc' ); ?></li>
					<li><?php _e( 'Pages visited and time spent on our website', 'fsc' ); ?></li>
					<li><?php _e( 'Referral source', 'fsc' ); ?></li>
				</ul>

				<h3 class="text-lg font-medium text-slate-900 mb-2"><?php _e( 'We Do Not Collect', 'fsc' ); ?></h3>
				<ul class="list-disc pl-5 text-slate-700 space-y-1">
					<li><?php _e( 'Financial information (we do not process payments on this website)', 'fsc' ); ?></li>
					<li><?php _e( 'Sensitive personal data unless specifically required for an engagement', 'fsc' ); ?></li>
				</ul>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'How We Use Your Information', 'fsc' ); ?></h2>
				<div class="space-y-4">
					<div>
						<strong class="text-slate-900"><?php _e( 'To Respond to Inquiries:', 'fsc' ); ?></strong>
						<span class="text-slate-700"><?php _e( ' When you submit a contact form or request a decision session, we use your information to respond and schedule discussions.', 'fsc' ); ?></span>
					</div>
					<div>
						<strong class="text-slate-900"><?php _e( 'To Provide Advisory Services:', 'fsc' ); ?></strong>
						<span class="text-slate-700"><?php _e( ' If you engage our services, we use information necessary to deliver the agreed advisory deliverables.', 'fsc' ); ?></span>
					</div>
					<div>
						<strong class="text-slate-900"><?php _e( 'To Improve Our Website:', 'fsc' ); ?></strong>
						<span class="text-slate-700"><?php _e( ' We analyze aggregated, anonymized data to understand how visitors use our website and improve the experience.', 'fsc' ); ?></span>
					</div>
				</div>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Legal Basis for Processing', 'fsc' ); ?></h2>
				<ul class="list-disc pl-5 text-slate-700 space-y-2">
					<li>
						<strong class="text-slate-900"><?php _e( 'Consent:', 'fsc' ); ?></strong>
						<?php _e( ' When you submit a form on our website, you provide consent for us to process your data for the stated purposes. You may withdraw consent at any time.', 'fsc' ); ?>
					</li>
					<li>
						<strong class="text-slate-900"><?php _e( 'Contractual Necessity:', 'fsc' ); ?></strong>
						<?php _e( ' When you engage our advisory services, we process data necessary to fulfill our contractual obligations.', 'fsc' ); ?>
					</li>
					<li>
						<strong class="text-slate-900"><?php _e( 'Legitimate Interests:', 'fsc' ); ?></strong>
						<?php _e( ' We may process data for our legitimate business interests, provided this does not override your rights.', 'fsc' ); ?>
					</li>
				</ul>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Data Retention', 'fsc' ); ?></h2>
				<p class="text-slate-700 mb-4"><?php _e( 'We retain your personal data only as long as necessary:', 'fsc' ); ?></p>
				<ul class="list-disc pl-5 text-slate-700 space-y-1">
					<li><?php _e( 'Inquiry data: 12 months from last contact, unless an engagement begins', 'fsc' ); ?></li>
					<li><?php _e( 'Engagement data: Duration of engagement plus 5 years for legal/professional purposes', 'fsc' ); ?></li>
					<li><?php _e( 'Website analytics: Aggregated, anonymized data retained indefinitely', 'fsc' ); ?></li>
				</ul>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Your Rights', 'fsc' ); ?></h2>
				<p class="text-slate-700 mb-4"><?php _e( 'You have the following rights regarding your personal data:', 'fsc' ); ?></p>
				<ul class="grid sm:grid-cols-2 gap-4 text-slate-700">
					<li class="flex items-center gap-2">
						<svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
						<?php _e( 'Right to Access', 'fsc' ); ?>
					</li>
					<li class="flex items-center gap-2">
						<svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
						<?php _e( 'Right to Correction', 'fsc' ); ?>
					</li>
					<li class="flex items-center gap-2">
						<svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
						<?php _e( 'Right to Deletion', 'fsc' ); ?>
					</li>
					<li class="flex items-center gap-2">
						<svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
						<?php _e( 'Right to Withdraw Consent', 'fsc' ); ?>
					</li>
				</ul>
				<p class="text-slate-700 mt-4">
					<?php _e( 'To exercise any of these rights, contact us at', 'fsc' ); ?>
					<a href="mailto:privacy@fahadalmansourconsulting.com" class="text-emerald-600 underline">privacy@fahadalmansourconsulting.com</a>.
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Data Sharing', 'fsc' ); ?></h2>
				<p class="text-slate-700 mb-4"><?php _e( 'We do not sell, rent, or trade your personal data. We may share data with:', 'fsc' ); ?></p>
				<ul class="list-disc pl-5 text-slate-700 space-y-2">
					<li>
						<strong class="text-slate-900"><?php _e( 'Service Providers:', 'fsc' ); ?></strong>
						<?php _e( ' Third parties who assist with website hosting, email services, or analytics (contractually bound to protect data).', 'fsc' ); ?>
					</li>
					<li>
						<strong class="text-slate-900"><?php _e( 'Legal Requirements:', 'fsc' ); ?></strong>
						<?php _e( ' When required by law or regulation.', 'fsc' ); ?>
					</li>
				</ul>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'International Data', 'fsc' ); ?></h2>
				<p class="text-slate-700 leading-relaxed">
					<?php _e( 'Our company is based in Riyadh, Saudi Arabia. If you are located in the GCC or elsewhere, your data may be transferred to and processed in Saudi Arabia. We apply consistent privacy protections regardless of where data is processed.', 'fsc' ); ?>
				</p>
			</section>

			<section>
				<h2 class="text-2xl text-slate-900 mb-4 font-medium"><?php _e( 'Contact', 'fsc' ); ?></h2>
				<p class="text-slate-700">
					<strong class="block text-slate-900 mb-1"><?php _e( 'Privacy Inquiries:', 'fsc' ); ?></strong>
					<a href="mailto:privacy@fahadalmansourconsulting.com" class="text-emerald-600 underline">privacy@fahadalmansourconsulting.com</a>
				</p>
			</section>

		</div>
	</div>
<?php endif; ?>
</main>

<?php
get_footer();
