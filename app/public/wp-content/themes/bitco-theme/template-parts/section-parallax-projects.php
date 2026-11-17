<?php
/**
 * Template part: Parallax Banner 2 (Công Trình Trọng Điểm)
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$parallax_title= bitco_get_field( 'parallax2_title', 'Đồng Hành Cùng Những Công Trình Trọng Điểm' );
$parallax_desc = bitco_get_field( 'parallax2_desc', 'Với năng lực sản xuất lớn và đội ngũ kỹ thuật lành nghề, BITCO tự hào cung ứng vật liệu xây dựng cho hàng ngàn dự án đô thị và khu công nghiệp lớn.' );
$parallax_btn  = bitco_get_field( 'parallax2_btn_text', 'Liên hệ nhận catalog & mẫu thử' );
$p2_bg_custom  = bitco_get_field( 'parallax2_bg_image' );
$p2_bg         = ! empty( $p2_bg_custom ) ? $p2_bg_custom : ( $theme_uri . '/assets/images/hero_bg.png' );
?>
<!-- ==========================================
     PARALLAX BANNER 2 (CHẤT LƯỢNG)
     ========================================== -->
<section class="parallax-banner" style="background-image: url('<?php echo esc_url( $p2_bg ); ?>');">
	<div class="parallax-overlay" style="background: linear-gradient(to bottom, rgba(10, 15, 20, 0.85) 0%, rgba(10, 15, 20, 0.8) 100%);"></div>
	<div class="container parallax-content reveal fade-up">
		<h2 style="color: white;"><?php echo esc_html( $parallax_title ); ?></h2>
		<p><?php echo esc_html( $parallax_desc ); ?></p>
		<a href="#contact" class="btn btn-primary"><?php echo esc_html( $parallax_btn ); ?> <i class="fa-regular fa-file-pdf"></i></a>
	</div>
</section>
