<?php
/**
 * The Header for BITCO Theme
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ==========================================
     HEADER / NAVIGATION
     ========================================== -->
<header id="header" class="site-header">
	<div class="container header-container">
		<?php if ( has_custom_logo() ) : ?>
			<?php the_custom_logo(); ?>
		<?php else : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
				<div class="logo-icon">B</div>
				<div>
					<div class="logo-text">BITCO</div>
					<div class="logo-sub"><?php esc_html_e( 'Tuy Nen Bình Định', 'bitco-theme' ); ?></div>
				</div>
			</a>
		<?php endif; ?>

		<ul class="nav-menu" id="navMenu">
			<li><a href="#home" class="nav-link active"><?php esc_html_e( 'Trang Chủ', 'bitco-theme' ); ?></a></li>
			<li><a href="#about" class="nav-link"><?php esc_html_e( 'Về Chúng Tôi', 'bitco-theme' ); ?></a></li>
			<li><a href="#products" class="nav-link"><?php esc_html_e( 'Sản Phẩm', 'bitco-theme' ); ?></a></li>
			<li><a href="#advantages" class="nav-link"><?php esc_html_e( 'Ưu Điểm', 'bitco-theme' ); ?></a></li>
			<li><a href="#projects" class="nav-link"><?php esc_html_e( 'Dự Án', 'bitco-theme' ); ?></a></li>
			<li><a href="#contact" class="nav-link"><?php esc_html_e( 'Liên Hệ', 'bitco-theme' ); ?></a></li>
			<li><a href="#contact" class="btn btn-primary header-cta"><?php echo esc_html( bitco_get_field( 'header_cta_text', __( 'Tư vấn ngay', 'bitco-theme' ) ) ); ?></a></li>
		</ul>

		<div class="menu-toggle" id="menuToggle">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>
</header>
