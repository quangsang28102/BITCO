<?php
/**
 * Template part: About Us Section
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$about_tag     = bitco_get_field( 'about_tag', 'Hành trình & Giá trị' );
$about_title   = bitco_get_field( 'about_title', '25 Năm Đi Cùng Các Công Trình Đất Việt' );
$about_story_1 = bitco_get_field( 'about_story_1', 'Tiền thân từ các đơn vị sản xuất gạch ngói lâu đời của tỉnh Bình Định, được cổ phần hóa vào năm 2001, BITCO (Mã CK: BTN) đã không ngừng cải tiến công nghệ lò nung Tuy Nen công suất lớn.' );
$about_story_2 = bitco_get_field( 'about_story_2', 'Với tầm nhìn xanh, chúng tôi đã chủ động đầu tư dây chuyền sản xuất bê tông khí chưng áp (AAC) hiện đại của Đức, đưa BITCO trở thành đơn vị duy nhất cung cấp trọn gói giải pháp vật liệu xây dựng nung và không nung tối ưu cho mọi công trình.' );

$badge_title   = bitco_get_field( 'about_badge_title', 'BITCO Bình Định' );
$badge_desc    = bitco_get_field( 'about_badge_desc', 'Thành lập từ 2001 - Hơn 25 năm uy tín' );

$feat1_title   = bitco_get_field( 'about_feature1_title', 'Đơn vị dẫn đầu khu vực' );
$feat1_desc    = bitco_get_field( 'about_feature1_desc', 'Năng lực cung ứng khổng lồ cho thị trường miền Trung - Tây Nguyên.' );
$feat2_title   = bitco_get_field( 'about_feature2_title', 'Đột phá Vật Liệu Xanh' );
$feat2_desc    = bitco_get_field( 'about_feature2_desc', 'Nhà máy AAC & Panel ALC lõi thép có cách âm, chống cháy đến 4 giờ.' );

$about_img_custom = bitco_get_field( 'about_factory_image' );
$about_img        = ! empty( $about_img_custom ) ? $about_img_custom : ( $theme_uri . '/assets/images/factory.png' );
?>
<!-- ==========================================
     ABOUT US SECTION
     ========================================== -->
<section id="about" class="section">
	<?php get_template_part( 'template-parts/builder-svg', null, array( 'index' => 0, 'has_brick' => true ) ); ?>

	<div class="container">
		<div class="about-container">
			
			<!-- Left Image Panel -->
			<div class="about-media reveal slide-right">
				<div class="about-deco-box-primary"></div>
				<div class="about-img-frame">
					<img src="<?php echo esc_url( $about_img ); ?>" alt="<?php esc_attr_e( 'Nhà máy gạch Tuy Nen BITCO Bình Định', 'bitco-theme' ); ?>" class="about-img">
				</div>
				<div class="about-deco-box-secondary"></div>
				
				<div class="about-badge">
					<div class="about-badge-icon"><i class="fa-solid fa-award"></i></div>
					<div class="about-badge-text">
						<h4><?php echo esc_html( $badge_title ); ?></h4>
						<p><?php echo esc_html( $badge_desc ); ?></p>
					</div>
				</div>
			</div>

			<!-- Right Content Panel -->
			<div class="about-content reveal slide-left delay-200">
				<div class="section-tag"><?php echo esc_html( $about_tag ); ?></div>
				<h2 class="section-title"><?php echo esc_html( $about_title ); ?></h2>
				<p class="about-story">
					<?php echo esc_html( $about_story_1 ); ?>
				</p>
				<p class="about-story">
					<?php echo esc_html( $about_story_2 ); ?>
				</p>
				
				<ul class="about-features">
					<li class="about-feature-item">
						<div class="feature-check"><i class="fa-solid fa-check"></i></div>
						<div class="feature-info">
							<h4><?php echo esc_html( $feat1_title ); ?></h4>
							<p><?php echo esc_html( $feat1_desc ); ?></p>
						</div>
					</li>
					<li class="about-feature-item">
						<div class="feature-check"><i class="fa-solid fa-check"></i></div>
						<div class="feature-info">
							<h4><?php echo esc_html( $feat2_title ); ?></h4>
							<p><?php echo esc_html( $feat2_desc ); ?></p>
						</div>
					</li>
				</ul>
			</div>

		</div>
	</div>
</section>
