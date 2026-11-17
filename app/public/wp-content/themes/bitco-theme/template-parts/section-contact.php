<?php
/**
 * Template part: Contact Section
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$contact_tag     = bitco_get_field( 'contact_tag', 'Hợp tác & Kết nối' );
$contact_title   = bitco_get_field( 'contact_title', 'Nhận Tư Vấn Kỹ Thuật & Báo Giá' );
$contact_sub     = bitco_get_field( 'contact_subtitle', 'Đội ngũ kỹ sư và tư vấn viên của BITCO sẵn sàng hỗ trợ tính toán khối lượng vật liệu tối ưu cho công trình của bạn.' );

$address         = bitco_get_field( 'contact_address', 'Km 1215, Quốc lộ 1A, xã Phước Lộc, huyện Tuy Phước, tỉnh Bình Định' );
$hotline         = bitco_get_field( 'contact_hotline', '0256 3832 176 - 0256 3832 809' );
$email           = bitco_get_field( 'contact_email', 'info@bitcobinhdinh.com.vn<br>congtybitcobinhdinh@gmail.com' );
$working_hours   = bitco_get_field( 'contact_working_hours', 'Thứ 2 - Thứ 7: 07:30 - 17:00 (Chủ nhật nghỉ)' );

$cf7_shortcode   = bitco_get_field( 'contact_cf7_shortcode', '' );
?>
<!-- ==========================================
     CONTACT SECTION
     ========================================== -->
<section id="contact" class="section" style="background-color: #f8fafc;">
	<?php get_template_part( 'template-parts/builder-svg', null, array( 'index' => 4 ) ); ?>

	<div class="container">
		<div class="section-header reveal fade-up">
			<div class="section-tag"><?php echo esc_html( $contact_tag ); ?></div>
			<h2 class="section-title"><?php echo esc_html( $contact_title ); ?></h2>
			<p class="section-subtitle"><?php echo esc_html( $contact_sub ); ?></p>
		</div>

		<div class="contact-grid">
			
			<!-- Info Column -->
			<div class="contact-info-panel reveal slide-right">
				<p class="contact-info-lead"><?php esc_html_e( 'Quý khách hàng, chủ đầu tư hoặc nhà thầu có nhu cầu đặt hàng hoặc làm đại lý phân phối, vui lòng liên hệ:', 'bitco-theme' ); ?></p>
				
				<ul class="contact-details-list">
					<li class="contact-detail-item">
						<div class="contact-icon-box"><i class="fa-solid fa-map-location-dot"></i></div>
						<div class="contact-text">
							<h4><?php esc_html_e( 'Trụ sở chính & Nhà máy', 'bitco-theme' ); ?></h4>
							<p><?php echo esc_html( $address ); ?></p>
						</div>
					</li>
					
					<li class="contact-detail-item">
						<div class="contact-icon-box"><i class="fa-solid fa-phone-volume"></i></div>
						<div class="contact-text">
							<h4><?php esc_html_e( 'Hotline Kinh doanh', 'bitco-theme' ); ?></h4>
							<p><?php echo esc_html( $hotline ); ?></p>
						</div>
					</li>

					<li class="contact-detail-item">
						<div class="contact-icon-box"><i class="fa-solid fa-envelope-open-text"></i></div>
						<div class="contact-text">
							<h4><?php esc_html_e( 'Hòm thư điện tử (Email)', 'bitco-theme' ); ?></h4>
							<p><?php echo wp_kses_post( $email ); ?></p>
						</div>
					</li>

					<li class="contact-detail-item">
						<div class="contact-icon-box"><i class="fa-solid fa-business-time"></i></div>
						<div class="contact-text">
							<h4><?php esc_html_e( 'Giờ làm việc', 'bitco-theme' ); ?></h4>
							<p><?php echo esc_html( $working_hours ); ?></p>
						</div>
					</li>
				</ul>
			</div>

			<!-- Form Column -->
			<div class="contact-form-panel reveal slide-left delay-200">
				<?php if ( ! empty( $cf7_shortcode ) ) : ?>
					<?php echo do_shortcode( $cf7_shortcode ); ?>
				<?php else : ?>
					<form action="#" class="contact-form" onsubmit="event.preventDefault(); alert('Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong vòng 24 giờ làm việc.');">
						
						<div class="form-group">
							<input type="text" id="contactName" class="form-input" placeholder=" " required>
							<label for="contactName" class="form-label"><?php esc_html_e( 'Họ và tên của bạn *', 'bitco-theme' ); ?></label>
						</div>

						<div class="form-group">
							<input type="tel" id="contactPhone" class="form-input" placeholder=" " required>
							<label for="contactPhone" class="form-label"><?php esc_html_e( 'Số điện thoại liên hệ *', 'bitco-theme' ); ?></label>
						</div>

						<div class="form-group">
							<input type="email" id="contactEmail" class="form-input" placeholder=" ">
							<label for="contactEmail" class="form-label"><?php esc_html_e( 'Địa chỉ Email', 'bitco-theme' ); ?></label>
						</div>

						<div class="form-group form-group-textarea">
							<textarea id="contactMessage" class="form-input form-textarea" placeholder=" " required></textarea>
							<label for="contactMessage" class="form-label"><?php esc_html_e( 'Nội dung yêu cầu (VD: Loại gạch cần mua, khối lượng ước tính...) *', 'bitco-theme' ); ?></label>
						</div>

						<button type="submit" class="btn btn-primary form-submit-btn">
							<?php esc_html_e( 'Gửi thông tin tư vấn', 'bitco-theme' ); ?> <i class="fa-solid fa-paper-plane"></i>
						</button>
					</form>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>
