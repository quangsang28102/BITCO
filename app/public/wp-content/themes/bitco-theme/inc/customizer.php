<?php
/**
 * BITCO Theme Customizer (Flatsome Style Live Preview)
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Theme Customizer Panels, Sections, Settings and Controls
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function bitco_customize_register( $wp_customize ) {

	// ==========================================
	// MAIN PANEL: BITCO THEME OPTIONS
	// ==========================================
	$wp_customize->add_panel(
		'bitco_theme_panel',
		array(
			'title'       => __( '🎨 Tùy Biến BITCO (Live Style)', 'bitco-theme' ),
			'description' => __( 'Quản trị giao diện trực quan với Live Preview thời gian thực chuẩn Flatsome.', 'bitco-theme' ),
			'priority'    => 10,
		)
	);

	// ------------------------------------------
	// SECTION 1: COLORS & BRANDING
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_colors_section',
		array(
			'title'    => __( '1. Màu Sắc & Thương Hiệu', 'bitco-theme' ),
			'panel'    => 'bitco_theme_panel',
			'priority' => 10,
		)
	);

	// Primary Color
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => '#e8590c',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'       => __( 'Màu Chủ Đạo (Cam Gạch - Primary)', 'bitco-theme' ),
				'description' => __( 'Áp dụng cho nút bấm chính, viền, icon, thanh đo chịu lực...', 'bitco-theme' ),
				'section'     => 'bitco_colors_section',
			)
		)
	);

	// Secondary Color
	$wp_customize->add_setting(
		'secondary_color',
		array(
			'default'           => '#29a366',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color',
			array(
				'label'       => __( 'Màu Phụ Trợ (Xanh Lá - Eco)', 'bitco-theme' ),
				'description' => __( 'Áp dụng cho badge gạch AAC, chỉ số vật liệu xanh...', 'bitco-theme' ),
				'section'     => 'bitco_colors_section',
			)
		)
	);

	// Dark Section Background
	$wp_customize->add_setting(
		'dark_bg_color',
		array(
			'default'           => '#141920',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'dark_bg_color',
			array(
				'label'   => __( 'Màu Nền Tối (Dark Section Background)', 'bitco-theme' ),
				'section' => 'bitco_colors_section',
			)
		)
	);

	// ------------------------------------------
	// SECTION 2: SECTION VISIBILITY (BẬT / TẮT KHỐI)
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_visibility_section',
		array(
			'title'       => __( '2. Bật / Tắt Các Khối Giao Diện', 'bitco-theme' ),
			'panel'       => 'bitco_theme_panel',
			'description' => __( 'Tích chọn để hiển thị hoặc bỏ tích để ẩn khối nội dung tương ứng.', 'bitco-theme' ),
			'priority'    => 20,
		)
	);

	$sections_toggle = array(
		'show_hero'         => array( __( 'Khối Hero Banner', 'bitco-theme' ), 1 ),
		'show_about'        => array( __( 'Khối Giới Thiệu (About Us)', 'bitco-theme' ), 1 ),
		'show_parallax1'    => array( __( 'Banner Parallax 1 (Vật Liệu Xanh)', 'bitco-theme' ), 1 ),
		'show_products'     => array( __( 'Khối 3D Showcase Sản Phẩm', 'bitco-theme' ), 1 ),
		'show_advantages'   => array( __( 'Khối 4 Thế Mạnh Cốt Lõi', 'bitco-theme' ), 1 ),
		'show_parallax2'    => array( __( 'Banner Parallax 2 (Công Trình Trọng Điểm)', 'bitco-theme' ), 1 ),
		'show_projects'     => array( __( 'Khối Dự Án Tiêu Biểu', 'bitco-theme' ), 1 ),
		'show_contact'      => array( __( 'Khối Liên Hệ & Báo Giá', 'bitco-theme' ), 1 ),
	);

	foreach ( $sections_toggle as $setting_key => $data ) {
		$wp_customize->add_setting(
			$setting_key,
			array(
				'default'           => $data[1],
				'sanitize_callback' => 'bitco_sanitize_checkbox',
			)
		);
		$wp_customize->add_control(
			$setting_key,
			array(
				'label'    => $data[0],
				'section'  => 'bitco_visibility_section',
				'type'     => 'checkbox',
			)
		);
	}

	// ------------------------------------------
	// SECTION 3: HERO BANNER
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_hero_section',
		array(
			'title'    => __( '3. Khối Hero Banner', 'bitco-theme' ),
			'panel'    => 'bitco_theme_panel',
			'priority' => 30,
		)
	);

	// Hero Background Image Uploader
	$wp_customize->add_setting(
		'hero_bg_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hero_bg_image',
			array(
				'label'       => __( 'Ảnh Nền Hero (Background)', 'bitco-theme' ),
				'description' => __( 'Tải ảnh nền mới lên để thay thế ảnh mặc định.', 'bitco-theme' ),
				'section'     => 'bitco_hero_section',
			)
		)
	);

	// Hero Tagline
	$wp_customize->add_setting(
		'hero_tagline',
		array(
			'default'           => 'Tiêu chuẩn xây dựng tương lai',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hero_tagline',
		array(
			'label'   => __( 'Tagline Nhỏ Đầu Trang', 'bitco-theme' ),
			'section' => 'bitco_hero_section',
			'type'    => 'text',
		)
	);

	// Hero Title
	$wp_customize->add_setting(
		'hero_title',
		array(
			'default'           => 'Kiến Tạo Bền Vững<br>Với <span>Gạch Tuy Nen & AAC</span>',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hero_title',
		array(
			'label'       => __( 'Tiêu Đề Lớn Hero', 'bitco-theme' ),
			'description' => __( 'Hỗ trợ thẻ <br> để xuống dòng, <span> để đổi màu.', 'bitco-theme' ),
			'section'     => 'bitco_hero_section',
			'type'        => 'textarea',
		)
	);

	// Hero Description
	$wp_customize->add_setting(
		'hero_description',
		array(
			'default'           => 'Công ty Cổ phần Đầu tư BITCO Bình Định tự hào là đơn vị tiên phong hàng đầu tại miền Trung, kết hợp hoàn hảo giữa công nghệ lò Tuy Nen truyền thống và các giải pháp vật liệu xanh đạt chuẩn Châu Âu.',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		'hero_description',
		array(
			'label'   => __( 'Đoạn Văn Giới Thiệu Hero', 'bitco-theme' ),
			'section' => 'bitco_hero_section',
			'type'    => 'textarea',
		)
	);

	// Stats 1
	$wp_customize->add_setting( 'hero_stat1_number', array( 'default' => 50, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'hero_stat1_number', array( 'label' => __( 'Số Thống Kê 1 (Gạch Nung)', 'bitco-theme' ), 'section' => 'bitco_hero_section', 'type' => 'number' ) );

	$wp_customize->add_setting( 'hero_stat1_suffix', array( 'default' => 'M+', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_stat1_suffix', array( 'label' => __( 'Đơn Vị / Hậu Tố 1', 'bitco-theme' ), 'section' => 'bitco_hero_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'hero_stat1_label', array( 'default' => 'Viên gạch nung / Năm', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'hero_stat1_label', array( 'label' => __( 'Nhãn Thống Kê 1', 'bitco-theme' ), 'section' => 'bitco_hero_section', 'type' => 'text' ) );

	// Stats 2
	$wp_customize->add_setting( 'hero_stat2_number', array( 'default' => 100, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( 'hero_stat2_number', array( 'label' => __( 'Số Thống Kê 2 (Gạch AAC)', 'bitco-theme' ), 'section' => 'bitco_hero_section', 'type' => 'number' ) );

	$wp_customize->add_setting( 'hero_stat2_suffix', array( 'default' => 'K m³', 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'hero_stat2_suffix', array( 'label' => __( 'Đơn Vị / Hậu Tố 2', 'bitco-theme' ), 'section' => 'bitco_hero_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'hero_stat2_label', array( 'default' => 'Gạch nhẹ AAC / Năm', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'hero_stat2_label', array( 'label' => __( 'Nhãn Thống Kê 2', 'bitco-theme' ), 'section' => 'bitco_hero_section', 'type' => 'text' ) );

	// ------------------------------------------
	// SECTION 4: ABOUT US
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_about_section',
		array(
			'title'    => __( '4. Khối Giới Thiệu (About Us)', 'bitco-theme' ),
			'panel'    => 'bitco_theme_panel',
			'priority' => 40,
		)
	);

	// About Image Uploader
	$wp_customize->add_setting(
		'about_factory_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'about_factory_image',
			array(
				'label'       => __( 'Ảnh Nhà Máy BITCO', 'bitco-theme' ),
				'description' => __( 'Thay đổi ảnh nhà máy hiển thị bên trái khối giới thiệu.', 'bitco-theme' ),
				'section'     => 'bitco_about_section',
			)
		)
	);

	$wp_customize->add_setting( 'about_tag', array( 'default' => 'Hành trình & Giá trị', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'about_tag', array( 'label' => __( 'Thẻ Nhãn (Tag)', 'bitco-theme' ), 'section' => 'bitco_about_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'about_title', array( 'default' => '25 Năm Đi Cùng Các Công Trình Đất Việt', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'about_title', array( 'label' => __( 'Tiêu Đề Khối Giới Thiệu', 'bitco-theme' ), 'section' => 'bitco_about_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'about_badge_title', array( 'default' => 'BITCO Bình Định', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'about_badge_title', array( 'label' => __( 'Tiêu Đề Huy Hiệu Uy Tín', 'bitco-theme' ), 'section' => 'bitco_about_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'about_badge_desc', array( 'default' => 'Thành lập từ 2001 - Hơn 25 năm uy tín', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'about_badge_desc', array( 'label' => __( 'Mô Tả Huy Hiệu Uy Tín', 'bitco-theme' ), 'section' => 'bitco_about_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'about_story_1', array( 'default' => 'Tiền thân từ các đơn vị sản xuất gạch ngói lâu đời của tỉnh Bình Định, được cổ phần hóa vào năm 2001, BITCO (Mã CK: BTN) đã không ngừng cải tiến công nghệ lò nung Tuy Nen công suất lớn.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'about_story_1', array( 'label' => __( 'Nội Dung Đoạn 1', 'bitco-theme' ), 'section' => 'bitco_about_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'about_story_2', array( 'default' => 'Với tầm nhìn xanh, chúng tôi đã chủ động đầu tư dây chuyền sản xuất bê tông khí chưng áp (AAC) hiện đại của Đức, đưa BITCO trở thành đơn vị duy nhất cung cấp trọn gói giải pháp vật liệu xây dựng nung và không nung tối ưu cho mọi công trình.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'about_story_2', array( 'label' => __( 'Nội Dung Đoạn 2', 'bitco-theme' ), 'section' => 'bitco_about_section', 'type' => 'textarea' ) );

	// ------------------------------------------
	// SECTION 5: PARALLAX 1 (VẬT LIỆU XANH)
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_parallax1_section',
		array(
			'title'    => __( '5. Banner Parallax 1 (Vật Liệu Xanh)', 'bitco-theme' ),
			'panel'    => 'bitco_theme_panel',
			'priority' => 50,
		)
	);

	$wp_customize->add_setting( 'parallax1_bg_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'parallax1_bg_image',
			array(
				'label'   => __( 'Ảnh Nền Parallax 1', 'bitco-theme' ),
				'section' => 'bitco_parallax1_section',
			)
		)
	);

	$wp_customize->add_setting( 'parallax1_title', array( 'default' => 'Phát Triển Vật Liệu Xanh Vì Môi Trường Bền Vững', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'parallax1_title', array( 'label' => __( 'Tiêu Đề Parallax 1', 'bitco-theme' ), 'section' => 'bitco_parallax1_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'parallax1_desc', array( 'default' => 'Chúng tôi không ngừng đổi mới công nghệ, áp dụng tiêu chuẩn xanh vào từng quy trình sản xuất để kiến tạo các công trình sinh thái thông minh.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'parallax1_desc', array( 'label' => __( 'Mô Tả Parallax 1', 'bitco-theme' ), 'section' => 'bitco_parallax1_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'parallax1_btn_text', array( 'default' => 'Nhận tư vấn vật liệu xanh', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'parallax1_btn_text', array( 'label' => __( 'Chữ Trên Nút Bấm', 'bitco-theme' ), 'section' => 'bitco_parallax1_section', 'type' => 'text' ) );

	// ------------------------------------------
	// SECTION 6: PARALLAX 2 (CÔNG TRÌNH TRỌNG ĐIỂM)
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_parallax2_section',
		array(
			'title'    => __( '6. Banner Parallax 2 (Công Trình)', 'bitco-theme' ),
			'panel'    => 'bitco_theme_panel',
			'priority' => 60,
		)
	);

	$wp_customize->add_setting( 'parallax2_bg_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'parallax2_bg_image',
			array(
				'label'   => __( 'Ảnh Nền Parallax 2', 'bitco-theme' ),
				'section' => 'bitco_parallax2_section',
			)
		)
	);

	$wp_customize->add_setting( 'parallax2_title', array( 'default' => 'Đồng Hành Cùng Những Công Trình Trọng Điểm', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'parallax2_title', array( 'label' => __( 'Tiêu Đề Parallax 2', 'bitco-theme' ), 'section' => 'bitco_parallax2_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'parallax2_desc', array( 'default' => 'Với năng lực sản xuất lớn và đội ngũ kỹ thuật lành nghề, BITCO tự hào cung ứng vật liệu xây dựng cho hàng ngàn dự án đô thị và khu công nghiệp lớn.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'parallax2_desc', array( 'label' => __( 'Mô Tả Parallax 2', 'bitco-theme' ), 'section' => 'bitco_parallax2_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'parallax2_btn_text', array( 'default' => 'Liên hệ nhận catalog & mẫu thử', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'parallax2_btn_text', array( 'label' => __( 'Chữ Trên Nút Bấm', 'bitco-theme' ), 'section' => 'bitco_parallax2_section', 'type' => 'text' ) );

	// ------------------------------------------
	// SECTION 7: CONTACT & FOOTER INFO
	// ------------------------------------------
	$wp_customize->add_section(
		'bitco_contact_section',
		array(
			'title'    => __( '7. Thông Tin Liên Hệ & Footer', 'bitco-theme' ),
			'panel'    => 'bitco_theme_panel',
			'priority' => 70,
		)
	);

	$wp_customize->add_setting( 'contact_address', array( 'default' => 'Km 1215, Quốc lộ 1A, xã Phước Lộc, huyện Tuy Phước, tỉnh Bình Định', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'contact_address', array( 'label' => __( 'Địa Chỉ Trụ Sở & Nhà Máy', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'contact_hotline', array( 'default' => '0256 3832 176 - 0256 3832 809', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'contact_hotline', array( 'label' => __( 'Hotline Kinh Doanh', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'contact_email', array( 'default' => 'info@bitcobinhdinh.com.vn<br>congtybitcobinhdinh@gmail.com', 'sanitize_callback' => 'wp_kses_post', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'contact_email', array( 'label' => __( 'Email Liên Hệ', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'contact_working_hours', array( 'default' => 'Thứ 2 - Thứ 7: 07:30 - 17:00 (Chủ nhật nghỉ)', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'contact_working_hours', array( 'label' => __( 'Giờ Làm Việc', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'footer_stock_code', array( 'default' => 'Mã Cổ Phiếu: BTN (Sàn UPCoM)', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'footer_stock_code', array( 'label' => __( 'Mã Cổ Phiếu Niêm Yết', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'text' ) );

	$wp_customize->add_setting( 'footer_facebook_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'footer_facebook_url', array( 'label' => __( 'Link Facebook', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'url' ) );

	$wp_customize->add_setting( 'footer_youtube_url', array( 'default' => '#', 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( 'footer_youtube_url', array( 'label' => __( 'Link YouTube', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'url' ) );

	$wp_customize->add_setting( 'footer_copyright', array( 'default' => '© 2026 Công ty Cổ phần Đầu tư BITCO Bình Định. Bảo lưu mọi quyền.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'postMessage' ) );
	$wp_customize->add_control( 'footer_copyright', array( 'label' => __( 'Dòng Chữ Bản Quyền Chân Trang', 'bitco-theme' ), 'section' => 'bitco_contact_section', 'type' => 'text' ) );
}
add_action( 'customize_register', 'bitco_customize_register' );

/**
 * Checkbox sanitization callback
 */
function bitco_sanitize_checkbox( $checked ) {
	return ( isset( $checked ) && true == $checked ) ? 1 : 0;
}

/**
 * Enqueue Customizer Live Preview JS
 */
function bitco_customize_preview_js() {
	wp_enqueue_script(
		'bitco-customizer-preview',
		get_template_directory_uri() . '/assets/js/customizer-preview.js',
		array( 'customize-preview', 'jquery' ),
		wp_get_theme()->get( 'Version' ),
		true
	);
}
add_action( 'customize_preview_init', 'bitco_customize_preview_js' );

/**
 * Output dynamic CSS in head based on Customizer Color settings
 */
function bitco_customizer_css() {
	$primary   = get_theme_mod( 'primary_color', '#e8590c' );
	$secondary = get_theme_mod( 'secondary_color', '#29a366' );
	$dark_bg   = get_theme_mod( 'dark_bg_color', '#141920' );

	$custom_css = "
		:root {
			--primary: {$primary} !important;
			--secondary: {$secondary} !important;
			--dark-bg: {$dark_bg} !important;
		}
		.btn-primary {
			background: linear-gradient(135deg, {$primary} 0%, {$primary}dd 100%) !important;
		}
	";

	wp_add_inline_style( 'bitco-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'bitco_customizer_css', 20 );
