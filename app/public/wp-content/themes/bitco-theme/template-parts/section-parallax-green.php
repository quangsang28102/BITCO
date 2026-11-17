<?php
/**
 * Template part: Parallax Banner 1 (Vật Liệu Xanh)
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$parallax_title= bitco_get_field( 'parallax1_title', 'Phát Triển Vật Liệu Xanh Vì Môi Trường Bền Vững' );
$parallax_desc = bitco_get_field( 'parallax1_desc', 'Chúng tôi không ngừng đổi mới công nghệ, áp dụng tiêu chuẩn xanh vào từng quy trình sản xuất để kiến tạo các công trình sinh thái thông minh.' );
$parallax_btn  = bitco_get_field( 'parallax1_btn_text', 'Nhận tư vấn vật liệu xanh' );
$p1_bg_custom  = bitco_get_field( 'parallax1_bg_image' );
$p1_bg         = ! empty( $p1_bg_custom ) ? $p1_bg_custom : ( $theme_uri . '/assets/images/factory.png' );
?>
<!-- ==========================================
     PARALLAX BANNER 1 (VẬT LIỆU XANH)
     ========================================== -->
<section class="parallax-banner" style="background-image: url('<?php echo esc_url( $p1_bg ); ?>');">
	<div class="parallax-overlay"></div>
	<div class="container parallax-content reveal fade-up">
		<h2 style="color: white;"><?php echo esc_html( $parallax_title ); ?></h2>
		<p><?php echo esc_html( $parallax_desc ); ?></p>
		<a href="#contact" class="btn btn-secondary"><?php echo esc_html( $parallax_btn ); ?> <i class="fa-solid fa-leaf"></i></a>
	</div>
</section>
