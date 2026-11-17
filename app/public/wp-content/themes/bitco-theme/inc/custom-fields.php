<?php
/**
 * ACF Free Local Field Group Registration for Front Page
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Configure ACF JSON save & load points
 */
function bitco_acf_json_save_point( $path ) {
	return get_template_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'bitco_acf_json_save_point' );

function bitco_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_template_directory() . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'bitco_acf_json_load_point' );

/**
 * Register ACF Local Field Group for Front Page
 */
function bitco_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_bitco_front_page',
		'title' => __( 'Cấu hình Trang Chủ BITCO', 'bitco-theme' ),
		'fields' => array(
			// TAB: HERO
			array(
				'key' => 'field_tab_hero',
				'label' => __( 'Khối Hero Banner', 'bitco-theme' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_hero_tagline',
				'label' => __( 'Tagline Hero', 'bitco-theme' ),
				'name' => 'hero_tagline',
				'type' => 'text',
				'default_value' => 'Tiêu chuẩn xây dựng tương lai',
			),
			array(
				'key' => 'field_hero_title',
				'label' => __( 'Tiêu đề chính', 'bitco-theme' ),
				'name' => 'hero_title',
				'type' => 'textarea',
				'rows' => 3,
				'default_value' => 'Kiến Tạo Bền Vững<br>Với <span>Gạch Tuy Nen & AAC</span>',
			),
			array(
				'key' => 'field_hero_description',
				'label' => __( 'Mô tả giới thiệu', 'bitco-theme' ),
				'name' => 'hero_description',
				'type' => 'textarea',
				'rows' => 4,
				'default_value' => 'Công ty Cổ phần Đầu tư BITCO Bình Định tự hào là đơn vị tiên phong hàng đầu tại miền Trung, kết hợp hoàn hảo giữa công nghệ lò Tuy Nen truyền thống và các giải pháp vật liệu xanh đạt chuẩn Châu Âu.',
			),
			array(
				'key' => 'field_hero_stat1_number',
				'label' => __( 'Chỉ số 1: Số lượng', 'bitco-theme' ),
				'name' => 'hero_stat1_number',
				'type' => 'number',
				'default_value' => 50,
			),
			array(
				'key' => 'field_hero_stat1_suffix',
				'label' => __( 'Chỉ số 1: Hậu tố', 'bitco-theme' ),
				'name' => 'hero_stat1_suffix',
				'type' => 'text',
				'default_value' => 'M+',
			),
			array(
				'key' => 'field_hero_stat1_label',
				'label' => __( 'Chỉ số 1: Nhãn', 'bitco-theme' ),
				'name' => 'hero_stat1_label',
				'type' => 'text',
				'default_value' => 'Viên gạch nung / Năm',
			),
			array(
				'key' => 'field_hero_stat2_number',
				'label' => __( 'Chỉ số 2: Số lượng', 'bitco-theme' ),
				'name' => 'hero_stat2_number',
				'type' => 'number',
				'default_value' => 100,
			),
			array(
				'key' => 'field_hero_stat2_suffix',
				'label' => __( 'Chỉ số 2: Hậu tố', 'bitco-theme' ),
				'name' => 'hero_stat2_suffix',
				'type' => 'text',
				'default_value' => 'K m³',
			),
			array(
				'key' => 'field_hero_stat2_label',
				'label' => __( 'Chỉ số 2: Nhãn', 'bitco-theme' ),
				'name' => 'hero_stat2_label',
				'type' => 'text',
				'default_value' => 'Gạch nhẹ AAC / Năm',
			),

			// TAB: ABOUT
			array(
				'key' => 'field_tab_about',
				'label' => __( 'Khối Giới thiệu (About)', 'bitco-theme' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_about_tag',
				'label' => __( 'Thẻ nhãn (Tag)', 'bitco-theme' ),
				'name' => 'about_tag',
				'type' => 'text',
				'default_value' => 'Hành trình & Giá trị',
			),
			array(
				'key' => 'field_about_title',
				'label' => __( 'Tiêu đề phần Giới thiệu', 'bitco-theme' ),
				'name' => 'about_title',
				'type' => 'text',
				'default_value' => '25 Năm Đi Cùng Các Công Trình Đất Việt',
			),
			array(
				'key' => 'field_about_story_1',
				'label' => __( 'Đoạn văn 1', 'bitco-theme' ),
				'name' => 'about_story_1',
				'type' => 'textarea',
				'default_value' => 'Tiền thân từ các đơn vị sản xuất gạch ngói lâu đời của tỉnh Bình Định, được cổ phần hóa vào năm 2001, BITCO (Mã CK: BTN) đã không ngừng cải tiến công nghệ lò nung Tuy Nen công suất lớn.',
			),
			array(
				'key' => 'field_about_story_2',
				'label' => __( 'Đoạn văn 2', 'bitco-theme' ),
				'name' => 'about_story_2',
				'type' => 'textarea',
				'default_value' => 'Với tầm nhìn xanh, chúng tôi đã chủ động đầu tư dây chuyền sản xuất bê tông khí chưng áp (AAC) hiện đại của Đức, đưa BITCO trở thành đơn vị duy nhất cung cấp trọn gói giải pháp vật liệu xây dựng nung và không nung tối ưu cho mọi công trình.',
			),

			// TAB: PARALLAX 1
			array(
				'key' => 'field_tab_parallax1',
				'label' => __( 'Banner Parallax 1', 'bitco-theme' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_parallax1_title',
				'label' => __( 'Tiêu đề Parallax 1', 'bitco-theme' ),
				'name' => 'parallax1_title',
				'type' => 'text',
				'default_value' => 'Phát Triển Vật Liệu Xanh Vì Môi Trường Bền Vững',
			),
			array(
				'key' => 'field_parallax1_desc',
				'label' => __( 'Mô tả Parallax 1', 'bitco-theme' ),
				'name' => 'parallax1_desc',
				'type' => 'textarea',
				'default_value' => 'Chúng tôi không ngừng đổi mới công nghệ, áp dụng tiêu chuẩn xanh vào từng quy trình sản xuất để kiến tạo các công trình sinh thái thông minh.',
			),
			array(
				'key' => 'field_parallax1_btn_text',
				'label' => __( 'Nút kêu gọi Parallax 1', 'bitco-theme' ),
				'name' => 'parallax1_btn_text',
				'type' => 'text',
				'default_value' => 'Nhận tư vấn vật liệu xanh',
			),

			// TAB: CONTACT & THEME INFO
			array(
				'key' => 'field_tab_contact',
				'label' => __( 'Thông Tin Liên Hệ & Footer', 'bitco-theme' ),
				'type' => 'tab',
			),
			array(
				'key' => 'field_contact_address',
				'label' => __( 'Trụ sở chính & Nhà máy', 'bitco-theme' ),
				'name' => 'contact_address',
				'type' => 'text',
				'default_value' => 'Km 1215, Quốc lộ 1A, xã Phước Lộc, huyện Tuy Phước, tỉnh Bình Định',
			),
			array(
				'key' => 'field_contact_hotline',
				'label' => __( 'Hotline Kinh doanh', 'bitco-theme' ),
				'name' => 'contact_hotline',
				'type' => 'text',
				'default_value' => '0256 3832 176 - 0256 3832 809',
			),
			array(
				'key' => 'field_contact_email',
				'label' => __( 'Email liên hệ', 'bitco-theme' ),
				'name' => 'contact_email',
				'type' => 'text',
				'default_value' => 'info@bitcobinhdinh.com.vn',
			),
			array(
				'key' => 'field_contact_working_hours',
				'label' => __( 'Giờ làm việc', 'bitco-theme' ),
				'name' => 'contact_working_hours',
				'type' => 'text',
				'default_value' => 'Thứ 2 - Thứ 7: 07:30 - 17:00 (Chủ nhật nghỉ)',
			),
			array(
				'key' => 'field_contact_cf7_shortcode',
				'label' => __( 'Contact Form 7 Shortcode', 'bitco-theme' ),
				'name' => 'contact_cf7_shortcode',
				'type' => 'text',
				'instructions' => __( 'Dán shortcode form CF7 vào đây (ví dụ: [contact-form-7 id="123" title="Báo giá"]). Để trống sẽ dùng form mặc định.', 'bitco-theme' ),
			),
			array(
				'key' => 'field_footer_stock_code',
				'label' => __( 'Mã Cổ Phiếu', 'bitco-theme' ),
				'name' => 'footer_stock_code',
				'type' => 'text',
				'default_value' => 'Mã Cổ Phiếu: BTN (Sàn UPCoM)',
			),
			array(
				'key' => 'field_footer_copyright',
				'label' => __( 'Dòng bản quyền', 'bitco-theme' ),
				'name' => 'footer_copyright',
				'type' => 'text',
				'default_value' => '© 2026 Công ty Cổ phần Đầu tư BITCO Bình Định. Bảo lưu mọi quyền.',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
	) );
}
add_action( 'acf/init', 'bitco_register_acf_fields' );
