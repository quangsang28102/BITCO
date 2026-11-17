<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package BITCO_Theme
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 160px 0 100px; text-align: center; min-height: 70vh; display: flex; align-items: center;">
	<div class="container">
		<div class="section-tag" style="margin-bottom: 15px;"><?php esc_html_e( 'Lỗi 404', 'bitco-theme' ); ?></div>
		<h1 class="section-title" style="margin-bottom: 20px;"><?php esc_html_e( 'Không Tìm Thấy Trang', 'bitco-theme' ); ?></h1>
		<p class="section-subtitle" style="margin-bottom: 30px;"><?php esc_html_e( 'Đường dẫn bạn yêu cầu không tồn tại hoặc đã được chuyển dời.', 'bitco-theme' ); ?></p>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
			<i class="fa-solid fa-house"></i> <?php esc_html_e( 'Quay về Trang Chủ', 'bitco-theme' ); ?>
		</a>
	</div>
</main>

<?php
get_footer();
