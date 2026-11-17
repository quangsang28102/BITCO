<?php
/**
 * Template part: Projects Section
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri       = get_template_directory_uri();
$projects_tag    = bitco_get_field( 'projects_tag', 'Công trình tiêu biểu' );
$projects_title  = bitco_get_field( 'projects_title', 'Vết Chân Dự Án BITCO' );
$projects_sub    = bitco_get_field( 'projects_subtitle', 'Minh chứng cho chất lượng qua những công trình lớn nhỏ tại Bình Định và các tỉnh Nam Trung Bộ.' );

$query_du_an = new WP_Query(
	array(
		'post_type'      => 'du-an',
		'posts_per_page' => 6,
		'post_status'    => 'publish',
		'orderby'        => 'date',
		'order'          => 'DESC',
	)
);
?>
<!-- ==========================================
     PROJECTS SECTION
     ========================================== -->
<section id="projects" class="section">
	<?php get_template_part( 'template-parts/builder-svg', null, array( 'index' => 3 ) ); ?>

	<div class="container">
		<div class="section-header reveal fade-up">
			<div class="section-tag"><?php echo esc_html( $projects_tag ); ?></div>
			<h2 class="section-title"><?php echo esc_html( $projects_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $projects_sub ); ?></p>
		</div>

		<div class="projects-grid">
			<?php
			if ( $query_du_an->have_posts() ) :
				$p_index = 0;
				while ( $query_du_an->have_posts() ) :
					$query_du_an->the_post();
					$p_id        = get_the_ID();
					$location    = get_post_meta( $p_id, 'project_location', true ) ?: 'Bình Định';
					$badge_text  = get_post_meta( $p_id, 'project_badge_text', true ) ?: 'Vật liệu BITCO';
					$badge_style = get_post_meta( $p_id, 'project_badge_style', true ) ?: 'badge-eco';
					$delay_class = ( $p_index % 3 === 1 ) ? ' delay-150' : ( ( $p_index % 3 === 2 ) ? ' delay-300' : '' );
					$img_url     = get_the_post_thumbnail_url( $p_id, 'large' ) ?: $theme_uri . '/assets/images/hero_bg.png';
					?>
					<div class="project-card reveal zoom-in<?php echo esc_attr( $delay_class ); ?>">
						<span class="project-badge <?php echo esc_attr( $badge_style ); ?>"><?php echo esc_html( $badge_text ); ?></span>
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="project-img">
						<div class="project-overlay"></div>
						<div class="project-content">
							<div class="project-location"><?php echo esc_html( $location ); ?></div>
							<h3 class="project-name"><?php the_title(); ?></h3>
							<p class="project-desc"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
						</div>
					</div>
					<?php
					$p_index++;
				endwhile;
				wp_reset_postdata();
			else :
				// Fallback default projects
				?>
				<div class="project-card reveal zoom-in">
					<span class="project-badge badge-eco"><?php esc_html_e( 'AAC & ALC Panel', 'bitco-theme' ); ?></span>
					<img src="<?php echo esc_url( $theme_uri . '/assets/images/hero_bg.png' ); ?>" alt="<?php esc_attr_e( 'Chung cư cao tầng Quy Nhơn', 'bitco-theme' ); ?>" class="project-img">
					<div class="project-overlay"></div>
					<div class="project-content">
						<div class="project-location"><?php esc_html_e( 'Quy Nhơn, Bình Định', 'bitco-theme' ); ?></div>
						<h3 class="project-name"><?php esc_html_e( 'Căn hộ chung cư cao cấp Grand Center', 'bitco-theme' ); ?></h3>
						<p class="project-desc"><?php esc_html_e( 'Sử dụng toàn bộ vách ngăn bằng tấm ALC panel lõi thép chống nứt, cách âm tuyệt đối giữa các hộ gia đình.', 'bitco-theme' ); ?></p>
					</div>
				</div>

				<div class="project-card reveal zoom-in delay-150">
					<span class="project-badge badge-clay"><?php esc_html_e( 'Gạch đặc Tuy Nen', 'bitco-theme' ); ?></span>
					<img src="<?php echo esc_url( $theme_uri . '/assets/images/factory.png' ); ?>" alt="<?php esc_attr_e( 'Khu đô thị mới An Nhơn', 'bitco-theme' ); ?>" class="project-img" style="filter: hue-rotate(25deg);">
					<div class="project-overlay"></div>
					<div class="project-content">
						<div class="project-location"><?php esc_html_e( 'An Nhơn, Bình Định', 'bitco-theme' ); ?></div>
						<h3 class="project-name"><?php esc_html_e( 'Khu Phố Thương Mại Nhơn Hưng', 'bitco-theme' ); ?></h3>
						<p class="project-desc"><?php esc_html_e( 'Cung cấp hơn 5 triệu viên gạch đỏ Tuy Nen xây móng và tường bao dày chống ẩm cho chuỗi shophouse sang trọng.', 'bitco-theme' ); ?></p>
					</div>
				</div>

				<div class="project-card reveal zoom-in delay-300">
					<span class="project-badge badge-eco"><?php esc_html_e( 'Gạch nhẹ AAC', 'bitco-theme' ); ?></span>
					<img src="<?php echo esc_url( $theme_uri . '/assets/images/hero_bg.png' ); ?>" alt="<?php esc_attr_e( 'Khu công nghiệp Phù Cát', 'bitco-theme' ); ?>" class="project-img" style="filter: saturate(1.2) contrast(1.1) brightness(0.9);">
					<div class="project-overlay"></div>
					<div class="project-content">
						<div class="project-location"><?php esc_html_e( 'Phù Cát, Bình Định', 'bitco-theme' ); ?></div>
						<h3 class="project-name"><?php esc_html_e( 'Nhà Xưởng Chế Biến Thủy Sản Cát Trinh', 'bitco-theme' ); ?></h3>
						<p class="project-desc"><?php esc_html_e( 'Ứng dụng tường gạch AAC cách nhiệt chống nóng hiệu quả, tiết kiệm 40% lượng điện tiêu thụ cho hệ thống điều hòa kho mát.', 'bitco-theme' ); ?></p>
					</div>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
</section>
