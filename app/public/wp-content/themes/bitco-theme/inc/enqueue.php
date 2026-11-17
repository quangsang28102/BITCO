<?php
/**
 * Assets Enqueueing for BITCO Theme
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add preconnect resource hints for Google Fonts.
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array
 */
function bitco_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.googleapis.com',
		);
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'bitco_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function bitco_enqueue_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );
	$theme_uri     = get_template_directory_uri();

	// 1. Google Fonts: Be Vietnam Pro
	wp_enqueue_style(
		'bitco-google-fonts',
		'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	// 2. FontAwesome Icons
	wp_enqueue_style(
		'font-awesome-6',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
		array(),
		'6.4.0'
	);

	// 3. Theme Component CSS Stylesheets
	$css_components = array(
		'bitco-global'     => 'global.css',
		'bitco-header'     => 'header.css',
		'bitco-hero'       => 'hero.css',
		'bitco-about'      => 'about.css',
		'bitco-products'   => 'products.css',
		'bitco-advantages' => 'advantages.css',
		'bitco-projects'   => 'projects.css',
		'bitco-contact'    => 'contact.css',
		'bitco-footer'     => 'footer.css',
		'bitco-parallax'   => 'parallax.css',
	);

	$prev_handle = 'font-awesome-6';
	foreach ( $css_components as $handle => $filename ) {
		wp_enqueue_style(
			$handle,
			$theme_uri . '/assets/css/' . $filename,
			array( $prev_handle ),
			$theme_version
		);
		$prev_handle = $handle;
	}

	// 4. Main theme stylesheet
	wp_enqueue_style(
		'bitco-style',
		get_stylesheet_uri(),
		array( $prev_handle ),
		$theme_version
	);

	// 5. Main JavaScript (Loaded in footer)
	wp_enqueue_script(
		'bitco-main',
		$theme_uri . '/assets/js/main.js',
		array(),
		$theme_version,
		true
	);

	// 6. Data Localization
	$products_data = function_exists( 'bitco_get_products_3d_data' ) ? bitco_get_products_3d_data() : array();

	wp_localize_script(
		'bitco-main',
		'bitcoData',
		array(
			'ajaxUrl'  => admin_url( 'admin-ajax.php' ),
			'themeUri' => $theme_uri,
			'products' => $products_data,
		)
	);
}
add_action( 'wp_enqueue_scripts', 'bitco_enqueue_scripts' );
