<?php
/**
 * Native Theme Options / Homepage Settings Page
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Admin Menu for BITCO Homepage Options
 */
function bitco_add_admin_menu() {
	add_menu_page(
		__( 'Cấu hình Trang Chủ BITCO', 'bitco-theme' ),
		__( 'Cấu hình Trang Chủ', 'bitco-theme' ),
		'manage_options',
		'bitco-homepage-settings',
		'bitco_render_settings_page',
		'dashicons-admin-generic',
		22
	);
}
add_action( 'admin_menu', 'bitco_add_admin_menu' );

/**
 * Enqueue Media scripts for Theme Options Page
 */
function bitco_admin_options_scripts( $hook ) {
	if ( 'toplevel_page_bitco-homepage-settings' !== $hook ) {
		return;
	}
	wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'bitco_admin_options_scripts' );

/**
 * Register settings and fields
 */
function bitco_register_settings() {
	register_setting( 'bitco_options_group', 'bitco_theme_options', 'bitco_sanitize_options' );
}
add_action( 'admin_init', 'bitco_register_settings' );

/**
 * Sanitize options callback
 */
function bitco_sanitize_options( $input ) {
	$output = array();
	if ( ! is_array( $input ) ) {
		return $output;
	}

	foreach ( $input as $key => $value ) {
		// URLs for uploaded images
		if ( in_array( $key, array( 'hero_bg_image', 'about_factory_image', 'parallax1_bg_image', 'parallax2_bg_image', 'footer_facebook_url', 'footer_youtube_url', 'footer_linkedin_url' ), true ) ) {
			$output[ $key ] = esc_url_raw( $value );
		} elseif ( in_array( $key, array( 'hero_title', 'about_story_1', 'about_story_2', 'contact_email', 'parallax1_desc', 'parallax2_desc', 'footer_copyright' ), true ) ) {
			$output[ $key ] = wp_kses_post( $value );
		} else {
			$output[ $key ] = sanitize_text_field( $value );
		}
	}
	return $output;
}

/**
 * Helper to render an image uploader row
 */
function bitco_render_image_uploader_row( $field_id, $field_name, $current_val, $label, $desc = '' ) {
	$preview_src = ! empty( $current_val ) ? $current_val : '';
	$display_style = ! empty( $current_val ) ? 'inline-block' : 'none';
	?>
	<tr>
		<th scope="row"><label><?php echo esc_html( $label ); ?></label></th>
		<td>
			<div class="bitco-image-preview-wrap" style="margin-bottom: 10px;">
				<img id="preview_<?php echo esc_attr( $field_id ); ?>" src="<?php echo esc_url( $preview_src ); ?>" style="max-width: 280px; max-height: 150px; border: 1px solid #ccd0d4; border-radius: 4px; padding: 4px; background: #fafafa; display: <?php echo esc_attr( $display_style ); ?>; object-fit: contain;" alt="Preview" />
			</div>
			<input type="hidden" id="input_<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>" value="<?php echo esc_attr( $current_val ); ?>" />
			<button type="button" class="button button-secondary bitco-upload-img-btn" data-target="input_<?php echo esc_attr( $field_id ); ?>" data-preview="preview_<?php echo esc_attr( $field_id ); ?>" style="margin-right: 8px;">
				<span class="dashicons dashicons-upload" style="vertical-align: text-top;"></span> <?php esc_html_e( 'Chọn ảnh từ Thư viện Media', 'bitco-theme' ); ?>
			</button>
			<button type="button" class="button bitco-remove-img-btn" data-target="input_<?php echo esc_attr( $field_id ); ?>" data-preview="preview_<?php echo esc_attr( $field_id ); ?>" style="color: #b32d2e;">
				<span class="dashicons dashicons-trash" style="vertical-align: text-top;"></span> <?php esc_html_e( 'Xóa ảnh tùy chỉnh (Dùng ảnh gốc)', 'bitco-theme' ); ?>
			</button>
			<?php if ( ! empty( $desc ) ) : ?>
				<p class="description" style="margin-top: 6px;"><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
		</td>
	</tr>
	<?php
}

/**
 * Render Settings Page with Tabs
 */
function bitco_render_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	$options = get_option( 'bitco_theme_options', array() );
	$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'hero';
	?>
	<div class="wrap bitco-settings-wrap" style="max-width: 1000px;">
		<h1><i class="dashicons dashicons-admin-generic" style="font-size: 32px; vertical-align: middle; margin-right: 8px;"></i> <?php esc_html_e( 'Cấu Hình Trang Chủ BITCO', 'bitco-theme' ); ?></h1>
		<p class="description" style="margin-bottom: 20px; font-size: 14px;">
			<?php esc_html_e( 'Quản lý toàn bộ nội dung, câu chữ và hình ảnh của các khối Section trên trang chủ BITCO tại đây.', 'bitco-theme' ); ?>
		</p>

		<?php settings_errors(); ?>

		<h2 class="nav-tab-wrapper" style="margin-bottom: 20px;">
			<a href="?page=bitco-homepage-settings&tab=hero" class="nav-tab <?php echo $active_tab === 'hero' ? 'nav-tab-active' : ''; ?>">
				<span class="dashicons dashicons-cover-image" style="vertical-align: text-top;"></span> <?php esc_html_e( 'Hero Banner', 'bitco-theme' ); ?>
			</a>
			<a href="?page=bitco-homepage-settings&tab=about" class="nav-tab <?php echo $active_tab === 'about' ? 'nav-tab-active' : ''; ?>">
				<span class="dashicons dashicons-id" style="vertical-align: text-top;"></span> <?php esc_html_e( 'Giới Thiệu (About)', 'bitco-theme' ); ?>
			</a>
			<a href="?page=bitco-homepage-settings&tab=parallax" class="nav-tab <?php echo $active_tab === 'parallax' ? 'nav-tab-active' : ''; ?>">
				<span class="dashicons dashicons-format-image" style="vertical-align: text-top;"></span> <?php esc_html_e( 'Parallax Banners', 'bitco-theme' ); ?>
			</a>
			<a href="?page=bitco-homepage-settings&tab=advantages" class="nav-tab <?php echo $active_tab === 'advantages' ? 'nav-tab-active' : ''; ?>">
				<span class="dashicons dashicons-star-filled" style="vertical-align: text-top;"></span> <?php esc_html_e( '4 Thế Mạnh', 'bitco-theme' ); ?>
			</a>
			<a href="?page=bitco-homepage-settings&tab=contact" class="nav-tab <?php echo $active_tab === 'contact' ? 'nav-tab-active' : ''; ?>">
				<span class="dashicons dashicons-phone" style="vertical-align: text-top;"></span> <?php esc_html_e( 'Liên Hệ & Chân Trang', 'bitco-theme' ); ?>
			</a>
		</h2>

		<form method="post" action="options.php" style="background: #fff; padding: 25px 30px; border: 1px solid #c3c4c7; box-shadow: 0 1px 1px rgba(0,0,0,.04); border-radius: 4px;">
			<?php
			settings_fields( 'bitco_options_group' );

			// Preserve all existing options so switching tabs does not wipe other tabs
			foreach ( $options as $key => $val ) {
				echo '<input type="hidden" name="bitco_theme_options[' . esc_attr( $key ) . ']" value="' . esc_attr( $val ) . '" class="hidden-field-' . esc_attr( $key ) . '" />';
			}

			if ( 'hero' === $active_tab ) :
				$hero_bg_img  = isset( $options['hero_bg_image'] ) ? $options['hero_bg_image'] : '';
				$hero_tagline = isset( $options['hero_tagline'] ) ? $options['hero_tagline'] : 'Tiêu chuẩn xây dựng tương lai';
				$hero_title   = isset( $options['hero_title'] ) ? $options['hero_title'] : 'Kiến Tạo Bền Vững<br>Với <span>Gạch Tuy Nen & AAC</span>';
				$hero_desc    = isset( $options['hero_description'] ) ? $options['hero_description'] : 'Công ty Cổ phần Đầu tư BITCO Bình Định tự hào là đơn vị tiên phong hàng đầu tại miền Trung, kết hợp hoàn hảo giữa công nghệ lò Tuy Nen truyền thống và các giải pháp vật liệu xanh đạt chuẩn Châu Âu.';
				$stat1_num    = isset( $options['hero_stat1_number'] ) ? $options['hero_stat1_number'] : 50;
				$stat1_suffix = isset( $options['hero_stat1_suffix'] ) ? $options['hero_stat1_suffix'] : 'M+';
				$stat1_label  = isset( $options['hero_stat1_label'] ) ? $options['hero_stat1_label'] : 'Viên gạch nung / Năm';
				$stat2_num    = isset( $options['hero_stat2_number'] ) ? $options['hero_stat2_number'] : 100;
				$stat2_suffix = isset( $options['hero_stat2_suffix'] ) ? $options['hero_stat2_suffix'] : 'K m³';
				$stat2_label  = isset( $options['hero_stat2_label'] ) ? $options['hero_stat2_label'] : 'Gạch nhẹ AAC / Năm';
				?>
				<h3><?php esc_html_e( 'Cấu hình Phần Banner Đầu Trang (Hero)', 'bitco-theme' ); ?></h3>
				<table class="form-table">
					<?php
					bitco_render_image_uploader_row(
						'hero_bg_image',
						'bitco_theme_options[hero_bg_image]',
						$hero_bg_img,
						__( 'Ảnh Nền Khối Hero', 'bitco-theme' ),
						__( 'Tải ảnh chụp nhà máy hoặc công trình gạch để thay thế cho ảnh nền mặc định.', 'bitco-theme' )
					);
					?>
					<tr>
						<th scope="row"><label for="hero_tagline"><?php esc_html_e( 'Tagline nhỏ', 'bitco-theme' ); ?></label></th>
						<td><input type="text" id="hero_tagline" name="bitco_theme_options[hero_tagline]" value="<?php echo esc_attr( $hero_tagline ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label for="hero_title"><?php esc_html_e( 'Tiêu đề chính', 'bitco-theme' ); ?></label></th>
						<td>
							<textarea id="hero_title" name="bitco_theme_options[hero_title]" rows="2" class="large-text"><?php echo esc_textarea( $hero_title ); ?></textarea>
							<p class="description"><?php esc_html_e( 'Có thể dùng thẻ <br> để xuống dòng hoặc <span> để đổi màu chữ cam.', 'bitco-theme' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="hero_description"><?php esc_html_e( 'Mô tả giới thiệu', 'bitco-theme' ); ?></label></th>
						<td><textarea id="hero_description" name="bitco_theme_options[hero_description]" rows="3" class="large-text"><?php echo esc_textarea( $hero_desc ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Thẻ thống kê 1 (Màu Cam)', 'bitco-theme' ); ?></th>
						<td>
							<input type="number" name="bitco_theme_options[hero_stat1_number]" value="<?php echo esc_attr( $stat1_num ); ?>" style="width: 80px;" />
							<input type="text" name="bitco_theme_options[hero_stat1_suffix]" value="<?php echo esc_attr( $stat1_suffix ); ?>" style="width: 80px;" placeholder="Hậu tố (M+)" />
							<input type="text" name="bitco_theme_options[hero_stat1_label]" value="<?php echo esc_attr( $stat1_label ); ?>" class="regular-text" placeholder="Nhãn (Viên gạch nung / Năm)" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Thẻ thống kê 2 (Màu Xanh)', 'bitco-theme' ); ?></th>
						<td>
							<input type="number" name="bitco_theme_options[hero_stat2_number]" value="<?php echo esc_attr( $stat2_num ); ?>" style="width: 80px;" />
							<input type="text" name="bitco_theme_options[hero_stat2_suffix]" value="<?php echo esc_attr( $stat2_suffix ); ?>" style="width: 80px;" placeholder="Hậu tố (K m³)" />
							<input type="text" name="bitco_theme_options[hero_stat2_label]" value="<?php echo esc_attr( $stat2_label ); ?>" class="regular-text" placeholder="Nhãn (Gạch nhẹ AAC / Năm)" />
						</td>
					</tr>
				</table>

			<?php elseif ( 'about' === $active_tab ) :
				$about_factory_img = isset( $options['about_factory_image'] ) ? $options['about_factory_image'] : '';
				$about_tag         = isset( $options['about_tag'] ) ? $options['about_tag'] : 'Hành trình & Giá trị';
				$about_title       = isset( $options['about_title'] ) ? $options['about_title'] : '25 Năm Đi Cùng Các Công Trình Đất Việt';
				$badge_title       = isset( $options['about_badge_title'] ) ? $options['about_badge_title'] : 'BITCO Bình Định';
				$badge_desc        = isset( $options['about_badge_desc'] ) ? $options['about_badge_desc'] : 'Thành lập từ 2001 - Hơn 25 năm uy tín';
				$about_story_1     = isset( $options['about_story_1'] ) ? $options['about_story_1'] : 'Tiền thân từ các đơn vị sản xuất gạch ngói lâu đời của tỉnh Bình Định, được cổ phần hóa vào năm 2001, BITCO (Mã CK: BTN) đã không ngừng cải tiến công nghệ lò nung Tuy Nen công suất lớn.';
				$about_story_2     = isset( $options['about_story_2'] ) ? $options['about_story_2'] : 'Với tầm nhìn xanh, chúng tôi đã chủ động đầu tư dây chuyền sản xuất bê tông khí chưng áp (AAC) hiện đại của Đức, đưa BITCO trở thành đơn vị duy nhất cung cấp trọn gói giải pháp vật liệu xây dựng nung và không nung tối ưu cho mọi công trình.';
				$feat1_title       = isset( $options['about_feature1_title'] ) ? $options['about_feature1_title'] : 'Đơn vị dẫn đầu khu vực';
				$feat1_desc        = isset( $options['about_feature1_desc'] ) ? $options['about_feature1_desc'] : 'Năng lực cung ứng khổng lồ cho thị trường miền Trung - Tây Nguyên.';
				$feat2_title       = isset( $options['about_feature2_title'] ) ? $options['about_feature2_title'] : 'Đột phá Vật Liệu Xanh';
				$feat2_desc        = isset( $options['about_feature2_desc'] ) ? $options['about_feature2_desc'] : 'Nhà máy AAC & Panel ALC lõi thép có cách âm, chống cháy đến 4 giờ.';
				?>
				<h3><?php esc_html_e( 'Cấu hình Phần Giới Thiệu (About Us)', 'bitco-theme' ); ?></h3>
				<table class="form-table">
					<?php
					bitco_render_image_uploader_row(
						'about_factory_image',
						'bitco_theme_options[about_factory_image]',
						$about_factory_img,
						__( 'Ảnh Nhà Máy BITCO', 'bitco-theme' ),
						__( 'Thay đổi ảnh khung hình bên trái khối giới thiệu 25 năm.', 'bitco-theme' )
					);
					?>
					<tr>
						<th scope="row"><label for="about_tag"><?php esc_html_e( 'Thẻ phân mục (Tag)', 'bitco-theme' ); ?></label></th>
						<td><input type="text" id="about_tag" name="bitco_theme_options[about_tag]" value="<?php echo esc_attr( $about_tag ); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label for="about_title"><?php esc_html_e( 'Tiêu đề khối giới thiệu', 'bitco-theme' ); ?></label></th>
						<td><input type="text" id="about_title" name="bitco_theme_options[about_title]" value="<?php echo esc_attr( $about_title ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Huy hiệu bên ảnh', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[about_badge_title]" value="<?php echo esc_attr( $badge_title ); ?>" class="regular-text" placeholder="Tiêu đề huy hiệu" />
							<input type="text" name="bitco_theme_options[about_badge_desc]" value="<?php echo esc_attr( $badge_desc ); ?>" class="regular-text" placeholder="Mô tả năm kinh nghiệm" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="about_story_1"><?php esc_html_e( 'Nội dung đoạn văn 1', 'bitco-theme' ); ?></label></th>
						<td><textarea id="about_story_1" name="bitco_theme_options[about_story_1]" rows="3" class="large-text"><?php echo esc_textarea( $about_story_1 ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label for="about_story_2"><?php esc_html_e( 'Nội dung đoạn văn 2', 'bitco-theme' ); ?></label></th>
						<td><textarea id="about_story_2" name="bitco_theme_options[about_story_2]" rows="3" class="large-text"><?php echo esc_textarea( $about_story_2 ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Điểm mạnh 1', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[about_feature1_title]" value="<?php echo esc_attr( $feat1_title ); ?>" class="large-text" style="margin-bottom: 5px;" placeholder="Tiêu đề" /><br>
							<input type="text" name="bitco_theme_options[about_feature1_desc]" value="<?php echo esc_attr( $feat1_desc ); ?>" class="large-text" placeholder="Mô tả" />
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Điểm mạnh 2', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[about_feature2_title]" value="<?php echo esc_attr( $feat2_title ); ?>" class="large-text" style="margin-bottom: 5px;" placeholder="Tiêu đề" /><br>
							<input type="text" name="bitco_theme_options[about_feature2_desc]" value="<?php echo esc_attr( $feat2_desc ); ?>" class="large-text" placeholder="Mô tả" />
						</td>
					</tr>
				</table>

			<?php elseif ( 'parallax' === $active_tab ) :
				$p1_img   = isset( $options['parallax1_bg_image'] ) ? $options['parallax1_bg_image'] : '';
				$p1_title = isset( $options['parallax1_title'] ) ? $options['parallax1_title'] : 'Phát Triển Vật Liệu Xanh Vì Môi Trường Bền Vững';
				$p1_desc  = isset( $options['parallax1_desc'] ) ? $options['parallax1_desc'] : 'Chúng tôi không ngừng đổi mới công nghệ, áp dụng tiêu chuẩn xanh vào từng quy trình sản xuất để kiến tạo các công trình sinh thái thông minh.';
				$p1_btn   = isset( $options['parallax1_btn_text'] ) ? $options['parallax1_btn_text'] : 'Nhận tư vấn vật liệu xanh';

				$p2_img   = isset( $options['parallax2_bg_image'] ) ? $options['parallax2_bg_image'] : '';
				$p2_title = isset( $options['parallax2_title'] ) ? $options['parallax2_title'] : 'Đồng Hành Cùng Những Công Trình Trọng Điểm';
				$p2_desc  = isset( $options['parallax2_desc'] ) ? $options['parallax2_desc'] : 'Với năng lực sản xuất lớn và đội ngũ kỹ thuật lành nghề, BITCO tự hào cung ứng vật liệu xây dựng cho hàng ngàn dự án đô thị và khu công nghiệp lớn.';
				$p2_btn   = isset( $options['parallax2_btn_text'] ) ? $options['parallax2_btn_text'] : 'Liên hệ nhận catalog & mẫu thử';
				?>
				<h3><?php esc_html_e( 'Cấu hình 2 Banner Parallax', 'bitco-theme' ); ?></h3>
				<table class="form-table">
					<tr><th colspan="2"><h4 style="margin: 0; color: #1d4ed8;"><?php esc_html_e( 'Banner 1: Thông điệp Vật Liệu Xanh', 'bitco-theme' ); ?></h4></th></tr>
					<?php
					bitco_render_image_uploader_row(
						'parallax1_bg_image',
						'bitco_theme_options[parallax1_bg_image]',
						$p1_img,
						__( 'Ảnh Nền Banner 1', 'bitco-theme' ),
						__( 'Thay thế ảnh nền cuộn của Banner Parallax 1.', 'bitco-theme' )
					);
					?>
					<tr>
						<th scope="row"><?php esc_html_e( 'Tiêu đề Banner 1', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[parallax1_title]" value="<?php echo esc_attr( $p1_title ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Mô tả Banner 1', 'bitco-theme' ); ?></th>
						<td><textarea name="bitco_theme_options[parallax1_desc]" rows="2" class="large-text"><?php echo esc_textarea( $p1_desc ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Chữ trên nút Banner 1', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[parallax1_btn_text]" value="<?php echo esc_attr( $p1_btn ); ?>" class="regular-text" /></td>
					</tr>

					<tr><th colspan="2"><hr><h4 style="margin: 0; color: #1d4ed8;"><?php esc_html_e( 'Banner 2: Đồng Hành Công Trình Trọng Điểm', 'bitco-theme' ); ?></h4></th></tr>
					<?php
					bitco_render_image_uploader_row(
						'parallax2_bg_image',
						'bitco_theme_options[parallax2_bg_image]',
						$p2_img,
						__( 'Ảnh Nền Banner 2', 'bitco-theme' ),
						__( 'Thay thế ảnh nền cuộn của Banner Parallax 2.', 'bitco-theme' )
					);
					?>
					<tr>
						<th scope="row"><?php esc_html_e( 'Tiêu đề Banner 2', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[parallax2_title]" value="<?php echo esc_attr( $p2_title ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Mô tả Banner 2', 'bitco-theme' ); ?></th>
						<td><textarea name="bitco_theme_options[parallax2_desc]" rows="2" class="large-text"><?php echo esc_textarea( $p2_desc ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Chữ trên nút Banner 2', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[parallax2_btn_text]" value="<?php echo esc_attr( $p2_btn ); ?>" class="regular-text" /></td>
					</tr>
				</table>

			<?php elseif ( 'advantages' === $active_tab ) :
				$adv_tag   = isset( $options['adv_tag'] ) ? $options['adv_tag'] : 'Thế mạnh cốt lõi';
				$adv_title = isset( $options['adv_title'] ) ? $options['adv_title'] : 'Tại Sao Các Nhà Thầu Lựa Chọn BITCO?';
				$adv_sub   = isset( $options['adv_subtitle'] ) ? $options['adv_subtitle'] : 'Sự đồng hành bền vững đến từ công nghệ sản xuất tân tiến và cam kết bảo vệ môi trường.';

				$adv1_t = isset( $options['adv1_title'] ) ? $options['adv1_title'] : 'Lò Nung Tuy Nen Tự Động';
				$adv1_d = isset( $options['adv1_desc'] ) ? $options['adv1_desc'] : 'Công nghệ lò nung liên tục giúp kiểm soát nhiệt độ đồng đều, giảm tối đa tỉ lệ nứt vỡ, cho ra đời những viên gạch vuông vức, mác chịu lực vượt trội.';
				$adv2_t = isset( $options['adv2_title'] ) ? $options['adv2_title'] : 'Thân Thiện Môi Trường';
				$adv2_d = isset( $options['adv2_desc'] ) ? $options['adv2_desc'] : 'Các sản phẩm gạch không nung AAC và tấm ALC thân thiện tối đa với tự nhiên, không phát thải CO2 trong quá trình sản xuất và có thể tái chế hoàn toàn.';
				$adv3_t = isset( $options['adv3_title'] ) ? $options['adv3_title'] : 'Chống Cháy Đến 4 Giờ';
				$adv3_d = isset( $options['adv3_desc'] ) ? $options['adv3_desc'] : 'Tấm Panel ALC đạt chỉ số chống cháy EI 240, bảo vệ tính mạng và tài sản cho cư dân tại các chung cư cao tầng và khu công nghiệp lớn.';
				$adv4_t = isset( $options['adv4_title'] ) ? $options['adv4_title'] : 'Tối Ưu 30% Chi Phí';
				$adv4_d = isset( $options['adv4_desc'] ) ? $options['adv4_desc'] : 'Khối lượng siêu nhẹ của gạch AAC giúp giảm tải trọng móng cột, tiết kiệm chi phí thép móng, đẩy nhanh 300% tốc độ thi công và bả tô.';
				?>
				<h3><?php esc_html_e( 'Cấu hình Khối 4 Thế Mạnh (Advantages)', 'bitco-theme' ); ?></h3>
				<table class="form-table">
					<tr>
						<th scope="row"><?php esc_html_e( 'Tiêu đề chung', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[adv_tag]" value="<?php echo esc_attr( $adv_tag ); ?>" class="regular-text" placeholder="Thẻ phân mục" /><br><br>
							<input type="text" name="bitco_theme_options[adv_title]" value="<?php echo esc_attr( $adv_title ); ?>" class="large-text" placeholder="Tiêu đề chính" /><br><br>
							<textarea name="bitco_theme_options[adv_subtitle]" rows="2" class="large-text" placeholder="Mô tả phụ"><?php echo esc_textarea( $adv_sub ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Thế mạnh 1 (Lò nung)', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[adv1_title]" value="<?php echo esc_attr( $adv1_t ); ?>" class="large-text" /><br><br>
							<textarea name="bitco_theme_options[adv1_desc]" rows="2" class="large-text"><?php echo esc_textarea( $adv1_d ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Thế mạnh 2 (Môi trường)', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[adv2_title]" value="<?php echo esc_attr( $adv2_t ); ?>" class="large-text" /><br><br>
							<textarea name="bitco_theme_options[adv2_desc]" rows="2" class="large-text"><?php echo esc_textarea( $adv2_d ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Thế mạnh 3 (Chống cháy)', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[adv3_title]" value="<?php echo esc_attr( $adv3_t ); ?>" class="large-text" /><br><br>
							<textarea name="bitco_theme_options[adv3_desc]" rows="2" class="large-text"><?php echo esc_textarea( $adv3_d ); ?></textarea>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Thế mạnh 4 (Tiết kiệm chi phí)', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[adv4_title]" value="<?php echo esc_attr( $adv4_t ); ?>" class="large-text" /><br><br>
							<textarea name="bitco_theme_options[adv4_desc]" rows="2" class="large-text"><?php echo esc_textarea( $adv4_d ); ?></textarea>
						</td>
					</tr>
				</table>

			<?php elseif ( 'contact' === $active_tab ) :
				$addr   = isset( $options['contact_address'] ) ? $options['contact_address'] : 'Km 1215, Quốc lộ 1A, xã Phước Lộc, huyện Tuy Phước, tỉnh Bình Định';
				$phone  = isset( $options['contact_hotline'] ) ? $options['contact_hotline'] : '0256 3832 176 - 0256 3832 809';
				$mail   = isset( $options['contact_email'] ) ? $options['contact_email'] : 'info@bitcobinhdinh.com.vn<br>congtybitcobinhdinh@gmail.com';
				$hours  = isset( $options['contact_working_hours'] ) ? $options['contact_working_hours'] : 'Thứ 2 - Thứ 7: 07:30 - 17:00 (Chủ nhật nghỉ)';
				$cf7_sc = isset( $options['contact_cf7_shortcode'] ) ? $options['contact_cf7_shortcode'] : '';
				$stock  = isset( $options['footer_stock_code'] ) ? $options['footer_stock_code'] : 'Mã Cổ Phiếu: BTN (Sàn UPCoM)';
				$copy   = isset( $options['footer_copyright'] ) ? $options['footer_copyright'] : '© 2026 Công ty Cổ phần Đầu tư BITCO Bình Định. Bảo lưu mọi quyền.';
				$fb     = isset( $options['footer_facebook_url'] ) ? $options['footer_facebook_url'] : '#';
				$yt     = isset( $options['footer_youtube_url'] ) ? $options['footer_youtube_url'] : '#';
				$li     = isset( $options['footer_linkedin_url'] ) ? $options['footer_linkedin_url'] : '#';
				?>
				<h3><?php esc_html_e( 'Cấu hình Thông Tin Doanh Nghiệp & Chân Trang (Footer)', 'bitco-theme' ); ?></h3>
				<table class="form-table">
					<tr>
						<th scope="row"><?php esc_html_e( 'Trụ sở & Nhà máy', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[contact_address]" value="<?php echo esc_attr( $addr ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Hotline kinh doanh', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[contact_hotline]" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Email liên hệ', 'bitco-theme' ); ?></th>
						<td>
							<textarea name="bitco_theme_options[contact_email]" rows="2" class="regular-text"><?php echo esc_textarea( $mail ); ?></textarea>
							<p class="description"><?php esc_html_e( 'Dùng thẻ <br> nếu có nhiều email.', 'bitco-theme' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Giờ làm việc', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[contact_working_hours]" value="<?php echo esc_attr( $hours ); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Shortcode Contact Form 7', 'bitco-theme' ); ?></th>
						<td>
							<input type="text" name="bitco_theme_options[contact_cf7_shortcode]" value="<?php echo esc_attr( $cf7_sc ); ?>" class="large-text" placeholder='[contact-form-7 id="..." title="..."]' />
							<p class="description"><?php esc_html_e( 'Để trống nếu muốn sử dụng form HTML mặc định.', 'bitco-theme' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Mã cổ phiếu', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[footer_stock_code]" value="<?php echo esc_attr( $stock ); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Mạng xã hội (Links)', 'bitco-theme' ); ?></th>
						<td>
							<p><label>Facebook: <input type="url" name="bitco_theme_options[footer_facebook_url]" value="<?php echo esc_attr( $fb ); ?>" class="regular-text" /></label></p>
							<p><label>YouTube: <input type="url" name="bitco_theme_options[footer_youtube_url]" value="<?php echo esc_attr( $yt ); ?>" class="regular-text" /></label></p>
							<p><label>LinkedIn: <input type="url" name="bitco_theme_options[footer_linkedin_url]" value="<?php echo esc_attr( $li ); ?>" class="regular-text" /></label></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php esc_html_e( 'Bản quyền chân trang', 'bitco-theme' ); ?></th>
						<td><input type="text" name="bitco_theme_options[footer_copyright]" value="<?php echo esc_attr( $copy ); ?>" class="large-text" /></td>
					</tr>
				</table>
			<?php endif; ?>

			<p class="submit" style="margin-top: 25px;">
				<input type="submit" name="submit" id="submit" class="button button-primary button-large" value="<?php esc_attr_e( 'Lưu thay đổi', 'bitco-theme' ); ?>">
			</p>
		</form>
	</div>

	<script>
	jQuery(document).ready(function($) {
		// WordPress Media Uploader Modal
		$('.bitco-upload-img-btn').on('click', function(e) {
			e.preventDefault();
			var button = $(this);
			var targetInput = $('#' + button.data('target'));
			var previewImg = $('#' + button.data('preview'));

			var customUploader = wp.media({
				title: '<?php echo esc_js( __( 'Chọn hoặc tải ảnh lên Thư viện Media', 'bitco-theme' ) ); ?>',
				button: {
					text: '<?php echo esc_js( __( 'Sử dụng ảnh này', 'bitco-theme' ) ); ?>'
				},
				multiple: false
			}).on('select', function() {
				var attachment = customUploader.state().get('selection').first().toJSON();
				targetInput.val(attachment.url);
				previewImg.attr('src', attachment.url).show();
			}).open();
		});

		// Remove Image Button
		$('.bitco-remove-img-btn').on('click', function(e) {
			e.preventDefault();
			var button = $(this);
			$('#' + button.data('target')).val('');
			$('#' + button.data('preview')).attr('src', '').hide();
		});
	});
	</script>
	<?php
}
