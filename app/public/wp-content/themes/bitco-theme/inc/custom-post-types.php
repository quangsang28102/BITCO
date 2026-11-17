<?php
/**
 * Register Custom Post Types & Native Meta Boxes
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Types
 */
function bitco_register_post_types() {
	// 1. CPT: Dự Án (du-an)
	$du_an_labels = array(
		'name'               => _x( 'Dự Án', 'post type general name', 'bitco-theme' ),
		'singular_name'      => _x( 'Dự Án', 'post type singular name', 'bitco-theme' ),
		'menu_name'          => _x( 'Dự Án BITCO', 'admin menu', 'bitco-theme' ),
		'add_new'            => _x( 'Thêm mới', 'du-an', 'bitco-theme' ),
		'add_new_item'       => __( 'Thêm dự án mới', 'bitco-theme' ),
		'edit_item'          => __( 'Chỉnh sửa dự án', 'bitco-theme' ),
		'new_item'           => __( 'Dự án mới', 'bitco-theme' ),
		'all_items'          => __( 'Tất cả dự án', 'bitco-theme' ),
		'view_item'          => __( 'Xem dự án', 'bitco-theme' ),
		'search_items'       => __( 'Tìm kiếm dự án', 'bitco-theme' ),
		'not_found'          => __( 'Không tìm thấy dự án nào', 'bitco-theme' ),
		'not_found_in_trash' => __( 'Không có dự án nào trong thùng rác', 'bitco-theme' ),
	);

	$du_an_args = array(
		'labels'             => $du_an_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'du-an' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 20,
		'menu_icon'          => 'dashicons-building',
		'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'du-an', $du_an_args );

	// 2. CPT: Sản Phẩm (san-pham)
	$san_pham_labels = array(
		'name'               => _x( 'Sản Phẩm', 'post type general name', 'bitco-theme' ),
		'singular_name'      => _x( 'Sản Phẩm', 'post type singular name', 'bitco-theme' ),
		'menu_name'          => _x( 'Sản Phẩm 3D', 'admin menu', 'bitco-theme' ),
		'add_new'            => _x( 'Thêm sản phẩm', 'san-pham', 'bitco-theme' ),
		'add_new_item'       => __( 'Thêm sản phẩm mới', 'bitco-theme' ),
		'edit_item'          => __( 'Chỉnh sửa sản phẩm', 'bitco-theme' ),
		'new_item'           => __( 'Sản phẩm mới', 'bitco-theme' ),
		'all_items'          => __( 'Tất cả sản phẩm', 'bitco-theme' ),
		'view_item'          => __( 'Xem sản phẩm', 'bitco-theme' ),
		'search_items'       => __( 'Tìm kiếm sản phẩm', 'bitco-theme' ),
		'not_found'          => __( 'Không tìm thấy sản phẩm nào', 'bitco-theme' ),
		'not_found_in_trash' => __( 'Không có sản phẩm trong thùng rác', 'bitco-theme' ),
	);

	$san_pham_args = array(
		'labels'             => $san_pham_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'san-pham' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 21,
		'menu_icon'          => 'dashicons-grid-view',
		'supports'           => array( 'title', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'san-pham', $san_pham_args );
}
add_action( 'init', 'bitco_register_post_types' );

/**
 * Add Native Meta Boxes (Native Fallback when ACF is not active)
 */
function bitco_add_custom_meta_boxes() {
	// Meta box for Dự Án
	add_meta_box(
		'bitco_du_an_meta',
		__( 'Thông tin chi tiết Dự án', 'bitco-theme' ),
		'bitco_du_an_meta_callback',
		'du-an',
		'normal',
		'high'
	);

	// Meta box for Sản Phẩm
	add_meta_box(
		'bitco_san_pham_meta',
		__( 'Thông số Kỹ thuật & 3D Showcase', 'bitco-theme' ),
		'bitco_san_pham_meta_callback',
		'san-pham',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'bitco_add_custom_meta_boxes' );

/**
 * Callback for Du An Meta Box
 */
function bitco_du_an_meta_callback( $post ) {
	wp_nonce_field( 'bitco_du_an_meta_nonce', 'du_an_nonce' );

	$location    = get_post_meta( $post->ID, 'project_location', true );
	$badge_text  = get_post_meta( $post->ID, 'project_badge_text', true );
	$badge_style = get_post_meta( $post->ID, 'project_badge_style', true ) ?: 'badge-eco';
	?>
	<table class="form-table">
		<tr>
			<th><label for="project_location"><?php esc_html_e( 'Địa điểm công trình', 'bitco-theme' ); ?></label></th>
			<td>
				<input type="text" id="project_location" name="project_location" value="<?php echo esc_attr( $location ); ?>" class="regular-text" placeholder="VD: Quy Nhơn, Bình Định" />
			</td>
		</tr>
		<tr>
			<th><label for="project_badge_text"><?php esc_html_e( 'Nhãn loại gạch / vật liệu', 'bitco-theme' ); ?></label></th>
			<td>
				<input type="text" id="project_badge_text" name="project_badge_text" value="<?php echo esc_attr( $badge_text ); ?>" class="regular-text" placeholder="VD: AAC & ALC Panel hoặc Gạch đặc Tuy Nen" />
			</td>
		</tr>
		<tr>
			<th><label for="project_badge_style"><?php esc_html_e( 'Màu sắc nhãn', 'bitco-theme' ); ?></label></th>
			<td>
				<select id="project_badge_style" name="project_badge_style">
					<option value="badge-eco" <?php selected( $badge_style, 'badge-eco' ); ?>><?php esc_html_e( 'Xanh lục (AAC / Sinh thái)', 'bitco-theme' ); ?></option>
					<option value="badge-clay" <?php selected( $badge_style, 'badge-clay' ); ?>><?php esc_html_e( 'Đỏ cam (Gạch Đất Nung)', 'bitco-theme' ); ?></option>
				</select>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Callback for San Pham Meta Box
 */
function bitco_san_pham_meta_callback( $post ) {
	wp_nonce_field( 'bitco_san_pham_meta_nonce', 'san_pham_nonce' );

	$slug_id          = get_post_meta( $post->ID, 'product_slug_id', true );
	$category         = get_post_meta( $post->ID, 'product_category', true );
	$metric_strength  = get_post_meta( $post->ID, 'metric_strength', true ) ?: 75;
	$metric_insulation= get_post_meta( $post->ID, 'metric_insulation', true ) ?: 80;
	$metric_saving    = get_post_meta( $post->ID, 'metric_saving', true ) ?: 45;
	$spec_dimension   = get_post_meta( $post->ID, 'spec_dimension', true ) ?: '220 x 105 x 150 mm';
	$spec_strength    = get_post_meta( $post->ID, 'spec_strength', true ) ?: '≥ 50 kg/cm²';
	$spec_water       = get_post_meta( $post->ID, 'spec_water_absorption', true ) ?: '≤ 12%';
	$spec_weight      = get_post_meta( $post->ID, 'spec_weight', true ) ?: '~ 2.8 kg';
	?>
	<table class="form-table">
		<tr>
			<th><label for="product_slug_id"><?php esc_html_e( 'Mã định danh 3D', 'bitco-theme' ); ?></label></th>
			<td>
				<select id="product_slug_id" name="product_slug_id">
					<option value="clay-6hole" <?php selected( $slug_id, 'clay-6hole' ); ?>><?php esc_html_e( 'clay-6hole (Gạch 6 Lỗ Tròn)', 'bitco-theme' ); ?></option>
					<option value="clay-solid" <?php selected( $slug_id, 'clay-solid' ); ?>><?php esc_html_e( 'clay-solid (Gạch Đặc Tuy Nen)', 'bitco-theme' ); ?></option>
					<option value="aac-block" <?php selected( $slug_id, 'aac-block' ); ?>><?php esc_html_e( 'aac-block (Gạch Nhẹ AAC)', 'bitco-theme' ); ?></option>
				</select>
				<p class="description"><?php esc_html_e( 'Khớp với kiểu model 3D hiển thị tương ứng trong mã nguồn.', 'bitco-theme' ); ?></p>
			</td>
		</tr>
		<tr>
			<th><label for="product_category"><?php esc_html_e( 'Danh mục sản phẩm', 'bitco-theme' ); ?></label></th>
			<td>
				<input type="text" id="product_category" name="product_category" value="<?php echo esc_attr( $category ); ?>" class="regular-text" placeholder="VD: Gạch Đất Sét Nung hoặc Vật Liệu Xanh" />
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Chỉ số năng lực (%)', 'bitco-theme' ); ?></th>
			<td>
				<label for="metric_strength"><?php esc_html_e( 'Chịu lực:', 'bitco-theme' ); ?></label>
				<input type="number" min="0" max="100" id="metric_strength" name="metric_strength" value="<?php echo esc_attr( $metric_strength ); ?>" style="width: 70px;" /> % &nbsp;|&nbsp;
				<label for="metric_insulation"><?php esc_html_e( 'Cách âm/nhiệt:', 'bitco-theme' ); ?></label>
				<input type="number" min="0" max="100" id="metric_insulation" name="metric_insulation" value="<?php echo esc_attr( $metric_insulation ); ?>" style="width: 70px;" /> % &nbsp;|&nbsp;
				<label for="metric_saving"><?php esc_html_e( 'Tối ưu tải trọng:', 'bitco-theme' ); ?></label>
				<input type="number" min="0" max="100" id="metric_saving" name="metric_saving" value="<?php echo esc_attr( $metric_saving ); ?>" style="width: 70px;" /> %
			</td>
		</tr>
		<tr>
			<th><?php esc_html_e( 'Bảng thông số kỹ thuật', 'bitco-theme' ); ?></th>
			<td>
				<p><label><?php esc_html_e( 'Kích thước:', 'bitco-theme' ); ?> <input type="text" name="spec_dimension" value="<?php echo esc_attr( $spec_dimension ); ?>" class="regular-text" /></label></p>
				<p><label><?php esc_html_e( 'Cường độ nén:', 'bitco-theme' ); ?> <input type="text" name="spec_strength" value="<?php echo esc_attr( $spec_strength ); ?>" class="regular-text" /></label></p>
				<p><label><?php esc_html_e( 'Độ hút nước:', 'bitco-theme' ); ?> <input type="text" name="spec_water_absorption" value="<?php echo esc_attr( $spec_water ); ?>" class="regular-text" /></label></p>
				<p><label><?php esc_html_e( 'Khối lượng / Thể tích:', 'bitco-theme' ); ?> <input type="text" name="spec_weight" value="<?php echo esc_attr( $spec_weight ); ?>" class="regular-text" /></label></p>
			</td>
		</tr>
	</table>
	<?php
}

/**
 * Save Meta Box Data
 */
function bitco_save_meta_boxes_data( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Save Du An
	if ( isset( $_POST['du_an_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['du_an_nonce'] ), 'bitco_du_an_meta_nonce' ) ) {
		if ( current_user_can( 'edit_post', $post_id ) ) {
			if ( isset( $_POST['project_location'] ) ) {
				update_post_meta( $post_id, 'project_location', sanitize_text_field( wp_unslash( $_POST['project_location'] ) ) );
			}
			if ( isset( $_POST['project_badge_text'] ) ) {
				update_post_meta( $post_id, 'project_badge_text', sanitize_text_field( wp_unslash( $_POST['project_badge_text'] ) ) );
			}
			if ( isset( $_POST['project_badge_style'] ) ) {
				update_post_meta( $post_id, 'project_badge_style', sanitize_text_field( wp_unslash( $_POST['project_badge_style'] ) ) );
			}
		}
	}

	// Save San Pham
	if ( isset( $_POST['san_pham_nonce'] ) && wp_verify_nonce( sanitize_key( $_POST['san_pham_nonce'] ), 'bitco_san_pham_meta_nonce' ) ) {
		if ( current_user_can( 'edit_post', $post_id ) ) {
			$fields = array(
				'product_slug_id',
				'product_category',
				'metric_strength',
				'metric_insulation',
				'metric_saving',
				'spec_dimension',
				'spec_strength',
				'spec_water_absorption',
				'spec_weight',
			);
			foreach ( $fields as $field ) {
				if ( isset( $_POST[ $field ] ) ) {
					update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
				}
			}
		}
	}
}
add_action( 'save_post', 'bitco_save_meta_boxes_data' );
