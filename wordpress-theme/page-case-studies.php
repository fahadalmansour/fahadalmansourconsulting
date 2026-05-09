<?php
/**
 * Template Name: Case Studies
 *
 * Client Engagements / Case Studies page
 *
 * @package FSC_Theme
 */

get_header();
$is_rtl = is_rtl();
?>

<main id="primary" class="site-main">
<?php if ( function_exists( 'fsc_is_elementor_page' ) && fsc_is_elementor_page( get_the_ID() ) ) : ?>
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
endwhile;
	?>
<?php else : ?>
	<!-- Hero Section -->
	<section class="py-20 px-6 bg-slate-50">
		<div class="max-w-4xl mx-auto text-center">
			<h1 class="text-5xl font-light tracking-tight mb-6 text-slate-900">
				<?php _e( 'Client Engagements', 'fsc' ); ?>
			</h1>
			<p class="text-xl text-slate-600 max-w-2xl mx-auto">
				<?php _e( 'Examples of how we\'ve helped organizations make informed technology decisions. Details anonymized to protect client confidentiality.', 'fsc' ); ?>
			</p>
		</div>
	</section>

	<!-- Case Studies -->
	<section class="py-16 px-6 bg-white">
		<div class="max-w-4xl mx-auto">

			<!-- Case Study 1 -->
			<article class="mb-16 pb-16 border-b border-slate-200">
				<div class="flex flex-wrap gap-3 mb-6">
					<span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full"><?php _e( 'Financial Services', 'fsc' ); ?></span>
					<span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full"><?php _e( 'GCC Region', 'fsc' ); ?></span>
					<span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full"><?php _e( '6 Weeks', 'fsc' ); ?></span>
				</div>

				<h2 class="text-3xl font-light text-slate-900 mb-6">
					<?php _e( 'Cloud Migration Strategy for Regional Bank', 'fsc' ); ?>
				</h2>

				<!-- Situation -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Situation', 'fsc' ); ?></h3>
					<p class="text-slate-600 leading-relaxed">
						<?php _e( 'A regional bank with operations across three GCC countries needed to modernize its core infrastructure. The technology team favored a full cloud migration, while risk and compliance raised concerns about data sovereignty and regulatory requirements.', 'fsc' ); ?>
					</p>
				</div>

				<!-- Decision Required -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Decision Required', 'fsc' ); ?></h3>
					<p class="text-slate-600 leading-relaxed">
						<?php _e( 'Determine the appropriate infrastructure approach: full cloud migration, hybrid architecture, or modernized on-premise with cloud-native applications.', 'fsc' ); ?>
					</p>
				</div>

				<!-- Our Approach -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Our Approach', 'fsc' ); ?></h3>
					<ul class="space-y-2 text-slate-600">
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Conducted stakeholder interviews across technology, risk, compliance, and business units', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Mapped regulatory requirements across all operating jurisdictions', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Evaluated three cloud providers plus regional data center options', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Developed three architecture options with distinct trade-offs', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Analyzed total cost of ownership over 5-year horizon', 'fsc' ); ?></span>
						</li>
					</ul>
				</div>

				<!-- Options Presented -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-4"><?php _e( 'Options Presented', 'fsc' ); ?></h3>
					<div class="grid md:grid-cols-3 gap-4">
						<div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
							<h4 class="font-medium text-slate-900 mb-2"><?php _e( 'Option A: Full Public Cloud', 'fsc' ); ?></h4>
							<p class="text-sm text-slate-600"><?php _e( 'Lower capital expenditure, faster deployment, but required regulatory approvals and data residency solutions.', 'fsc' ); ?></p>
						</div>
						<div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
							<h4 class="font-medium text-slate-900 mb-2"><?php _e( 'Option B: Hybrid Architecture', 'fsc' ); ?></h4>
							<p class="text-sm text-slate-600"><?php _e( 'Core banking on-premise, customer-facing applications in cloud. Balanced approach with moderate complexity.', 'fsc' ); ?></p>
						</div>
						<div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
							<h4 class="font-medium text-slate-900 mb-2"><?php _e( 'Option C: Modernized Private Cloud', 'fsc' ); ?></h4>
							<p class="text-sm text-slate-600"><?php _e( 'On-premise infrastructure with cloud-native technologies. Highest control, highest capital requirement.', 'fsc' ); ?></p>
						</div>
					</div>
				</div>

				<!-- Outcome -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Outcome', 'fsc' ); ?></h3>
					<p class="text-slate-600 leading-relaxed">
						<?php _e( 'The bank selected Option B (Hybrid Architecture) based on the trade-off analysis. Our recommendation aligned with this choice due to regulatory constraints and the bank\'s risk tolerance. The bank engaged a systems integrator for implementation using our requirements documentation and vendor evaluation framework.', 'fsc' ); ?>
					</p>
				</div>

				<!-- Deliverables -->
				<div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
					<h3 class="text-lg font-medium text-slate-900 mb-4"><?php _e( 'Deliverables Provided', 'fsc' ); ?></h3>
					<ul class="grid md:grid-cols-2 gap-3">
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Infrastructure options analysis (47 pages)', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Regulatory requirements matrix', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Vendor evaluation scorecard', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Implementation sequencing recommendations', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Risk register with mitigation strategies', 'fsc' ); ?></span>
						</li>
					</ul>
				</div>
			</article>

			<!-- Case Study 2 -->
			<article class="mb-16">
				<div class="flex flex-wrap gap-3 mb-6">
					<span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full"><?php _e( 'Manufacturing', 'fsc' ); ?></span>
					<span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full"><?php _e( 'Saudi Arabia', 'fsc' ); ?></span>
					<span class="px-3 py-1 bg-slate-100 text-slate-700 text-sm rounded-full"><?php _e( '4 Weeks', 'fsc' ); ?></span>
				</div>

				<h2 class="text-3xl font-light text-slate-900 mb-6">
					<?php _e( 'ERP Platform Selection for Manufacturing Group', 'fsc' ); ?>
				</h2>

				<!-- Situation -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Situation', 'fsc' ); ?></h3>
					<p class="text-slate-600 leading-relaxed">
						<?php _e( 'A manufacturing group operating five facilities was running disparate legacy systems across sites. Leadership approved an ERP consolidation initiative but faced conflicting vendor recommendations from different stakeholders.', 'fsc' ); ?>
					</p>
				</div>

				<!-- Decision Required -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Decision Required', 'fsc' ); ?></h3>
					<p class="text-slate-600 leading-relaxed">
						<?php _e( 'Select an ERP platform and implementation approach from three shortlisted vendors, considering Saudi localization requirements and Vision 2030 compliance.', 'fsc' ); ?></p>
				</div>

				<!-- Our Approach -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Our Approach', 'fsc' ); ?></h3>
					<ul class="space-y-2 text-slate-600">
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Documented business requirements across all five facilities', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Evaluated shortlisted vendors against 86 functional and technical criteria', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Assessed Saudi localization capabilities including Zakat, VAT, and Arabic language support', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Conducted reference checks with regional implementations', 'fsc' ); ?></span>
						</li>
						<li class="flex items-start gap-3">
							<svg class="w-5 h-5 text-slate-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
							</svg>
							<span><?php _e( 'Analyzed implementation approaches and timeline options', 'fsc' ); ?></span>
						</li>
					</ul>
				</div>

				<!-- Options Presented -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-4"><?php _e( 'Options Presented', 'fsc' ); ?></h3>
					<div class="grid md:grid-cols-3 gap-4">
						<div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
							<h4 class="font-medium text-slate-900 mb-2"><?php _e( 'Vendor A: Global Leader', 'fsc' ); ?></h4>
							<p class="text-sm text-slate-600"><?php _e( 'Most comprehensive functionality, highest cost, longest implementation timeline, limited local support.', 'fsc' ); ?></p>
						</div>
						<div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
							<h4 class="font-medium text-slate-900 mb-2"><?php _e( 'Vendor B: Regional Strong', 'fsc' ); ?></h4>
							<p class="text-sm text-slate-600"><?php _e( 'Strong Saudi presence, good localization, moderate functionality, competitive pricing.', 'fsc' ); ?></p>
						</div>
						<div class="bg-slate-50 p-5 rounded-xl border border-slate-200">
							<h4 class="font-medium text-slate-900 mb-2"><?php _e( 'Vendor C: Cloud-Native', 'fsc' ); ?></h4>
							<p class="text-sm text-slate-600"><?php _e( 'Modern architecture, fastest deployment, but required process changes to fit standard workflows.', 'fsc' ); ?></p>
						</div>
					</div>
				</div>

				<!-- Outcome -->
				<div class="mb-8">
					<h3 class="text-lg font-medium text-slate-900 mb-3"><?php _e( 'Outcome', 'fsc' ); ?></h3>
					<p class="text-slate-600 leading-relaxed">
						<?php _e( 'The manufacturing group selected Vendor B based on the combination of Saudi localization strength, regional support presence, and acceptable functionality coverage. Our trade-off analysis highlighted that Vendor A\'s additional features did not justify the cost premium for this client\'s requirements.', 'fsc' ); ?>
					</p>
				</div>

				<!-- Deliverables -->
				<div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
					<h3 class="text-lg font-medium text-slate-900 mb-4"><?php _e( 'Deliverables Provided', 'fsc' ); ?></h3>
					<ul class="grid md:grid-cols-2 gap-3">
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Vendor evaluation matrix (86 criteria)', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Functional gap analysis', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Reference check summary', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Implementation approach comparison', 'fsc' ); ?></span>
						</li>
						<li class="flex items-center gap-2 text-slate-600">
							<svg class="w-5 h-5 text-emerald-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
							</svg>
							<span class="text-sm"><?php _e( 'Contract negotiation considerations', 'fsc' ); ?></span>
						</li>
					</ul>
				</div>
			</article>

		</div>
	</section>

	<!-- Confidentiality Note -->
	<section class="py-12 px-6 bg-slate-50 border-y border-slate-200">
		<div class="max-w-4xl mx-auto">
			<div class="flex items-start gap-4">
				<div class="flex-shrink-0 w-10 h-10 bg-slate-200 rounded-full flex items-center justify-center">
					<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
					</svg>
				</div>
				<div>
					<h3 class="font-medium text-slate-900 mb-2"><?php _e( 'Confidentiality Note', 'fsc' ); ?></h3>
					<p class="text-slate-600">
						<?php _e( 'Client identities, specific financial figures, and proprietary details are not disclosed. These case studies represent the type and scope of our engagements while protecting client confidentiality.', 'fsc' ); ?>
					</p>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA Section -->
	<section class="py-20 px-6 bg-white">
		<div class="max-w-3xl mx-auto text-center">
			<h2 class="text-4xl font-light tracking-tight mb-6 text-slate-900">
				<?php _e( 'Discuss Your Decision', 'fsc' ); ?>
			</h2>
			<p class="text-xl text-slate-600 mb-8">
				<?php _e( 'Every organization\'s situation is unique. Share your technology decision challenge and we\'ll discuss how a structured approach might help.', 'fsc' ); ?>
			</p>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary text-lg px-8 py-4">
				<?php _e( 'Request a Decision Session', 'fsc' ); ?>
			</a>
			<p class="text-sm text-slate-500 mt-4">
				<?php _e( 'We respond within one business day.', 'fsc' ); ?>
			</p>
		</div>
	</section>
<?php endif; ?>
</main>

<?php
get_footer();
