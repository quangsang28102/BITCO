<?php
/**
 * The Footer for BITCO Theme
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri       = get_template_directory_uri();
$stock_code      = bitco_get_field( 'footer_stock_code', 'Mã Cổ Phiếu: BTN (Sàn UPCoM)' );
$office_address  = bitco_get_field( 'contact_address', 'Quốc lộ 1A, Phước Lộc, Tuy Phước, Bình Định' );
$contact_phone   = bitco_get_field( 'contact_hotline', '0256 3832 176 - 0256 3832 809' );
$contact_email   = bitco_get_field( 'contact_email', 'info@bitcobinhdinh.com.vn' );
$copyright_text  = bitco_get_field( 'footer_copyright', '© 2026 Công ty Cổ phần Đầu tư BITCO Bình Định. Bảo lưu mọi quyền.' );
$fb_url          = bitco_get_field( 'footer_facebook_url', '#' );
$yt_url          = bitco_get_field( 'footer_youtube_url', '#' );
$li_url          = bitco_get_field( 'footer_linkedin_url', '#' );
?>

<!-- ==========================================
     FOOTER
     ========================================== -->
<footer class="site-footer">
	<div class="container">
		<div class="footer-grid">
			
			<!-- Footer Col 1 -->
			<div class="footer-brand-col">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
						<div class="logo-icon">B</div>
						<div>
							<div class="logo-text" style="color: white;">BITCO</div>
							<div class="logo-sub"><?php esc_html_e( 'Tuy Nen Bình Định', 'bitco-theme' ); ?></div>
						</div>
					</a>
				<?php endif; ?>
				<p class="footer-desc">
					<?php esc_html_e( 'Tiên phong cung cấp giải pháp vật liệu xây dựng toàn diện, chất lượng bền vững theo năm tháng và kiến tạo tương lai xanh cho Việt Nam.', 'bitco-theme' ); ?>
				</p>
				<ul class="footer-socials">
					<li><a href="<?php echo esc_url( $fb_url ); ?>" class="social-link" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
					<li><a href="<?php echo esc_url( $yt_url ); ?>" class="social-link" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
					<li><a href="<?php echo esc_url( $li_url ); ?>" class="social-link" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
				</ul>
			</div>

			<!-- Footer Col 2 -->
			<div>
				<h3 class="footer-col-title"><?php esc_html_e( 'Liên kết nhanh', 'bitco-theme' ); ?></h3>
				<ul class="footer-links-list">
					<li><a href="#home" class="footer-link"><?php esc_html_e( 'Trang Chủ', 'bitco-theme' ); ?></a></li>
					<li><a href="#about" class="footer-link"><?php esc_html_e( 'Về Chúng Tôi', 'bitco-theme' ); ?></a></li>
					<li><a href="#products" class="footer-link"><?php esc_html_e( 'Danh Mục Sản Phẩm', 'bitco-theme' ); ?></a></li>
					<li><a href="#advantages" class="footer-link"><?php esc_html_e( 'Thế Mạnh BITCO', 'bitco-theme' ); ?></a></li>
					<li><a href="#projects" class="footer-link"><?php esc_html_e( 'Dự Án Tiêu Biểu', 'bitco-theme' ); ?></a></li>
				</ul>
			</div>

			<!-- Footer Col 3 -->
			<div>
				<h3 class="footer-col-title"><?php esc_html_e( 'Sản phẩm chính', 'bitco-theme' ); ?></h3>
				<ul class="footer-links-list">
					<li><a href="#products" class="footer-link"><?php esc_html_e( 'Gạch Đặc Tuy Nen', 'bitco-theme' ); ?></a></li>
					<li><a href="#products" class="footer-link"><?php esc_html_e( 'Gạch Rỗng 6 Lỗ', 'bitco-theme' ); ?></a></li>
					<li><a href="#products" class="footer-link"><?php esc_html_e( 'Gạch Nhẹ AAC Tiêu Chuẩn', 'bitco-theme' ); ?></a></li>
					<li><a href="#products" class="footer-link"><?php esc_html_e( 'Tấm Panel ALC Lõi Thép', 'bitco-theme' ); ?></a></li>
					<li><a href="#products" class="footer-link"><?php esc_html_e( 'Keo & Vữa Xây BITCO', 'bitco-theme' ); ?></a></li>
				</ul>
			</div>

			<!-- Footer Col 4 -->
			<div>
				<h3 class="footer-col-title"><?php esc_html_e( 'Thông tin giao dịch', 'bitco-theme' ); ?></h3>
				<ul class="footer-contact-list">
					<li><strong><?php esc_html_e( 'Mã Cổ Phiếu:', 'bitco-theme' ); ?></strong> <?php echo esc_html( str_replace( 'Mã Cổ Phiếu:', '', $stock_code ) ); ?></li>
					<li><strong><?php esc_html_e( 'Văn phòng:', 'bitco-theme' ); ?></strong> <?php echo esc_html( $office_address ); ?></li>
					<li><strong><?php esc_html_e( 'Điện thoại:', 'bitco-theme' ); ?></strong> <?php echo esc_html( $contact_phone ); ?></li>
					<li><strong><?php esc_html_e( 'Email:', 'bitco-theme' ); ?></strong> <?php echo esc_html( $contact_email ); ?></li>
				</ul>
			</div>

		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<p><?php echo esc_html( $copyright_text ); ?></p>
			<ul class="footer-bottom-links">
				<li><a href="#"><?php esc_html_e( 'Chính sách bảo mật', 'bitco-theme' ); ?></a></li>
				<li><a href="#"><?php esc_html_e( 'Điều khoản sử dụng', 'bitco-theme' ); ?></a></li>
			</ul>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
