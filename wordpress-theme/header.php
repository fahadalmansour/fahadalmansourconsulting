<?php
/**
 * The header template
 *
 * Supports 3 modes:
 * 1. Elementor Canvas — minimal shell, no header/footer
 * 2. Elementor Theme Builder header — skip FSC header, let Elementor render
 * 3. FSC native — full FSC header with bilingual nav
 *
 * @package FSC_Theme
 */

// Use the language switching system
$current_lang = function_exists( 'fsc_get_current_language' ) ? fsc_get_current_language() : 'en';
$is_rtl       = ( $current_lang === 'ar' );
$lang         = $current_lang;

// Elementor detection
$fsc_elementor_canvas = function_exists( 'fsc_is_elementor_canvas' ) && fsc_is_elementor_canvas();
$fsc_elementor_header = function_exists( 'fsc_has_elementor_location' ) && fsc_has_elementor_location( 'header' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="<?php echo esc_attr( $is_rtl ? 'rtl' : 'ltr' ); ?>">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<!-- Favicons -->
	<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( get_template_directory_uri() . '/assets/brand/favicon.svg' ); ?>">
	<link rel="icon" type="image/svg+xml" sizes="16x16" href="<?php echo esc_url( get_template_directory_uri() . '/assets/brand/favicon-16.svg' ); ?>">
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( get_template_directory_uri() . '/assets/brand/apple-touch-icon.svg' ); ?>">
	<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/manifest.json' ); ?>">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( $fsc_elementor_canvas ) : ?>
	<?php // Canvas mode: no page wrapper, no header, no footer — Elementor handles everything ?>
<?php else : ?>
<div id="page" class="min-h-screen bg-white">

	<?php if ( ! $fsc_elementor_header ) : ?>
	<header id="masthead" class="site-header fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-slate-200">
		<div class="max-w-7xl mx-auto px-6">
			<div class="flex items-center justify-between h-20">
				<!-- Logo -->
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 text-slate-900 font-semibold text-lg fsc-logo">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						// Inline SVG logo for better performance
						?>
						<svg class="fsc-logo-icon" width="36" height="36" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
							<!-- FSC Network Nodes -->
							<line x1="28" y1="14" x2="21" y2="3" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="28" y1="14" x2="38" y2="6" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="28" y1="14" x2="42" y2="18" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="28" y1="14" x2="16" y2="28" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="16" y1="28" x2="5" y2="21" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="16" y1="28" x2="8" y2="40" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="16" y1="28" x2="28" y2="38" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<line x1="28" y1="38" x2="38" y2="44" stroke="#4A90D9" stroke-width="2.5" stroke-linecap="round"/>
							<circle cx="28" cy="14" r="4.5" fill="#4A90D9"/>
							<circle cx="16" cy="28" r="4" fill="#4A90D9"/>
							<circle cx="21" cy="3" r="2.5" fill="#4A90D9"/>
							<circle cx="38" cy="6" r="2.5" fill="#4A90D9"/>
							<circle cx="42" cy="18" r="2.5" fill="#4A90D9"/>
							<circle cx="5" cy="21" r="2.5" fill="#4A90D9"/>
							<circle cx="8" cy="40" r="2.5" fill="#4A90D9"/>
							<circle cx="28" cy="38" r="2.5" fill="#4A90D9"/>
							<circle cx="38" cy="44" r="2.5" fill="#4A90D9"/>
						</svg>
						<span class="fsc-logo-text">
							<span class="fsc-logo-name"><?php echo esc_html( $is_rtl ? 'فهد المنصور للاستشارات' : 'Fahad Almansour Consulting' ); ?></span>
							<span class="fsc-logo-tagline"><?php echo esc_html( $is_rtl ? 'شريكك التقني المتكامل' : 'Your Technology Partner' ); ?></span>
						</span>
						<?php
					}
					?>
				</a>

				<!-- Desktop Navigation -->
				<nav class="hidden lg:flex items-center gap-8">
					<a href="<?php echo esc_url( home_url( '/#how-we-work' ) ); ?>" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
						<?php esc_html_e( 'How we work', 'fsc' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/#advisory-services' ) ); ?>" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
						<?php esc_html_e( 'Solutions', 'fsc' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/#what-you-receive' ) ); ?>" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
						<?php esc_html_e( 'Deliverables', 'fsc' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
						<?php esc_html_e( 'About', 'fsc' ); ?>
					</a>
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="text-slate-700 hover:text-slate-900 transition-colors text-sm font-medium">
						<?php esc_html_e( 'Contact', 'fsc' ); ?>
					</a>
				</nav>

				<!-- CTA & Language Switcher -->
				<div class="hidden lg:flex items-center gap-4">
					<!-- Language Switcher -->
					<div class="flex items-center gap-1 text-sm">
						<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
							<?php
							pll_the_languages(
								array(
									'display_names_as' => 'slug',
									'hide_current'     => false,
								)
							);
							?>
						<?php else : ?>
							<!-- URL-based language switching -->
							<a href="<?php echo esc_url( fsc_language_switcher_url( 'ar' ) ); ?>"
								class="px-2 py-1 rounded transition-colors <?php echo esc_attr( $is_rtl ? 'bg-slate-900 text-white font-medium' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100' ); ?>"
								title="العربية">AR</a>
							<span class="text-slate-300">|</span>
							<a href="<?php echo esc_url( fsc_language_switcher_url( 'en' ) ); ?>"
								class="px-2 py-1 rounded transition-colors <?php echo ! $is_rtl ? 'bg-slate-900 text-white font-medium' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100'; ?>"
								title="English">EN</a>
						<?php endif; ?>
					</div>

					<!-- CTA Button -->
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary text-sm">
						<?php esc_html_e( 'Request a Consultation', 'fsc' ); ?>
					</a>
				</div>

				<!-- Mobile Menu Button -->
				<button type="button" class="lg:hidden p-2 text-slate-700 hover:text-slate-900" id="mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'fsc' ); ?>">
					<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
					</svg>
				</button>
			</div>
		</div>

		<!-- Mobile Navigation -->
		<div id="mobile-menu" class="hidden lg:hidden border-t border-slate-200 bg-white">
			<nav class="px-6 py-4 space-y-2">
				<a href="<?php echo esc_url( home_url( '/#how-we-work' ) ); ?>" class="block py-2 text-slate-700 hover:text-slate-900 text-base font-medium">
					<?php esc_html_e( 'How we work', 'fsc' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/#advisory-services' ) ); ?>" class="block py-2 text-slate-700 hover:text-slate-900 text-base font-medium">
					<?php esc_html_e( 'Consulting Models', 'fsc' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/#what-you-receive' ) ); ?>" class="block py-2 text-slate-700 hover:text-slate-900 text-base font-medium">
					<?php esc_html_e( 'Deliverables', 'fsc' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="block py-2 text-slate-700 hover:text-slate-900 text-base font-medium">
					<?php esc_html_e( 'About', 'fsc' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="block py-2 text-slate-700 hover:text-slate-900 text-base font-medium">
					<?php esc_html_e( 'Contact', 'fsc' ); ?>
				</a>
				<div class="pt-4 border-t border-slate-200">
					<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="block w-full btn btn-primary text-center">
						<?php
						if ( $is_rtl ) {
							esc_html_e( 'طلب جلسة', 'fsc' );
						} else {
							esc_html_e( 'Request discussion', 'fsc' ); }
						?>
					</a>
				</div>
			</nav>
		</div>
	</header>
	<?php endif; ?>

	<div id="content" class="site-content <?php echo ! $fsc_elementor_header ? 'pt-20' : ''; ?>">
<?php endif; ?>
