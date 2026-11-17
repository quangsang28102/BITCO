<?php
/**
 * BITCO Theme Functions and Definitions
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'bitco_theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function bitco_theme_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'bitco-theme', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register Navigation Menus
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'bitco-theme' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'bitco_theme_setup' );

/**
 * Modular Includes
 */
require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/enqueue.php';
require_once get_template_directory() . '/inc/custom-post-types.php';
require_once get_template_directory() . '/inc/custom-fields.php';
require_once get_template_directory() . '/inc/admin-options.php';
require_once get_template_directory() . '/inc/customizer.php';
