<?php
/**
 * Template part: Advantages Section
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$adv_tag      = bitco_get_field( 'adv_tag', 'Thế mạnh cốt lõi' );
$adv_title    = bitco_get_field( 'adv_title', 'Tại Sao Các Nhà Thầu Lựa Chọn BITCO?' );
$adv_subtitle = bitco_get_field( 'adv_subtitle', 'Sự đồng hành bền vững đến từ công nghệ sản xuất tân tiến và cam kết bảo vệ môi trường.' );

$advantages = array(
	array(
		'card_class' => 'card-primary',
		'icon'       => 'fa-microchip',
		'title'      => bitco_get_field( 'adv1_title', 'Lò Nung Tuy Nen Tự Động' ),
		'desc'       => bitco_get_field( 'adv1_desc', 'Công nghệ lò nung liên tục giúp kiểm soát nhiệt độ đồng đều, giảm tối đa tỉ lệ nứt vỡ, cho ra đời những viên gạch vuông vức, mác chịu lực vượt trội.' ),
		'delay'      => '',
	),
	array(
		'card_class' => 'card-secondary',
		'icon'       => 'fa-leaf',
		'title'      => bitco_get_field( 'adv2_title', 'Thân Thiện Môi Trường' ),
		'desc'       => bitco_get_field( 'adv2_desc', 'Các sản phẩm gạch không nung AAC và tấm ALC thân thiện tối đa với tự nhiên, không phát thải CO2 trong quá trình sản xuất và có thể tái chế hoàn toàn.' ),
		'delay'      => ' delay-100',
	),
	array(
		'card_class' => 'card-primary',
		'icon'       => 'fa-fire-shield',
		'title'      => bitco_get_field( 'adv3_title', 'Chống Cháy Đến 4 Giờ' ),
		'desc'       => bitco_get_field( 'adv3_desc', 'Tấm Panel ALC đạt chỉ số chống cháy EI 240, bảo vệ tính mạng và tài sản cho cư dân tại các chung cư cao tầng và khu công nghiệp lớn.' ),
		'delay'      => ' delay-200',
	),
	array(
		'card_class' => 'card-secondary',
		'icon'       => 'fa-wallet',
		'title'      => bitco_get_field( 'adv4_title', 'Tối Ưu 30% Chi Phí' ),
		'desc'       => bitco_get_field( 'adv4_desc', 'Khối lượng siêu nhẹ của gạch AAC giúp giảm tải trọng móng cột, tiết kiệm chi phí thép móng, đẩy nhanh 300% tốc độ thi công và bả tô.' ),
		'delay'      => ' delay-300',
	),
);
?>
<!-- ==========================================
     ADVANTAGES SECTION
     ========================================== -->
<section id="advantages" class="section dark-section advantages-section">
	<?php get_template_part( 'template-parts/builder-svg', null, array( 'index' => 2, 'brick_class' => 'aac-style' ) ); ?>

	<div class="advantages-bg-glow"></div>
	<div class="container">
		
		<div class="section-header reveal fade-up">
			<div class="section-tag"><?php echo esc_html( $adv_tag ); ?></div>
			<h2 class="section-title"><?php echo esc_html( $adv_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $adv_subtitle ); ?></p>
		</div>

		<div class="advantages-grid">
			<?php foreach ( $advantages as $item ) : ?>
				<div class="advantage-card <?php echo esc_attr( $item['card_class'] ); ?> reveal fade-up<?php echo esc_attr( $item['delay'] ); ?>">
					<div class="advantage-icon-wrapper">
						<i class="fa-solid <?php echo esc_attr( $item['icon'] ); ?>"></i>
					</div>
					<h3 class="advantage-title"><?php echo esc_html( $item['title'] ); ?></h3>
					<p class="advantage-desc"><?php echo esc_html( $item['desc'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
