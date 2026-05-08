<?php
/**
 * Fahad Almansour Consultant Office - Theme Shortcodes
 *
 * @package FSC_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
============================================
	SHORTCODES: Homepage Sections
	============================================ */

/**
 * 1. HERO SECTION
 * [fsc_hero]
 *
 * Includes A/B testing for:
 * - hero_headline: Main headline text
 * - hero_subheadline: Description text
 * - cta_button: Primary CTA button text
 */
function fsc_hero_shortcode() {
	ob_start();

	// Get A/B test variants (falls back to defaults if A/B testing not active)
	$headline    = function_exists( 'fsc_ab' ) ? fsc_ab( 'hero_headline' ) : '';
	$subheadline = function_exists( 'fsc_ab' ) ? fsc_ab( 'hero_subheadline' ) : '';
	$cta_text    = function_exists( 'fsc_ab' ) ? fsc_ab( 'cta_button' ) : '';

	// Fallback to standard translations if A/B test returns empty
	if ( empty( $headline ) ) {
		$headline = __( 'Your Complete Technology Partner', 'fsc' );
	}
	if ( empty( $subheadline ) ) {
		$subheadline = __( 'We bridge the gap between your business needs and the complex IT market. Assessment, solution design, and certified hardware and software — delivered ready for your environment.', 'fsc' );
	}
	if ( empty( $cta_text ) ) {
		$cta_text = __( 'Request a Consultation', 'fsc' );
	}

	// Get variant keys for tracking
	$headline_variant = function_exists( 'fsc_ab_variant' ) ? fsc_ab_variant( 'hero_headline' ) : '';
	$cta_variant      = function_exists( 'fsc_ab_variant' ) ? fsc_ab_variant( 'cta_button' ) : '';
	?>
	<section class="py-20 px-6 bg-white relative overflow-hidden">
		<!-- Subtle background pattern -->
		<div class="absolute inset-0 opacity-[0.02]" style="background-image: url('data:image/svg+xml,%3Csvg width=%2260%22 height=%2260%22 viewBox=%220 0 60 60%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cg fill=%22none%22 fill-rule=%22evenodd%22%3E%3Cg fill=%22%230f172a%22 fill-opacity=%221%22%3E%3Cpath d=%22M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

		<div class="max-w-4xl mx-auto text-center mb-16 relative animate-slide-up">
			<p class="text-sm font-medium text-slate-500 uppercase tracking-wider mb-4"><?php _e( 'Fahad Almansour Consulting', 'fsc' ); ?></p>
			<h1 class="text-5xl sm:text-6xl font-light tracking-tight mb-6 text-slate-900" data-ab-test="hero_headline" data-ab-variant="<?php echo esc_attr( $headline_variant ); ?>">
				<?php echo esc_html( $headline ); ?>
			</h1>
			<p class="text-xl text-slate-600 mb-12 max-w-2xl mx-auto leading-relaxed" data-ab-test="hero_subheadline">
				<?php echo esc_html( $subheadline ); ?>
			</p>
			<div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary" data-ab-test="cta_button" data-ab-variant="<?php echo esc_attr( $cta_variant ); ?>" onclick="if(typeof fscTrackConversion === 'function') fscTrackConversion('cta_button');">
					<?php echo esc_html( $cta_text ); ?>
					<svg class="w-4 h-4 ml-2 rtl:ml-0 rtl:mr-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
					</svg>
				</a>
				<a href="#how-we-work" class="btn btn-secondary">
					<?php _e( 'See How We Work', 'fsc' ); ?>
				</a>
			</div>
		</div>

		<div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto text-center relative">
			<div class="animate-fade-in" style="animation-delay: 0.1s">
				<div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
					<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
					</svg>
				</div>
				<p class="font-medium mb-2 text-slate-900"><?php _e( 'End-to-End Solutions', 'fsc' ); ?></p>
				<p class="text-sm text-slate-600"><?php _e( 'From assessment to delivery, we handle every step of your technology journey', 'fsc' ); ?></p>
			</div>
			<div class="animate-fade-in" style="animation-delay: 0.2s">
				<div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
					<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
					</svg>
				</div>
				<p class="font-medium mb-2 text-slate-900"><?php _e( 'Certified Products', 'fsc' ); ?></p>
				<p class="text-sm text-slate-600"><?php _e( 'Direct access to certified hardware and software from leading manufacturers', 'fsc' ); ?></p>
			</div>
			<div class="animate-fade-in" style="animation-delay: 0.3s">
				<div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-3">
					<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
					</svg>
				</div>
				<p class="font-medium mb-2 text-slate-900"><?php _e( 'Single Accountability', 'fsc' ); ?></p>
				<p class="text-sm text-slate-600"><?php _e( 'One partner responsible for your entire project — no finger-pointing', 'fsc' ); ?></p>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_hero', 'fsc_hero_shortcode' );

/**
 * 2. HOW WE WORK
 * [fsc_how_we_work]
 */
function fsc_how_we_work_shortcode() {
	ob_start();
	$steps = array(
		array( '01', __( 'Context & Constraints', 'fsc' ), __( 'We understand your business objectives, technical environment, regulatory requirements, and organizational constraints.', 'fsc' ) ),
		array( '02', __( 'Options Development', 'fsc' ), __( 'We develop 2-3 viable approaches, each with distinct trade-offs in cost, risk, timeline, and capability.', 'fsc' ) ),
		array( '03', __( 'Trade-off Analysis', 'fsc' ), __( 'We document the implications of each option clearly, enabling informed comparison without bias toward any vendor or approach.', 'fsc' ) ),
		array( '04', __( 'Decision Framework', 'fsc' ), __( 'We deliver a structured recommendation with rationale, risk considerations, and implementation guidance for your team.', 'fsc' ) ),
	);
	?>
	<section id="how-we-work" class="py-16 px-6 bg-white">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'A Structured Approach to Technology Decisions', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Our methodology ensures informed, documented decisions.', 'fsc' ); ?></p>
			</div>
			<div class="grid gap-4">
				<?php foreach ( $steps as $step ) : ?>
				<div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
					<div class="flex items-start gap-6">
						<div class="text-3xl font-light text-slate-400"><?php echo $step[0]; ?></div>
						<div>
							<h3 class="text-xl font-medium mb-2 text-slate-900"><?php echo $step[1]; ?></h3>
							<p class="text-slate-600"><?php echo $step[2]; ?></p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_how_we_work', 'fsc_how_we_work_shortcode' );

/**
 * NEUTRALITY & VENDOR INTRODUCTIONS CARD
 * [fsc_neutrality_card]
 */
function fsc_neutrality_card_shortcode() {
	ob_start();
	?>
	<section class="py-10 px-6 bg-slate-50 border-t border-b border-slate-200">
		<div class="max-w-4xl mx-auto">
			<div class="bg-white border border-slate-200 rounded-2xl p-8 text-center" style="box-shadow: var(--shadow-sm);">
				<h3 class="text-2xl font-medium mb-4 text-slate-900"><?php _e( 'The FSC Advantage', 'fsc' ); ?></h3>
				<p class="text-slate-600 mb-4"><?php _e( 'We assess, design, procure, and deliver complete technology solutions. As an authorized partner of leading manufacturers, we provide certified products at competitive prices with full warranty and support.', 'fsc' ); ?></p>
				<p class="text-slate-600">
					<?php _e( 'All procurement pricing is', 'fsc' ); ?>
					<strong><?php _e( 'transparent and documented in advance', 'fsc' ); ?></strong>.
					<?php _e( 'You receive certified products delivered ready for your environment.', 'fsc' ); ?>
					<a href="<?php echo esc_url( home_url( '/disclosure/' ) ); ?>" class="text-emerald-600 hover:text-emerald-700"><?php _e( 'Read our procurement transparency policy', 'fsc' ); ?></a>
				</p>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_neutrality_card', 'fsc_neutrality_card_shortcode' );

/**
 * 3. DECISION AREAS
 * [fsc_decision_areas]
 */
function fsc_decision_areas_shortcode() {
	ob_start();
	$areas = array(
		array(
			'title' => __( 'Cloud & Infrastructure', 'fsc' ),
			'desc'  => __( 'We assess your infrastructure, design the right cloud or on-premise solution, and supply the hardware and software to make it happen.', 'fsc' ),
			'items' => array( __( 'Cloud migration', 'fsc' ), __( 'Hybrid solutions', 'fsc' ), __( 'Hardware procurement', 'fsc' ) ),
		),
		array(
			'title' => __( 'Security & Compliance', 'fsc' ),
			'desc'  => __( 'Security assessments, ISO gap analysis, and certified security solutions — from evaluation through procurement.', 'fsc' ),
			'items' => array( __( 'Security audits', 'fsc' ), __( 'ISO compliance', 'fsc' ), __( 'Security solutions', 'fsc' ) ),
		),
		array(
			'title' => __( 'Digital Presence', 'fsc' ),
			'desc'  => __( 'Domain, hosting, e-commerce platforms, and the tools your business needs — assessed, selected, and delivered.', 'fsc' ),
			'items' => array( __( 'E-commerce platforms', 'fsc' ), __( 'Website hosting', 'fsc' ), __( 'Digital tools', 'fsc' ) ),
		),
		array(
			'title' => __( 'Hardware & Software', 'fsc' ),
			'desc'  => __( 'End-to-end procurement of certified technology products tailored to your exact requirements.', 'fsc' ),
			'items' => array( __( 'Servers & networking', 'fsc' ), __( 'Software licenses', 'fsc' ), __( 'Workstations', 'fsc' ) ),
		),
	);
	?>
	<section id="decision-areas" class="py-16 px-6 bg-slate-50">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Our Solutions', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'End-to-end technology solutions. We assess, design, procure, and deliver.', 'fsc' ); ?></p>
			</div>
			<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
				<?php foreach ( $areas as $area ) : ?>
				<div class="bg-white rounded-2xl p-8 border border-slate-200">
					<h3 class="text-xl font-medium mb-4 text-slate-900"><?php echo $area['title']; ?></h3>
					<p class="text-slate-600 mb-6"><?php echo $area['desc']; ?></p>
					<ul class="space-y-3">
						<?php foreach ( $area['items'] as $item ) : ?>
						<li class="flex items-center gap-3">
							<div class="w-1.5 h-1.5 bg-slate-400 rounded-full"></div>
							<span class="text-sm text-slate-600"><?php echo $item; ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_decision_areas', 'fsc_decision_areas_shortcode' );

/**
 * 4. REFERENCE ARCHITECTURE
 * [fsc_reference_architecture]
 */
function fsc_ref_arch_shortcode() {
	ob_start();
	$layers = array(
		__( 'Users/Branches', 'fsc' ),
		__( 'Identity & Access', 'fsc' ),
		__( 'Network', 'fsc' ),
		__( 'Apps', 'fsc' ),
		__( 'Data', 'fsc' ),
		__( 'Monitoring/Backups', 'fsc' ),
	);
	$is_rtl = is_rtl();
	?>
	<section id="reference-architecture" class="py-16 px-6 bg-white">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Reference Architecture', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'We help you think through the full stack.', 'fsc' ); ?></p>
			</div>
			<div class="bg-slate-50 rounded-3xl p-8 border border-slate-200">
				<div class="flex flex-col lg:flex-row items-center justify-between gap-6">
					<?php foreach ( $layers as $index => $layer ) : ?>
						<div class="flex items-center gap-6 w-full lg:w-auto">
							<div class="flex-1 lg:flex-initial">
								<div class="bg-white rounded-xl px-6 py-5 border border-slate-200 text-center min-w-[140px]">
									<p class="text-slate-900 font-medium text-sm whitespace-nowrap"><?php echo $layer; ?></p>
								</div>
							</div>
							<?php if ( $index < count( $layers ) - 1 ) : ?>
								<div class="hidden lg:block text-slate-400">
									<?php echo $is_rtl ? fsc_get_icon( 'arrow-left' ) : fsc_get_icon( 'arrow-right' ); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="mt-8 pt-8 border-t border-slate-200 text-center">
					<p class="text-sm text-slate-600"><?php _e( 'High-level view only. We document responsibilities for each layer.', 'fsc' ); ?></p>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_reference_architecture', 'fsc_ref_arch_shortcode' );

/**
 * 5. TOOLS & STANDARDS
 * [fsc_tools_standards]
 */
function fsc_tools_shortcode() {
	ob_start();
	$cats = array(
		array( __( 'SSO/MFA', 'fsc' ), __( 'Identity federation, multi-factor authentication', 'fsc' ) ),
		array( __( 'Monitoring', 'fsc' ), __( 'Infrastructure metrics, application logs', 'fsc' ) ),
		array( __( 'Backups (RPO/RTO)', 'fsc' ), __( 'Recovery point objectives, testing cadence', 'fsc' ) ),
		array( __( 'Security Baseline', 'fsc' ), __( 'Patching, hardening, access controls', 'fsc' ) ),
		array( __( 'Cloud Cost Controls', 'fsc' ), __( 'Budget alerts, resource tagging', 'fsc' ) ),
		array( __( 'Network', 'fsc' ), __( 'VPN, direct connect, segmentation', 'fsc' ) ),
	);
	?>
	<section id="tools-standards" class="py-16 px-6 bg-slate-50">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Tools & Standards', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Clarifying requirements without pushing vendors.', 'fsc' ); ?></p>
			</div>
			<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php foreach ( $cats as $cat ) : ?>
				<div class="bg-white rounded-xl p-6 border border-slate-200">
					<h3 class="text-slate-900 font-medium mb-2"><?php echo $cat[0]; ?></h3>
					<p class="text-sm text-slate-600"><?php echo $cat[1]; ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_tools_standards', 'fsc_tools_shortcode' );

/**
 * 6. WHAT YOU RECEIVE
 * [fsc_what_you_receive]
 */
function fsc_deliverables_shortcode() {
	ob_start();
	$items = array(
		array( __( 'Requirements Assessment Report', 'fsc' ), __( 'Detailed analysis of your business and technology needs with clear recommendations.', 'fsc' ) ),
		array( __( 'Solution Design Document', 'fsc' ), __( 'Architecture and product specifications tailored to your environment.', 'fsc' ) ),
		array( __( 'Options Comparison Matrix', 'fsc' ), __( 'Side-by-side comparison of evaluated alternatives with pricing.', 'fsc' ) ),
		array( __( 'Certified Hardware & Software', 'fsc' ), __( 'Procured and delivered directly, ready for deployment in your environment.', 'fsc' ) ),
		array( __( 'Single Point of Accountability', 'fsc' ), __( 'One partner from assessment through delivery and beyond.', 'fsc' ) ),
	);
	?>
	<section id="what-you-receive" class="py-16 px-6 bg-white">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'What You Receive', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Structured deliverables from assessment through delivery.', 'fsc' ); ?></p>
			</div>
			<div class="space-y-3">
				<?php foreach ( $items as $idx => $item ) : ?>
				<div class="bg-slate-50 rounded-xl p-6 border border-slate-200">
					<div class="flex items-start gap-4">
						<div class="flex-shrink-0 w-8 h-8 bg-slate-900 text-white rounded-lg flex items-center justify-center text-sm font-medium">
							<?php echo $idx + 1; ?>
						</div>
						<div>
							<h3 class="text-slate-900 font-medium mb-1"><?php echo $item[0]; ?></h3>
							<p class="text-sm text-slate-600"><?php echo $item[1]; ?></p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_what_you_receive', 'fsc_deliverables_shortcode' );

/**
 * 7. ADVISORY SERVICES
 * [fsc_advisory_services]
 */
function fsc_advisory_services_shortcode() {
	ob_start();
	?>
	<section id="advisory-services" class="py-16 px-6 bg-slate-50">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Engagement Models', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Flexible options from assessment-only to full solution delivery.', 'fsc' ); ?></p>
			</div>

			<div class="grid lg:grid-cols-3 gap-6">
				<!-- Assessment Only -->
				<div class="bg-white rounded-2xl p-10 border border-slate-200">
					<h3 class="text-2xl font-medium mb-4 text-slate-900"><?php _e( 'Assessment Only', 'fsc' ); ?></h3>
					<p class="text-slate-600 mb-8"><?php _e( 'We assess your requirements and deliver a detailed report with recommendations. You handle procurement and implementation independently.', 'fsc' ); ?></p>
					<div class="pt-6 border-t border-slate-200">
						<p class="text-slate-900 font-medium mb-1"><?php _e( 'Ideal when you have internal procurement capability.', 'fsc' ); ?></p>
					</div>
				</div>
				<!-- Assessment + Procurement -->
				<div class="bg-white rounded-2xl p-10 border border-slate-200 ring-2 ring-slate-900">
					<div class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-4"><?php _e( 'Most Popular', 'fsc' ); ?></div>
					<h3 class="text-2xl font-medium mb-4 text-slate-900"><?php _e( 'Assessment + Procurement', 'fsc' ); ?></h3>
					<p class="text-slate-600 mb-8"><?php _e( 'We assess your needs, design the solution, and procure certified hardware and software — delivered ready for your environment.', 'fsc' ); ?></p>
					<div class="pt-6 border-t border-slate-200">
						<p class="text-slate-900 font-medium mb-1"><?php _e( 'The complete solution for most businesses.', 'fsc' ); ?></p>
					</div>
				</div>
				<!-- Enterprise Solution -->
				<div class="bg-white rounded-2xl p-10 border border-slate-200">
					<h3 class="text-2xl font-medium mb-4 text-slate-900"><?php _e( 'Enterprise Solution', 'fsc' ); ?></h3>
					<p class="text-slate-600 mb-8"><?php _e( 'Comprehensive partnership for large-scale projects: assessment, design, procurement, delivery, and ongoing strategic guidance.', 'fsc' ); ?></p>
					<div class="pt-6 border-t border-slate-200">
						<p class="text-sm text-slate-600"><?php _e( 'For organizations with complex, multi-phase requirements.', 'fsc' ); ?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_advisory_services', 'fsc_advisory_services_shortcode' );

/**
 * 8. THE FSC ADVANTAGE - Why Procure Through FSC
 * [fsc_boundaries]
 */
function fsc_boundaries_shortcode() {
	ob_start();
	$advantages = array(
		__( 'We assess your exact requirements before recommending anything', 'fsc' ),
		__( 'We design solutions that fit your specific environment', 'fsc' ),
		__( 'We supply only certified, compatible hardware and software', 'fsc' ),
		__( 'We eliminate the gap between consulting and procurement', 'fsc' ),
		__( 'One partner, one invoice, one point of accountability', 'fsc' ),
	);
	$check_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5" aria-hidden="true" focusable="false"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 0 1 .006 1.414l-8 8.084a1 1 0 0 1-1.42.005l-4-4a1 1 0 1 1 1.42-1.41l3.29 3.29 7.29-7.378a1 1 0 0 1 1.414-.006Z" clip-rule="evenodd"/></svg>';
	?>
	<section id="fsc-advantage" class="py-16 px-6 bg-slate-50 border-t border-b border-slate-200">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12 text-center mx-auto">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Why Procure Through FSC', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Eliminate the risk of incompatibility or incorrect specifications', 'fsc' ); ?></p>
			</div>
			<div class="bg-white rounded-2xl p-8 border border-slate-200 max-w-3xl mx-auto" style="box-shadow: var(--shadow-sm);">
				<ul class="space-y-4">
					<?php foreach ( $advantages as $text ) : ?>
					<li class="flex items-start gap-4">
						<span class="w-6 h-6 flex items-center justify-center flex-shrink-0 text-emerald-600">
						<?php
                            // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- hard-coded literal SVG, no dynamic content.
							echo $check_icon;
						?>
						</span>
						<span class="text-slate-700"><?php echo esc_html( $text ); ?></span>
					</li>
					<?php endforeach; ?>
				</ul>
				<p class="text-center text-slate-600 mt-6 pt-6 border-t border-slate-200">
					<?php _e( 'Other firms sell you products. We solve your problems — then deliver the right technology to make it happen.', 'fsc' ); ?>
				</p>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_boundaries', 'fsc_boundaries_shortcode' );

/**
 * TECHNOLOGY PARTNERSHIP
 * [fsc_vendor_neutrality]
 */
function fsc_vendor_neutrality_shortcode() {
	ob_start();
	?>
	<section class="py-12 px-6 bg-white">
		<div class="max-w-4xl mx-auto">
			<div class="bg-slate-900 text-white rounded-2xl p-8 md:p-12">
				<div class="flex items-start gap-4 mb-6">
					<div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center flex-shrink-0">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
						</svg>
					</div>
					<div>
						<h2 class="text-2xl md:text-3xl font-medium mb-2"><?php _e( 'Your Complete Technology Partner', 'fsc' ); ?></h2>
						<p class="text-slate-400 text-sm"><?php _e( 'Assessment to delivery, single accountability', 'fsc' ); ?></p>
					</div>
				</div>
				<p class="text-lg text-white leading-relaxed mb-4">
					<?php _e( 'FSC bridges the gap between your business needs and the complex IT market. We assess your requirements, design the optimal solution, and supply certified hardware and software directly to you.', 'fsc' ); ?>
				</p>
				<p class="text-slate-300 leading-relaxed">
					<?php _e( 'All procurement pricing is transparent. You receive a detailed breakdown of products, quantities, and costs before any purchase is made.', 'fsc' ); ?>
				</p>
				<div class="mt-6 pt-6 border-t border-white/10">
					<a href="<?php echo esc_url( home_url( '/disclosure/' ) ); ?>" class="text-white/80 hover:text-white text-sm inline-flex items-center gap-2 transition-colors">
						<?php _e( 'Read our Procurement Transparency Policy', 'fsc' ); ?>
						<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
						</svg>
					</a>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_vendor_neutrality', 'fsc_vendor_neutrality_shortcode' );

/**
 * 9. ENGAGEMENT
 * [fsc_engagement]
 */
function fsc_engagement_shortcode() {
	ob_start();
	?>
	<section id="engagement" class="py-16 px-6 bg-slate-50">
		<div class="max-w-5xl mx-auto">
			<div class="max-w-3xl mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Engagement structure', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Professional, transparent, and accountable.', 'fsc' ); ?></p>
			</div>
			<div class="grid sm:grid-cols-3 gap-6 mb-10">
				<div class="bg-white rounded-xl p-8 border border-slate-200 text-center">
					<p class="text-lg text-slate-900 font-medium"><?php _e( 'Fixed-scope', 'fsc' ); ?></p>
				</div>
				<div class="bg-white rounded-xl p-8 border border-slate-200 text-center">
					<p class="text-lg text-slate-900 font-medium"><?php _e( 'Documented', 'fsc' ); ?></p>
				</div>
				<div class="bg-white rounded-xl p-8 border border-slate-200 text-center">
					<p class="text-lg text-slate-900 font-medium"><?php _e( 'Contractual', 'fsc' ); ?></p>
				</div>
			</div>
			<div class="max-w-3xl mx-auto bg-white rounded-2xl p-10 border border-slate-200 text-center">
				<p class="text-slate-700 text-lg">
					<?php _e( 'We take responsibility from assessment through delivery. You get the right technology, on time, with a single point of accountability.', 'fsc' ); ?>
				</p>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_engagement', 'fsc_engagement_shortcode' );

/**
 * 10. CONTACT FORM SHORTCODE
 * [fsc_contact_form]
 */
function fsc_contact_form_shortcode() {
	ob_start();
	?>
	<div class="bg-slate-50 rounded-3xl p-8 border border-slate-200">
		<?php
		// Use Contact Form 7 if available
		if ( shortcode_exists( 'contact-form-7' ) ) {
			// Look for a contact form with the slug 'advisory-inquiry'
			$form = get_page_by_path( 'advisory-inquiry', OBJECT, 'wpcf7_contact_form' );
			if ( $form ) {
				echo do_shortcode( '[contact-form-7 id="' . $form->ID . '"]' );
			} else {
				echo '<p class="text-slate-600">' . __( 'Please configure Contact Form 7 with a form titled "advisory-inquiry"', 'fsc' ) . '</p>';
			}
		} else {
			// Fallback mailto form
			?>
			<form action="mailto:info@fahadalmansourconsulting.com" method="post" enctype="text/plain" class="space-y-6">
				<div>
					<label for="company" class="block text-sm font-medium text-slate-900 mb-2">
						<?php _e( 'Company name *', 'fsc' ); ?>
					</label>
					<input type="text" id="company" name="company" required
							class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
							placeholder="<?php esc_attr_e( 'Your organization', 'fsc' ); ?>">
				</div>
				
				<div>
					<label for="name" class="block text-sm font-medium text-slate-900 mb-2">
						<?php _e( 'Your name *', 'fsc' ); ?>
					</label>
					<input type="text" id="name" name="name" required
							class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
							placeholder="<?php esc_attr_e( 'Full name', 'fsc' ); ?>">
				</div>
				
				<div>
					<label for="email" class="block text-sm font-medium text-slate-900 mb-2">
						<?php _e( 'Business email *', 'fsc' ); ?>
					</label>
					<input type="email" id="email" name="email" required
							class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
							placeholder="your.name@company.com">
				</div>
				
				<div>
					<label for="phone" class="block text-sm font-medium text-slate-900 mb-2">
						<?php _e( 'Phone (optional)', 'fsc' ); ?>
					</label>
					<input type="tel" id="phone" name="phone"
							class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
							placeholder="+966 5X XXX XXXX">
				</div>
				
				<div>
					<label for="decision_type" class="block text-sm font-medium text-slate-900 mb-2">
						<?php _e( 'Service Interest *', 'fsc' ); ?>
					</label>
					<select id="decision_type" name="decision_type" required
							class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white">
						<option value=""><?php _e( 'Select one', 'fsc' ); ?></option>
						<option value="cloud"><?php _e( 'Cloud & Infrastructure', 'fsc' ); ?></option>
						<option value="digital"><?php _e( 'Digital Transformation', 'fsc' ); ?></option>
						<option value="security"><?php _e( 'Cybersecurity', 'fsc' ); ?></option>
						<option value="consulting"><?php _e( 'IT Strategy Consulting', 'fsc' ); ?></option>
						<option value="other"><?php _e( 'Other', 'fsc' ); ?></option>
					</select>
				</div>
				
				<div>
					<label for="message" class="block text-sm font-medium text-slate-900 mb-2">
						<?php _e( 'What do you need help with? *', 'fsc' ); ?>
					</label>
					<textarea id="message" name="message" rows="5" required
								class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white resize-none"
								placeholder="<?php esc_attr_e( 'Brief description of your situation and what decision you\'re facing...', 'fsc' ); ?>"></textarea>
				</div>
				
				<div class="bg-white rounded-xl p-4 border border-slate-300">
					<label class="flex items-start gap-3 cursor-pointer">
						<input type="checkbox" name="consent" required
								class="mt-1 w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
						<span class="text-sm text-slate-700 leading-relaxed">
							<?php _e( 'I agree to receive communications from Fahad Almansour Consultant Office and accept the Privacy Policy.', 'fsc' ); ?>
						</span>
					</label>
				</div>
				
				<button type="submit" class="w-full btn btn-primary">
					<?php _e( 'Submit request', 'fsc' ); ?>
				</button>
				
				<p class="text-center text-sm text-slate-600">
					<?php _e( 'We reply within 1 business day', 'fsc' ); ?>
				</p>
			</form>
			<?php
		}
		?>
	</div>
	
	<div class="mt-8 text-center">
		<p class="text-sm text-slate-600 mb-3">
			<?php _e( 'Prefer email directly?', 'fsc' ); ?>
		</p>
		<a href="mailto:info@fahadalmansourconsulting.com" class="inline-flex items-center gap-2 text-slate-900 hover:text-slate-700 transition-colors">
			<?php echo fsc_get_icon( 'mail' ); ?>
			<span class="font-medium">info@fahadalmansourconsulting.com</span>
		</a>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_contact_form', 'fsc_contact_form_shortcode' );

/**
 * 11. WHY US
 * [fsc_why_us]
 */
function fsc_why_us_shortcode() {
	ob_start();
	?>
	<section id="why-us" class="py-20 px-6 bg-white">
		<div class="max-w-5xl mx-auto">
			<div class="text-center mb-16">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900">
					<?php _e( 'Why Organizations Choose Us', 'fsc' ); ?>
				</h2>
				<p class="text-xl text-slate-600 max-w-2xl mx-auto">
					<?php _e( 'We combine technical expertise with structured methodology to deliver clarity.', 'fsc' ); ?>
				</p>
			</div>

			<!-- Credentials Row -->
			<div class="grid md:grid-cols-2 gap-6 mb-12">
				<div class="bg-slate-50 p-6 rounded-xl border border-slate-200 text-center">
					<div class="text-3xl font-light text-slate-900 mb-2">15+</div>
					<p class="text-slate-600"><?php _e( 'Years Industry Experience', 'fsc' ); ?></p>
				</div>
				<div class="bg-slate-50 p-6 rounded-xl border border-slate-200 text-center">
					<div class="text-3xl font-light text-slate-900 mb-2">
						<svg class="w-8 h-8 mx-auto text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
						</svg>
					</div>
					<p class="text-slate-600"><?php _e( 'Certified IT Professionals', 'fsc' ); ?></p>
				</div>
			</div>

			<!-- Values Grid -->
			<div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
				<!-- End-to-End -->
				<div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
					<h3 class="font-medium text-slate-900 mb-3"><?php _e( 'End-to-End', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-600"><?php _e( 'From initial assessment to hardware on your desk. No gaps, no handoffs to third parties, no finger-pointing between vendors.', 'fsc' ); ?></p>
				</div>
				<!-- Right-Fit Solutions -->
				<div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
					<h3 class="font-medium text-slate-900 mb-3"><?php _e( 'Right-Fit Solutions', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-600"><?php _e( 'We assess first, sell second. Every product we supply is matched to your specific requirements and environment.', 'fsc' ); ?></p>
				</div>
				<!-- Certified Products -->
				<div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
					<h3 class="font-medium text-slate-900 mb-3"><?php _e( 'Certified Products', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-600"><?php _e( 'We supply only certified, genuine hardware and software. No gray market, no compatibility surprises.', 'fsc' ); ?></p>
				</div>
				<!-- Single Accountability -->
				<div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
					<h3 class="font-medium text-slate-900 mb-3"><?php _e( 'Single Accountability', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-600"><?php _e( 'One partner, one invoice, one point of contact. If something isn\'t right, you call us — not five different vendors.', 'fsc' ); ?></p>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_why_us', 'fsc_why_us_shortcode' );

/**
 * 12. LATEST INSIGHTS
 * [fsc_latest_insights]
 */
function fsc_latest_insights_shortcode() {
	ob_start();
	?>
	<section id="latest-insights" class="py-16 px-6 bg-white">
		<div class="max-w-5xl mx-auto">
			<div class="text-center mb-12 animate-slide-up">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Latest Insights', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Thoughts on the changing landscape of enterprise IT.', 'fsc' ); ?></p>
			</div>
			
			<div class="grid md:grid-cols-3 gap-8">
				<!-- Insight 1 -->
				<article class="group cursor-pointer animate-fade-in">
					<div class="aspect-video bg-slate-100 rounded-xl mb-4 overflow-hidden relative">
						<div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity z-10"></div>
						<div class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-500"></div>
					</div>
					<h3 class="text-xl font-medium text-slate-900 mb-2 group-hover:text-blue-600 transition-colors"><?php _e( 'The Cloud Exit Strategy', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-500"><?php _e( 'Why having a way out is as important as getting in.', 'fsc' ); ?></p>
				</article>

				<!-- Insight 2 -->
				<article class="group cursor-pointer animate-fade-in" style="animation-delay: 0.1s;">
					<div class="aspect-video bg-slate-100 rounded-xl mb-4 overflow-hidden relative">
						<div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity z-10"></div>
						<div class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-500"></div>
					</div>
					<h3 class="text-xl font-medium text-slate-900 mb-2 group-hover:text-blue-600 transition-colors"><?php _e( 'Vendor Management 101', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-500"><?php _e( 'How to keep your partners honest and aligned.', 'fsc' ); ?></p>
				</article>

				<!-- Insight 3 -->
				<article class="group cursor-pointer animate-fade-in" style="animation-delay: 0.2s;">
					<div class="aspect-video bg-slate-100 rounded-xl mb-4 overflow-hidden relative">
						<div class="absolute inset-0 bg-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity z-10"></div>
						<div class="w-full h-full bg-slate-200 group-hover:scale-105 transition-transform duration-500"></div>
					</div>
					<h3 class="text-xl font-medium text-slate-900 mb-2 group-hover:text-blue-600 transition-colors"><?php _e( 'Technical Debt vs. Investment', 'fsc' ); ?></h3>
					<p class="text-sm text-slate-500"><?php _e( 'Knowing the difference saves millions.', 'fsc' ); ?></p>
				</article>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_latest_insights', 'fsc_latest_insights_shortcode' );

/**
 * Shortcode: Display Social Icons
 * [fsc_social_links]
 */
function fsc_social_links_shortcode() {
	$linkedin = get_theme_mod( 'fsc_linkedin' );
	$twitter  = get_theme_mod( 'fsc_twitter' );
	$youtube  = get_theme_mod( 'fsc_youtube' );

	if ( ! $linkedin && ! $twitter && ! $youtube ) {
		return '';
	}

	ob_start();
	?>
	<div class="flex items-center gap-4 social-links">
		<?php if ( $linkedin ) : ?>
			<a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-[#0077b5] transition-colors" aria-label="LinkedIn">
				<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
			</a>
		<?php endif; ?>
		
		<?php if ( $twitter ) : ?>
			<a href="<?php echo esc_url( $twitter ); ?>" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-black transition-colors" aria-label="Twitter / X">
				<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
			</a>
		<?php endif; ?>

		<?php if ( $youtube ) : ?>
			<a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-[#FF0000] transition-colors" aria-label="YouTube">
				<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
			</a>
		<?php endif; ?>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_social_links', 'fsc_social_links_shortcode' );

/**
 * 13. TRUST BADGES / CREDENTIALS
 * [fsc_trust_badges]
 */
function fsc_trust_badges_shortcode() {
	ob_start();
	?>
	<section id="trust" class="py-12 px-6 bg-slate-50 border-y border-slate-200">
		<div class="max-w-5xl mx-auto">
			<div class="text-center mb-8">
				<p class="text-sm font-medium text-slate-500 uppercase tracking-wider"><?php _e( 'Trusted By Businesses Worldwide', 'fsc' ); ?></p>
			</div>
			<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
				<!-- Badge 1: Certified -->
				<div class="bg-white rounded-xl p-6 border border-slate-200 text-center">
					<div class="w-12 h-12 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
						</svg>
					</div>
					<h4 class="font-medium text-slate-900 mb-1"><?php _e( 'Certified Experts', 'fsc' ); ?></h4>
					<p class="text-sm text-slate-500"><?php _e( 'AWS, Azure, GCP certified', 'fsc' ); ?></p>
				</div>

				<!-- Badge 2: Secure -->
				<div class="bg-white rounded-xl p-6 border border-slate-200 text-center">
					<div class="w-12 h-12 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
						</svg>
					</div>
					<h4 class="font-medium text-slate-900 mb-1"><?php _e( 'Data Security', 'fsc' ); ?></h4>
					<p class="text-sm text-slate-500"><?php _e( 'NDA & compliance ready', 'fsc' ); ?></p>
				</div>

				<!-- Badge 3: Support -->
				<div class="bg-white rounded-xl p-6 border border-slate-200 text-center">
					<div class="w-12 h-12 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
						</svg>
					</div>
					<h4 class="font-medium text-slate-900 mb-1"><?php _e( '24/7 Support', 'fsc' ); ?></h4>
					<p class="text-sm text-slate-500"><?php _e( 'Always available', 'fsc' ); ?></p>
				</div>

				<!-- Badge 4: Registered -->
				<div class="bg-white rounded-xl p-6 border border-slate-200 text-center">
					<div class="w-12 h-12 bg-slate-900 rounded-full flex items-center justify-center mx-auto mb-4">
						<svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
						</svg>
					</div>
					<h4 class="font-medium text-slate-900 mb-1"><?php _e( 'Registered Business', 'fsc' ); ?></h4>
					<p class="text-sm text-slate-500"><?php _e( 'Riyadh, Saudi Arabia', 'fsc' ); ?></p>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_trust_badges', 'fsc_trust_badges_shortcode' );

/**
 * 14. ENGAGEMENT STEPS (Two-Step Process)
 * [fsc_engagement_steps]
 */
function fsc_engagement_steps_shortcode() {
	ob_start();
	$is_rtl = is_rtl();
	?>
	<section class="py-12 px-6 bg-slate-50 rounded-3xl border border-slate-200 mb-12">
		<div class="max-w-4xl mx-auto">
			<div class="text-center mb-8">
				<h2 class="text-2xl font-medium text-slate-900 mb-2"><?php _e( 'Our Engagement Process', 'fsc' ); ?></h2>
				<p class="text-slate-600"><?php _e( 'We believe in understanding before advising. That\'s why we start with a brief discovery call.', 'fsc' ); ?></p>
			</div>

			<div class="grid md:grid-cols-2 gap-6">
				<!-- Step 1: Discovery Call -->
				<div class="bg-white rounded-2xl p-8 border border-slate-200 relative">
					<div class="absolute -top-3 <?php echo $is_rtl ? 'right-6' : 'left-6'; ?>">
						<span class="bg-slate-900 text-white text-xs font-medium px-3 py-1 rounded-full"><?php _e( 'Step 1', 'fsc' ); ?></span>
					</div>
					<div class="pt-4">
						<h3 class="text-xl font-medium text-slate-900 mb-2"><?php _e( 'Discovery Call', 'fsc' ); ?></h3>
						<p class="text-3xl font-light text-slate-400 mb-4">15-30 <span class="text-base"><?php _e( 'min', 'fsc' ); ?></span></p>
						<ul class="space-y-2 text-sm text-slate-600">
							<li class="flex items-start gap-2">
								<svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<span><?php _e( 'Understand your challenges', 'fsc' ); ?></span>
							</li>
							<li class="flex items-start gap-2">
								<svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<span><?php _e( 'Determine if we\'re a good fit', 'fsc' ); ?></span>
							</li>
							<li class="flex items-start gap-2">
								<svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<span><?php _e( 'No obligation, completely free', 'fsc' ); ?></span>
							</li>
						</ul>
						<div class="mt-6 pt-4 border-t border-slate-100">
							<span class="inline-flex items-center gap-1 text-sm font-medium text-green-600">
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<?php _e( 'FREE', 'fsc' ); ?>
							</span>
						</div>
					</div>
				</div>

				<!-- Arrow between steps (hidden on mobile) -->
				<div class="hidden md:flex absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 z-10">
					<?php if ( $is_rtl ) : ?>
						<svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
						</svg>
					<?php else : ?>
						<svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
						</svg>
					<?php endif; ?>
				</div>

				<!-- Step 2: Strategy Session -->
				<div class="bg-white rounded-2xl p-8 border border-slate-200 relative">
					<div class="absolute -top-3 <?php echo $is_rtl ? 'right-6' : 'left-6'; ?>">
						<span class="bg-slate-900 text-white text-xs font-medium px-3 py-1 rounded-full"><?php _e( 'Step 2', 'fsc' ); ?></span>
					</div>
					<div class="pt-4">
						<h3 class="text-xl font-medium text-slate-900 mb-2"><?php _e( 'Strategy Session', 'fsc' ); ?></h3>
						<p class="text-3xl font-light text-slate-400 mb-4">60 <span class="text-base"><?php _e( 'min', 'fsc' ); ?></span></p>
						<ul class="space-y-2 text-sm text-slate-600">
							<li class="flex items-start gap-2">
								<svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<span><?php _e( 'Deep-dive into requirements', 'fsc' ); ?></span>
							</li>
							<li class="flex items-start gap-2">
								<svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<span><?php _e( 'Present preliminary approach', 'fsc' ); ?></span>
							</li>
							<li class="flex items-start gap-2">
								<svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
								</svg>
								<span><?php _e( 'Discuss engagement options', 'fsc' ); ?></span>
							</li>
						</ul>
						<div class="mt-6 pt-4 border-t border-slate-100">
							<span class="text-sm text-slate-500"><?php _e( 'If aligned after discovery call', 'fsc' ); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_engagement_steps', 'fsc_engagement_steps_shortcode' );

/**
 * 15. CONTACT INFO SIDEBAR
 * [fsc_contact_info]
 */
function fsc_contact_info_shortcode() {
	ob_start();
	?>
	<div class="bg-slate-50 rounded-2xl p-8 border border-slate-200 space-y-6">
		<h3 class="text-lg font-medium text-slate-900 mb-6"><?php _e( 'Contact Information', 'fsc' ); ?></h3>

		<!-- Email -->
		<div class="flex items-start gap-4">
			<div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-slate-200 flex-shrink-0">
				<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
				</svg>
			</div>
			<div>
				<p class="text-xs text-slate-500 mb-1"><?php _e( 'Email', 'fsc' ); ?></p>
				<a href="mailto:info@fahadalmansourconsulting.com" class="text-slate-900 font-medium hover:text-slate-700 transition-colors">
					info@fahadalmansourconsulting.com
				</a>
			</div>
		</div>

		<!-- Phone/WhatsApp -->
		<div class="flex items-start gap-4">
			<div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-slate-200 flex-shrink-0">
				<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
				</svg>
			</div>
			<div>
				<p class="text-xs text-slate-500 mb-1"><?php _e( 'Phone / WhatsApp', 'fsc' ); ?></p>
				<a href="tel:+966570131122" class="text-slate-900 font-medium hover:text-slate-700 transition-colors">
					+966 57 013 1122
				</a>
			</div>
		</div>

		<!-- Working Hours -->
		<div class="flex items-start gap-4">
			<div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-slate-200 flex-shrink-0">
				<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
				</svg>
			</div>
			<div>
				<p class="text-xs text-slate-500 mb-1"><?php _e( 'Working Hours', 'fsc' ); ?></p>
				<p class="text-slate-900 font-medium"><?php _e( 'Sun - Thu: 9AM - 5PM', 'fsc' ); ?></p>
				<p class="text-xs text-slate-500">(AST / UTC+3)</p>
			</div>
		</div>

		<!-- Response Time -->
		<div class="flex items-start gap-4">
			<div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-slate-200 flex-shrink-0">
				<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
				</svg>
			</div>
			<div>
				<p class="text-xs text-slate-500 mb-1"><?php _e( 'Response Time', 'fsc' ); ?></p>
				<p class="text-slate-900 font-medium"><?php _e( 'Within 1 business day', 'fsc' ); ?></p>
			</div>
		</div>

		<!-- Location -->
		<div class="flex items-start gap-4">
			<div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-slate-200 flex-shrink-0">
				<svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
				</svg>
			</div>
			<div>
				<p class="text-xs text-slate-500 mb-1"><?php _e( 'Location', 'fsc' ); ?></p>
				<p class="text-slate-900 font-medium"><?php _e( 'Riyadh, Saudi Arabia', 'fsc' ); ?></p>
				<p class="text-xs text-slate-500"><?php _e( 'Serving Saudi Arabia & GCC', 'fsc' ); ?></p>
			</div>
		</div>

		<!-- Divider -->
		<div class="border-t border-slate-200 pt-6">
			<p class="text-sm text-slate-600 mb-4"><?php _e( 'Prefer to schedule directly?', 'fsc' ); ?></p>
			<a href="#" class="inline-flex items-center gap-2 w-full justify-center bg-white border border-slate-300 text-slate-700 px-4 py-3 rounded-xl font-medium hover:bg-slate-50 transition-colors">
				<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
				</svg>
				<?php _e( 'Book a Time Slot', 'fsc' ); ?>
			</a>
		</div>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_contact_info', 'fsc_contact_info_shortcode' );

/**
 * 15b. WHAT TO EXPECT
 * [fsc_what_to_expect]
 */
function fsc_what_to_expect_shortcode() {
	ob_start();
	?>
	<div class="what-to-expect">
		<h4 class="font-medium text-slate-900 mb-4"><?php _e( 'What to Expect', 'fsc' ); ?></h4>
		<ul class="space-y-3 text-sm text-slate-600">
			<li class="flex items-start gap-2">
				<svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
				<span><?php _e( 'Response within 1 business day', 'fsc' ); ?></span>
			</li>
			<li class="flex items-start gap-2">
				<svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
				<span><?php _e( 'Brief discovery call to understand your needs', 'fsc' ); ?></span>
			</li>
			<li class="flex items-start gap-2">
				<svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
				<span><?php _e( 'Clear proposal with scope and timeline', 'fsc' ); ?></span>
			</li>
			<li class="flex items-start gap-2">
				<svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
				<span><?php _e( 'No obligation to proceed', 'fsc' ); ?></span>
			</li>
		</ul>
	</div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_what_to_expect', 'fsc_what_to_expect_shortcode' );

/**
 * 16. ENHANCED INTAKE FORM
 * [fsc_intake_form]
 */
function fsc_intake_form_shortcode() {
	ob_start();

	$industries = array(
		'technology'    => __( 'Technology & Software', 'fsc' ),
		'finance'       => __( 'Finance & Banking', 'fsc' ),
		'healthcare'    => __( 'Healthcare & Life Sciences', 'fsc' ),
		'retail'        => __( 'Retail & E-commerce', 'fsc' ),
		'manufacturing' => __( 'Manufacturing & Industrial', 'fsc' ),
		'government'    => __( 'Government & Public Sector', 'fsc' ),
		'education'     => __( 'Education & Research', 'fsc' ),
		'energy'        => __( 'Energy & Utilities', 'fsc' ),
		'real_estate'   => __( 'Real Estate & Construction', 'fsc' ),
		'other'         => __( 'Other', 'fsc' ),
	);
	?>
	<div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm">
		<h3 class="text-xl font-medium text-slate-900 mb-6"><?php _e( 'Request a Discovery Call', 'fsc' ); ?></h3>

		<?php
		// Use Contact Form 7 if available
		if ( shortcode_exists( 'contact-form-7' ) ) {
			$form = get_page_by_path( 'discovery-call-request', OBJECT, 'wpcf7_contact_form' );
			if ( $form ) {
				echo do_shortcode( '[contact-form-7 id="' . $form->ID . '"]' );
			} else {
				// Fallback to custom form
				fsc_render_intake_form( $industries );
			}
		} else {
			// Custom mailto form with qualification fields
			fsc_render_intake_form( $industries );
		}
		?>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * Helper: Render intake form HTML
 */
function fsc_render_intake_form( $industries ) {
	?>
	<form action="mailto:info@fahadalmansourconsulting.com" method="post" enctype="text/plain" class="space-y-6">
		<!-- Company Name -->
		<div>
			<label for="company" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Company Name', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<input type="text" id="company" name="company" required
					class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
					placeholder="<?php esc_attr_e( 'Your organization', 'fsc' ); ?>">
		</div>

		<!-- Your Name -->
		<div>
			<label for="name" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Your Name', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<input type="text" id="name" name="name" required
					class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
					placeholder="<?php esc_attr_e( 'Full name', 'fsc' ); ?>">
		</div>

		<!-- Business Email -->
		<div>
			<label for="email" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Business Email', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<input type="email" id="email" name="email" required
					class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
					placeholder="you@company.com">
		</div>

		<!-- Phone -->
		<div>
			<label for="phone" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Phone (WhatsApp preferred)', 'fsc' ); ?>
			</label>
			<input type="tel" id="phone" name="phone"
					class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white"
					placeholder="+966 5X XXX XXXX">
		</div>

		<!-- Company Size -->
		<div>
			<label class="block text-sm font-medium text-slate-900 mb-3">
				<?php _e( 'Company Size', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<div class="grid grid-cols-2 gap-3">
				<label class="relative">
					<input type="radio" name="company_size" value="1-10" required class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm text-slate-700">1-10</span>
					</div>
				</label>
				<label class="relative">
					<input type="radio" name="company_size" value="11-50" class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm text-slate-700">11-50</span>
					</div>
				</label>
				<label class="relative">
					<input type="radio" name="company_size" value="51-200" class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm text-slate-700">51-200</span>
					</div>
				</label>
				<label class="relative">
					<input type="radio" name="company_size" value="200+" class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm text-slate-700">200+</span>
					</div>
				</label>
			</div>
		</div>

		<!-- Industry -->
		<div>
			<label for="industry" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Industry', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<select id="industry" name="industry" required
					class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white">
				<option value=""><?php _e( 'Select your industry', 'fsc' ); ?></option>
				<?php foreach ( $industries as $value => $label ) : ?>
					<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>

		<!-- Service Interest (Multi-select) -->
		<div>
			<label class="block text-sm font-medium text-slate-900 mb-3">
				<?php _e( 'Service Interest', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<div class="space-y-2">
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="checkbox" name="services[]" value="cloud" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
					<span class="text-sm text-slate-700"><?php _e( 'Cloud & Infrastructure', 'fsc' ); ?></span>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="checkbox" name="services[]" value="digital" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
					<span class="text-sm text-slate-700"><?php _e( 'Digital Presence', 'fsc' ); ?></span>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="checkbox" name="services[]" value="security" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
					<span class="text-sm text-slate-700"><?php _e( 'Cybersecurity', 'fsc' ); ?></span>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="checkbox" name="services[]" value="hardware" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
					<span class="text-sm text-slate-700"><?php _e( 'Hardware & Software Procurement', 'fsc' ); ?></span>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="checkbox" name="services[]" value="strategy" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
					<span class="text-sm text-slate-700"><?php _e( 'IT Strategy Consulting', 'fsc' ); ?></span>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="checkbox" name="services[]" value="other" class="w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
					<span class="text-sm text-slate-700"><?php _e( 'Other', 'fsc' ); ?></span>
				</label>
			</div>
		</div>

		<!-- Decision Clarity -->
		<div>
			<label class="block text-sm font-medium text-slate-900 mb-3">
				<?php _e( 'Decision Clarity', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<div class="space-y-2">
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="radio" name="clarity" value="clear" required class="w-4 h-4 text-slate-900 border-slate-300 focus:ring-slate-900">
					<div>
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Very clear', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( 'We know what we need, seeking validation', 'fsc' ); ?></p>
					</div>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="radio" name="clarity" value="general" class="w-4 h-4 text-slate-900 border-slate-300 focus:ring-slate-900">
					<div>
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Somewhat clear', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( 'We have options, need help deciding', 'fsc' ); ?></p>
					</div>
				</label>
				<label class="flex items-center gap-3 p-3 rounded-xl border border-slate-300 cursor-pointer hover:bg-slate-50 transition-colors">
					<input type="radio" name="clarity" value="guidance" class="w-4 h-4 text-slate-900 border-slate-300 focus:ring-slate-900">
					<div>
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Unclear', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( 'We need help defining the problem', 'fsc' ); ?></p>
					</div>
				</label>
			</div>
		</div>

		<!-- Timeline -->
		<div>
			<label class="block text-sm font-medium text-slate-900 mb-3">
				<?php _e( 'Timeline', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<div class="grid grid-cols-2 gap-3">
				<label class="relative">
					<input type="radio" name="timeline" value="urgent" required class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Urgent', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( '< 1 month', 'fsc' ); ?></p>
					</div>
				</label>
				<label class="relative">
					<input type="radio" name="timeline" value="near-term" class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Near-term', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( '1-3 months', 'fsc' ); ?></p>
					</div>
				</label>
				<label class="relative">
					<input type="radio" name="timeline" value="planning" class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Planning', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( '3-6 months', 'fsc' ); ?></p>
					</div>
				</label>
				<label class="relative">
					<input type="radio" name="timeline" value="exploring" class="peer sr-only">
					<div class="p-3 rounded-xl border border-slate-300 text-center cursor-pointer peer-checked:border-slate-900 peer-checked:bg-slate-50 hover:bg-slate-50 transition-colors">
						<span class="text-sm font-medium text-slate-700"><?php _e( 'Exploring', 'fsc' ); ?></span>
						<p class="text-xs text-slate-500"><?php _e( 'No rush', 'fsc' ); ?></p>
					</div>
				</label>
			</div>
		</div>

		<!-- Procurement Services -->
		<div>
			<label for="procurement_interest" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Are you interested in hardware/software procurement?', 'fsc' ); ?>
			</label>
			<select id="procurement_interest" name="procurement_interest"
					class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white">
				<option value="assessment_only"><?php _e( 'Assessment only — I will procure separately', 'fsc' ); ?></option>
				<option value="yes"><?php _e( 'Yes — I want FSC to procure and deliver', 'fsc' ); ?></option>
				<option value="unsure"><?php _e( 'Not sure yet', 'fsc' ); ?></option>
			</select>
			<p class="mt-2 text-xs text-slate-500">
				<?php
				printf(
					__( 'All procurement pricing is transparent. See our %1$sProcurement Transparency Policy%2$s.', 'fsc' ),
					'<a href="' . esc_url( home_url( '/disclosure/' ) ) . '" class="text-slate-700 underline hover:no-underline">',
					'</a>'
				);
				?>
			</p>
		</div>

		<!-- Message -->
		<div>
			<label for="message" class="block text-sm font-medium text-slate-900 mb-2">
				<?php _e( 'Tell us about your situation', 'fsc' ); ?> <span class="text-red-500">*</span>
			</label>
			<textarea id="message" name="message" rows="4" required
						class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-900 bg-white resize-none"
						placeholder="<?php esc_attr_e( 'Brief description of your challenges and what you\'re hoping to achieve...', 'fsc' ); ?>"></textarea>
		</div>

		<!-- Privacy Consent -->
		<div class="bg-slate-50 rounded-xl p-4">
			<label class="flex items-start gap-3 cursor-pointer">
				<input type="checkbox" name="consent" required
						class="mt-1 w-4 h-4 text-slate-900 border-slate-300 rounded focus:ring-slate-900">
				<span class="text-sm text-slate-700 leading-relaxed">
					<?php
					printf(
						__( 'I agree to receive communications from Fahad Almansour Consultant Office and accept the %1$sPrivacy Policy%2$s.', 'fsc' ),
						'<a href="' . esc_url( home_url( '/privacy/' ) ) . '" class="text-slate-900 underline hover:no-underline">',
						'</a>'
					);
					?>
				</span>
			</label>
		</div>

		<!-- Submit Button -->
		<button type="submit" class="w-full btn btn-primary text-base py-4">
			<?php _e( 'Request Discovery Call', 'fsc' ); ?>
		</button>

		<p class="text-center text-sm text-slate-500">
			<?php _e( 'No commitment. No pressure. Just a conversation.', 'fsc' ); ?>
		</p>
	</form>
	<?php
}
add_shortcode( 'fsc_intake_form', 'fsc_intake_form_shortcode' );

/**
 * 17. FAQ SECTION
 * [fsc_faq]
 */
function fsc_faq_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'limit' => 0, // 0 = show all
		),
		$atts
	);

	$faqs = array(
		array(
			'question' => __( 'What does "complete technology partner" mean?', 'fsc' ),
			'answer'   => __( 'We handle the entire journey — from assessing your business needs, to designing the right solution, to procuring and delivering certified hardware and software. You get one partner instead of juggling multiple vendors.', 'fsc' ),
		),
		array(
			'question' => __( 'Do you work with businesses outside Riyadh?', 'fsc' ),
			'answer'   => __( 'Yes. We provide in-person services in Riyadh and remote services across Saudi Arabia and the GCC. Hardware and software delivery available nationwide.', 'fsc' ),
		),
		array(
			'question' => __( 'How does the process work?', 'fsc' ),
			'answer'   => __( 'We start with a consultation to assess your requirements. Then we design a tailored solution, present options with pricing, and upon approval, procure and deliver everything directly to you — ready for your environment.', 'fsc' ),
		),
		array(
			'question' => __( 'What if I don\'t know what technology I need?', 'fsc' ),
			'answer'   => __( 'That\'s exactly where we start. Our assessment process identifies what you actually need based on your business goals, current systems, and budget — before we recommend or supply anything.', 'fsc' ),
		),
		array(
			'question' => __( 'Why should I procure through FSC instead of buying directly?', 'fsc' ),
			'answer'   => __( 'When you procure through FSC, you eliminate the risk of incompatibility or incorrect specifications. We ensure everything is right-fit, certified, and compatible. One invoice, one point of accountability.', 'fsc' ),
		),
		array(
			'question' => __( 'What industries do you serve?', 'fsc' ),
			'answer'   => __( 'We work with any organization needing technology solutions — technology, healthcare, finance, retail, manufacturing, government, and education. Our assessment process adapts to your industry context.', 'fsc' ),
		),
	);

	// Apply limit if set
	if ( $atts['limit'] > 0 ) {
		$faqs = array_slice( $faqs, 0, intval( $atts['limit'] ) );
	}

	ob_start();
	?>
	<section id="faq" class="py-16 px-6 bg-white">
		<div class="max-w-3xl mx-auto">
			<div class="text-center mb-12">
				<h2 class="text-4xl font-light tracking-tight mb-4 text-slate-900"><?php _e( 'Frequently Asked Questions', 'fsc' ); ?></h2>
				<p class="text-xl text-slate-600"><?php _e( 'Common questions about our consulting services.', 'fsc' ); ?></p>
			</div>

			<div class="space-y-4" x-data="{ openFaq: null }">
				<?php foreach ( $faqs as $index => $faq ) : ?>
				<div class="faq-item border border-slate-200 rounded-xl overflow-hidden">
					<button
						type="button"
						class="faq-question w-full px-6 py-4 text-left flex items-center justify-between gap-4 hover:bg-slate-50 transition-colors"
						onclick="this.parentElement.classList.toggle('faq-open'); this.setAttribute('aria-expanded', this.parentElement.classList.contains('faq-open'))"
						aria-expanded="false"
						aria-controls="faq-answer-<?php echo $index; ?>">
						<span class="font-medium text-slate-900"><?php echo esc_html( $faq['question'] ); ?></span>
						<svg class="faq-icon w-5 h-5 text-slate-400 flex-shrink-0 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
						</svg>
					</button>
					<div id="faq-answer-<?php echo $index; ?>" class="faq-answer px-6 pb-4 hidden">
						<p class="text-slate-600 leading-relaxed"><?php echo esc_html( $faq['answer'] ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>

			<!-- CTA -->
			<div class="mt-12 text-center p-8 bg-slate-50 rounded-2xl">
				<p class="text-slate-700 mb-4"><?php _e( 'Have a question that\'s not answered here?', 'fsc' ); ?></p>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary">
					<?php _e( 'Contact Us', 'fsc' ); ?>
				</a>
			</div>
		</div>
	</section>

	<style>
		.faq-item.faq-open .faq-icon {
			transform: rotate(180deg);
		}
		.faq-item.faq-open .faq-answer {
			display: block;
		}
	</style>
	<?php
	return ob_get_clean();
}
add_shortcode( 'fsc_faq', 'fsc_faq_shortcode' );
