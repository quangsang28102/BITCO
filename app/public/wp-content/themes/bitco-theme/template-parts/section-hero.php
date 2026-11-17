<?php
/**
 * Template part: Hero Section
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$hero_tagline  = bitco_get_field( 'hero_tagline', 'Tiêu chuẩn xây dựng tương lai' );
$hero_title    = bitco_get_field( 'hero_title', 'Kiến Tạo Bền Vững<br>Với <span>Gạch Tuy Nen & AAC</span>' );
$hero_desc     = bitco_get_field( 'hero_description', 'Công ty Cổ phần Đầu tư BITCO Bình Định tự hào là đơn vị tiên phong hàng đầu tại miền Trung, kết hợp hoàn hảo giữa công nghệ lò Tuy Nen truyền thống và các giải pháp vật liệu xanh đạt chuẩn Châu Âu.' );

$stat1_num     = bitco_get_field( 'hero_stat1_number', 50 );
$stat1_suffix  = bitco_get_field( 'hero_stat1_suffix', 'M+' );
$stat1_label   = bitco_get_field( 'hero_stat1_label', 'Viên gạch nung / Năm' );

$stat2_num     = bitco_get_field( 'hero_stat2_number', 100 );
$stat2_suffix  = bitco_get_field( 'hero_stat2_suffix', 'K m³' );
$stat2_label   = bitco_get_field( 'hero_stat2_label', 'Gạch nhẹ AAC / Năm' );
$hero_bg_custom= bitco_get_field( 'hero_bg_image' );
$hero_bg       = ! empty( $hero_bg_custom ) ? $hero_bg_custom : ( $theme_uri . '/assets/images/hero_bg.png' );
?>
<!-- ==========================================
     HERO SECTION
     ========================================== -->
<section id="home" class="hero-section">
	<div class="hero-bg-container">
		<img src="<?php echo esc_url( $hero_bg ); ?>" alt="<?php esc_attr_e( 'Kiến trúc gạch nung Tuy Nen hiện đại', 'bitco-theme' ); ?>" class="hero-bg">
		<div class="hero-overlay"></div>
	</div>
	
	<div class="glowing-aura"></div>
	<div class="glowing-aura-secondary"></div>

	<div class="container hero-container">
		<div class="hero-content reveal fade-up">
			<div class="hero-tagline"><?php echo esc_html( $hero_tagline ); ?></div>
			<h1 class="hero-title"><?php echo wp_kses_post( $hero_title ); ?></h1>
			<p class="hero-description">
				<?php echo esc_html( $hero_desc ); ?>
			</p>
			<div class="hero-actions">
				<a href="#products" class="btn btn-primary"><i class="fa-solid fa-layer-group"></i> <?php esc_html_e( 'Khám phá sản phẩm', 'bitco-theme' ); ?></a>
				<a href="#contact" class="btn btn-outline"><i class="fa-regular fa-envelope"></i> <?php esc_html_e( 'Liên hệ báo giá', 'bitco-theme' ); ?></a>
			</div>
		</div>

		<div class="hero-visual reveal fade-up delay-200">
			<!-- Stats Card 1 Wrapper -->
			<div class="stat-card-wrapper wrapper-orange">
				<div class="stat-card stat-card-orange">
					<div class="stat-number" data-target="<?php echo esc_attr( $stat1_num ); ?>" data-suffix="<?php echo esc_attr( $stat1_suffix ); ?>">0</div>
					<div class="stat-label"><?php echo esc_html( $stat1_label ); ?></div>
				</div>
			</div>
			<!-- Stats Card 2 Wrapper -->
			<div class="stat-card-wrapper wrapper-green">
				<div class="stat-card stat-card-green">
					<div class="stat-number" data-target="<?php echo esc_attr( $stat2_num ); ?>" data-suffix="<?php echo esc_attr( $stat2_suffix ); ?>">0</div>
					<div class="stat-label"><?php echo esc_html( $stat2_label ); ?></div>
				</div>
			</div>
		</div>
	</div>
</section>
