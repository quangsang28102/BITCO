<?php
/**
 * The template for displaying the front page / One-Page Landing Page
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<?php
	// 1. Hero Section
	if ( get_theme_mod( 'show_hero', 1 ) ) {
		get_template_part( 'template-parts/section-hero' );
	}

	// 2. About Us Section
	if ( get_theme_mod( 'show_about', 1 ) ) {
		get_template_part( 'template-parts/section-about' );
	}

	// 3. Parallax Banner 1 (Vật Liệu Xanh)
	if ( get_theme_mod( 'show_parallax1', 1 ) ) {
		get_template_part( 'template-parts/section-parallax-green' );
	}

	// 4. Products 3D Showcase Section
	if ( get_theme_mod( 'show_products', 1 ) ) {
		get_template_part( 'template-parts/section-products' );
	}

	// 5. Advantages Section
	if ( get_theme_mod( 'show_advantages', 1 ) ) {
		get_template_part( 'template-parts/section-advantages' );
	}

	// 6. Parallax Banner 2 (Công Trình Trọng Điểm)
	if ( get_theme_mod( 'show_parallax2', 1 ) ) {
		get_template_part( 'template-parts/section-parallax-projects' );
	}

	// 7. Projects Section
	if ( get_theme_mod( 'show_projects', 1 ) ) {
		get_template_part( 'template-parts/section-projects' );
	}

	// 8. Contact & Quote Request Section
	if ( get_theme_mod( 'show_contact', 1 ) ) {
		get_template_part( 'template-parts/section-contact' );
	}
	?>
</main>

<?php
get_footer();
