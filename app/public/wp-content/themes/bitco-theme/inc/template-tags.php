<?php
/**
 * Custom Template Tags & Helper Functions
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Helper to get a field value with fallback.
 * Checks ACF get_field() on front page, then fallback.
 *
 * @param string $field_name Field name.
 * @param mixed  $default    Default value if empty.
 * @return mixed
 */
function bitco_get_field( $field_name, $default = '' ) {
	// 1. Check Customizer / theme_mod (Flatsome style live preview)
	$theme_mod_val = get_theme_mod( $field_name );
	if ( ! empty( $theme_mod_val ) || $theme_mod_val === '0' || $theme_mod_val === 0 ) {
		return $theme_mod_val;
	}

	// 2. Check Native Theme Options (from Admin Settings page)
	$theme_options = get_option( 'bitco_theme_options', array() );
	if ( is_array( $theme_options ) && isset( $theme_options[ $field_name ] ) && '' !== $theme_options[ $field_name ] ) {
		return $theme_options[ $field_name ];
	}

	// 3. Check ACF get_field() on front page if ACF plugin is active
	$front_page_id = get_option( 'page_on_front' );
	$value         = '';

	if ( function_exists( 'get_field' ) ) {
		if ( $front_page_id ) {
			$value = get_field( $field_name, $front_page_id );
		}
		if ( empty( $value ) ) {
			$value = get_field( $field_name );
		}
	}

	if ( ! empty( $value ) || $value === '0' || $value === 0 ) {
		return $value;
	}

	return $default;
}

/**
 * Returns the default 3D Products data structure.
 *
 * @return array
 */
function bitco_get_default_products_data() {
	return array(
		'clay-6hole' => array(
			'category' => __( 'Gạch Đất Sét Nung', 'bitco-theme' ),
			'title'    => __( 'Gạch Tuy Nen 6 Lỗ Tròn', 'bitco-theme' ),
			'desc'     => __( 'Dòng sản phẩm gạch xây dựng truyền thống phổ biến nhất, tối ưu giữa trọng lượng và khả năng cách âm cách nhiệt nhờ cấu trúc rỗng 6 lỗ tròn.', 'bitco-theme' ),
			'realImg'  => 'images/clay_6hole_real.png',
			'metrics'  => array(
				'strength'   => array( 'val' => '75%', 'percent' => 75, 'color' => 'var(--primary)' ),
				'insulation' => array( 'val' => '80%', 'percent' => 80, 'color' => 'var(--primary)' ),
				'saving'     => array( 'val' => '45%', 'percent' => 45, 'color' => 'var(--primary)' ),
			),
			'specs'    => array(
				array( 'name' => __( 'Kích thước', 'bitco-theme' ), 'val' => '220 x 105 x 150 mm' ),
				array( 'name' => __( 'Cường độ nén', 'bitco-theme' ), 'val' => '≥ 50 kg/cm²' ),
				array( 'name' => __( 'Độ hút nước', 'bitco-theme' ), 'val' => '≤ 12%' ),
				array( 'name' => __( 'Khối lượng viên', 'bitco-theme' ), 'val' => '~ 2.8 kg' ),
			),
			'hotspots' => array(
				array(
					'top'   => '30%',
					'left'  => '20%',
					'title' => __( 'Lỗ rỗng cách nhiệt', 'bitco-theme' ),
					'desc'  => __( 'Thiết kế 6 lỗ tròn đối xứng tạo lớp đệm không khí chống nóng và cách âm xuất sắc.', 'bitco-theme' ),
				),
				array(
					'top'   => '70%',
					'left'  => '50%',
					'title' => __( 'Mác chịu lực ổn định', 'bitco-theme' ),
					'desc'  => __( 'Đạt mác M50 chịu lực tốt cho tường bao che của các chung cư và nhà phố.', 'bitco-theme' ),
				),
				array(
					'top'   => '40%',
					'left'  => '80%',
					'title' => __( 'Bề mặt nhám bám vữa', 'bitco-theme' ),
					'desc'  => __( 'Thiết kế các rãnh nhám nhỏ giúp liên kết vữa trát cực kỳ chắc chắn.', 'bitco-theme' ),
				),
			),
		),
		'clay-solid' => array(
			'category' => __( 'Gạch Đất Sét Nung', 'bitco-theme' ),
			'title'    => __( 'Gạch Đặc Tuy Nen Cao Cấp', 'bitco-theme' ),
			'desc'     => __( 'Được đúc đặc hoàn toàn từ đất sét tự nhiên nung chín ở nhiệt độ cao. Thích hợp cho các hạng mục chịu lực mạnh và chống ẩm tuyệt đối.', 'bitco-theme' ),
			'realImg'  => 'images/clay_solid_real.png',
			'metrics'  => array(
				'strength'   => array( 'val' => '95%', 'percent' => 95, 'color' => 'var(--primary)' ),
				'insulation' => array( 'val' => '50%', 'percent' => 50, 'color' => 'var(--primary)' ),
				'saving'     => array( 'val' => '10%', 'percent' => 10, 'color' => 'var(--primary)' ),
			),
			'specs'    => array(
				array( 'name' => __( 'Kích thước', 'bitco-theme' ), 'val' => '205 x 95 x 55 mm' ),
				array( 'name' => __( 'Cường độ nén', 'bitco-theme' ), 'val' => '≥ 75 kg/cm² (Mác 75)' ),
				array( 'name' => __( 'Độ hút nước', 'bitco-theme' ), 'val' => '≤ 8%' ),
				array( 'name' => __( 'Khối lượng viên', 'bitco-theme' ), 'val' => '~ 2.2 kg' ),
			),
			'hotspots' => array(
				array(
					'top'   => '35%',
					'left'  => '25%',
					'title' => __( 'Đúc đặc nguyên khối', 'bitco-theme' ),
					'desc'  => __( 'Không rỗng khí bên trong, mang lại khả năng chịu lực nén tối đa cho phần móng và tường chịu lực.', 'bitco-theme' ),
				),
				array(
					'top'   => '65%',
					'left'  => '75%',
					'title' => __( 'Chống thấm nước vượt trội', 'bitco-theme' ),
					'desc'  => __( 'Mật độ đất sét cao giảm độ hút nước xuống dưới 8%, lý tưởng cho xây bể nước, hố ga.', 'bitco-theme' ),
				),
			),
		),
		'aac-block'  => array(
			'category' => __( 'Vật Liệu Xanh (Eco-Friendly)', 'bitco-theme' ),
			'title'    => __( 'Gạch Nhẹ Bê Tông Khí Chưng Áp AAC', 'bitco-theme' ),
			'desc'     => __( 'Công nghệ sản xuất hiện đại từ Đức. Cấu trúc bọt khí li ti giúp cách âm chống cháy đỉnh cao và giảm tải trọng móng lên tới 30%.', 'bitco-theme' ),
			'realImg'  => 'images/aac_block_real.png',
			'metrics'  => array(
				'strength'   => array( 'val' => '85%', 'percent' => 85, 'color' => 'var(--secondary)' ),
				'insulation' => array( 'val' => '98%', 'percent' => 98, 'color' => 'var(--secondary)' ),
				'saving'     => array( 'val' => '90%', 'percent' => 90, 'color' => 'var(--secondary)' ),
			),
			'specs'    => array(
				array( 'name' => __( 'Kích thước chuẩn', 'bitco-theme' ), 'val' => '600 x 200 x 100/150/200 mm' ),
				array( 'name' => __( 'Khối lượng thể tích', 'bitco-theme' ), 'val' => '600 - 700 kg/m³' ),
				array( 'name' => __( 'Độ chống cháy', 'bitco-theme' ), 'val' => 'EI 240 (Chống cháy 4 giờ)' ),
				array( 'name' => __( 'Hệ số dẫn nhiệt', 'bitco-theme' ), 'val' => '0.11 - 0.13 W/m.K' ),
			),
			'hotspots' => array(
				array(
					'top'   => '30%',
					'left'  => '30%',
					'title' => __( 'Cấu trúc bọt khí chưng áp', 'bitco-theme' ),
					'desc'  => __( 'Hàng triệu bọt khí siêu nhỏ phân bổ đều ngăn chặn sự truyền nhiệt và truyền âm.', 'bitco-theme' ),
				),
				array(
					'top'   => '70%',
					'left'  => '70%',
					'title' => __( 'Kích thước lớn chuẩn xác', 'bitco-theme' ),
					'desc'  => __( 'Một viên gạch AAC bằng 8 viên gạch đất nung thông thường, giúp tốc độ xây lên gấp 3 lần.', 'bitco-theme' ),
				),
			),
		),
	);
}

/**
 * Retrieves products 3D data dynamically from CPT 'san-pham'.
 * Fallbacks to default data if empty.
 *
 * @return array
 */
function bitco_get_products_3d_data() {
	$products = array();

	$args = array(
		'post_type'      => 'san-pham',
		'posts_per_page' => 10,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	);

	$query = new WP_Query( $args );

	if ( $query->have_posts() ) {
		while ( $query->have_posts() ) {
			$query->the_post();
			$post_id = get_the_ID();
			$slug    = get_post_meta( $post_id, 'product_slug_id', true );
			if ( empty( $slug ) ) {
				$slug = get_post_field( 'post_name', $post_id );
			}

			$category = get_post_meta( $post_id, 'product_category', true );
			if ( empty( $category ) ) {
				$category = __( 'Sản phẩm BITCO', 'bitco-theme' );
			}

			$real_img = get_the_post_thumbnail_url( $post_id, 'large' );
			if ( empty( $real_img ) ) {
				$real_img = 'images/clay_bricks.png';
			}

			$theme_color = ( 'aac-block' === $slug ) ? 'var(--secondary)' : 'var(--primary)';

			$strength_val   = get_post_meta( $post_id, 'metric_strength', true );
			$insulation_val = get_post_meta( $post_id, 'metric_insulation', true );
			$saving_val     = get_post_meta( $post_id, 'metric_saving', true );

			$strength_val   = ( '' !== $strength_val ) ? intval( $strength_val ) : 75;
			$insulation_val = ( '' !== $insulation_val ) ? intval( $insulation_val ) : 80;
			$saving_val     = ( '' !== $saving_val ) ? intval( $saving_val ) : 45;

			$specs = array(
				array( 'name' => __( 'Kích thước', 'bitco-theme' ), 'val' => get_post_meta( $post_id, 'spec_dimension', true ) ?: '220 x 105 x 150 mm' ),
				array( 'name' => __( 'Cường độ nén', 'bitco-theme' ), 'val' => get_post_meta( $post_id, 'spec_strength', true ) ?: '≥ 50 kg/cm²' ),
				array( 'name' => __( 'Độ hút nước', 'bitco-theme' ), 'val' => get_post_meta( $post_id, 'spec_water_absorption', true ) ?: '≤ 12%' ),
				array( 'name' => __( 'Khối lượng / Thể tích', 'bitco-theme' ), 'val' => get_post_meta( $post_id, 'spec_weight', true ) ?: '~ 2.8 kg' ),
			);

			$hotspots_raw = get_post_meta( $post_id, 'hotspots_json', true );
			$hotspots     = array();
			if ( ! empty( $hotspots_raw ) ) {
				$decoded = json_decode( $hotspots_raw, true );
				if ( is_array( $decoded ) ) {
					$hotspots = $decoded;
				}
			}

			$products[ $slug ] = array(
				'category' => $category,
				'title'    => get_the_title(),
				'desc'     => get_the_excerpt() ?: get_the_title(),
				'realImg'  => $real_img,
				'metrics'  => array(
					'strength'   => array( 'val' => $strength_val . '%', 'percent' => $strength_val, 'color' => $theme_color ),
					'insulation' => array( 'val' => $insulation_val . '%', 'percent' => $insulation_val, 'color' => $theme_color ),
					'saving'     => array( 'val' => $saving_val . '%', 'percent' => $saving_val, 'color' => $theme_color ),
				),
				'specs'    => $specs,
				'hotspots' => $hotspots,
			);
		}
		wp_reset_postdata();
	}

	if ( empty( $products ) ) {
		return bitco_get_default_products_data();
	}

	return $products;
}
