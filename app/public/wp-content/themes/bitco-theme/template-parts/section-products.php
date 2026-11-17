<?php
/**
 * Template part: Products 3D Showcase Section
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$products_data = bitco_get_products_3d_data();
$first_slug    = array_key_first( $products_data ) ?: 'clay-6hole';
$first_product = isset( $products_data[ $first_slug ] ) ? $products_data[ $first_slug ] : array();

$category_initial = isset( $first_product['category'] ) ? $first_product['category'] : __( 'Gạch Đất Sét Nung', 'bitco-theme' );
$title_initial    = isset( $first_product['title'] ) ? $first_product['title'] : __( 'Gạch Tuy Nen 6 Lỗ Tròn', 'bitco-theme' );
$desc_initial     = isset( $first_product['desc'] ) ? $first_product['desc'] : __( 'Dòng sản phẩm gạch xây dựng truyền thống phổ biến nhất, tối ưu giữa trọng lượng và khả năng cách âm cách nhiệt nhờ cấu trúc rỗng 6 lỗ tròn.', 'bitco-theme' );
?>
<!-- ==========================================
     PRODUCTS SECTION
     ========================================== -->
<section id="products" class="section" style="background-color: #f8fafc;">
	<?php get_template_part( 'template-parts/builder-svg', null, array( 'index' => 1 ) ); ?>

	<div class="container">
		<div class="section-header reveal fade-up">
			<div class="section-tag"><?php esc_html_e( 'Trải nghiệm tương tác 3D', 'bitco-theme' ); ?></div>
			<h2 class="section-title"><?php esc_html_e( 'Chi Tiết Cấu Trúc Vật Liệu', 'bitco-theme' ); ?></h2>
			<p class="section-subtitle"><?php esc_html_e( 'Khám phá chi tiết thông số kỹ thuật và cấu tạo 3D của các dòng gạch chủ lực do BITCO sản xuất dưới góc nhìn công nghệ.', 'bitco-theme' ); ?></p>
		</div>

		<!-- View mode selector (3D Design vs Real Image) -->
		<div class="view-mode-tabs-container reveal fade-up delay-100">
			<button class="view-mode-tab active" data-mode="3d">
				<i class="fa-solid fa-cube"></i> <?php esc_html_e( 'Thiết Kế 3D Tương Tác', 'bitco-theme' ); ?>
			</button>
			<button class="view-mode-tab" data-mode="real">
				<i class="fa-solid fa-image"></i> <?php esc_html_e( 'Hình Ảnh Thực Tế Cận Cảnh', 'bitco-theme' ); ?>
			</button>
		</div>

		<!-- Showcase Box -->
		<div class="tech-showcase-container reveal fade-up delay-200" id="techShowcase">
			<!-- 3D Scene Viewport -->
			<div class="scene-viewport" id="sceneViewport">
				<!-- Floating Product Switcher pill -->
				<div class="floating-product-tabs">
					<?php
					$tab_index = 0;
					foreach ( $products_data as $slug => $prod ) :
						$active_class = ( 0 === $tab_index ) ? ' active' : '';
						?>
						<button class="floating-tab<?php echo esc_attr( $active_class ); ?>" data-product="<?php echo esc_attr( $slug ); ?>">
							<?php echo esc_html( $prod['title'] ); ?>
						</button>
						<?php
						$tab_index++;
					endforeach;
					?>
				</div>

				<!-- 3D View Mode Content -->
				<div class="brick-3d-scene" id="brick3DScene" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; position: relative;">
					<div class="scene-hints">
						<span><i class="fa-solid fa-arrows-to-eye"></i> <?php esc_html_e( 'Di chuột để xoay 3D / Kéo để quay tự do', 'bitco-theme' ); ?></span>
					</div>
					<div id="brickModel" class="brick-3d <?php echo esc_attr( $first_slug ); ?>">
						<!-- Front Face (where hotspots are placed) -->
						<div class="face front">
							<!-- Inner holes grid -->
							<div class="holes-grid" id="frontHoles">
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
							</div>
							
							<!-- Hotspots -->
							<div id="hotspotsContainer">
								<!-- Generated dynamically in JS -->
							</div>
						</div>
						
						<!-- Back Face -->
						<div class="face back">
							<div class="holes-grid" id="backHoles">
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
								<span class="hole"></span>
							</div>
						</div>
						
						<!-- Other Faces -->
						<div class="face left"></div>
						<div class="face right"></div>
						<div class="face top"></div>
						<div class="face bottom"></div>
					</div>
				</div>

				<!-- Real Image View Mode Content -->
				<div class="real-image-viewport" id="realImageViewport" style="display: none; width: 100%; height: 100%; position: relative; overflow: hidden; align-items: center; justify-content: center;">
					<div class="zoom-image-wrapper" id="zoomImageWrapper" style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; overflow: hidden; cursor: zoom-in;">
						<img src="<?php echo esc_url( $theme_uri . '/assets/images/clay_6hole_real.png' ); ?>" alt="<?php esc_attr_e( 'Real brick photograph', 'bitco-theme' ); ?>" id="realBrickImage" class="zoom-image" style="max-width: 90%; max-height: 90%; object-fit: contain; transition: transform 0.1s ease-out; transform-origin: center center;">
					</div>
					<div class="zoom-instructions" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); background: rgba(0,0,0,0.6); color: white; padding: 6px 14px; border-radius: 20px; font-size: 0.8rem; pointer-events: none; backdrop-filter: blur(4px);">
						<span><i class="fa-solid fa-magnifying-glass-plus"></i> <?php esc_html_e( 'Di chuột để zoom cận cảnh chi tiết', 'bitco-theme' ); ?></span>
					</div>
				</div>
			</div>

			<!-- Tech Spec Panel -->
			<div class="tech-spec-panel">
				<div class="spec-badge" id="productCategory"><?php echo esc_html( $category_initial ); ?></div>
				<h3 class="spec-title" id="productTitle"><?php echo esc_html( $title_initial ); ?></h3>
				<p class="spec-description" id="productDesc"><?php echo esc_html( $desc_initial ); ?></p>
				
				<!-- Visual spec indicators -->
				<div class="performance-metrics">
					<h4 class="metrics-title"><?php esc_html_e( 'Chỉ Số Năng Lực Vật Liệu', 'bitco-theme' ); ?></h4>
					
					<div class="metric-row">
						<div class="metric-label">
							<span><?php esc_html_e( 'Chịu Lực (Strength)', 'bitco-theme' ); ?></span>
							<span id="metricStrengthVal">75%</span>
						</div>
						<div class="metric-bar-bg">
							<div class="metric-bar-fill" id="metricStrengthBar" style="width: 75%; background-color: var(--primary);"></div>
						</div>
					</div>

					<div class="metric-row">
						<div class="metric-label">
							<span><?php esc_html_e( 'Cách Âm / Cách Nhiệt', 'bitco-theme' ); ?></span>
							<span id="metricInsulationVal">80%</span>
						</div>
						<div class="metric-bar-bg">
							<div class="metric-bar-fill" id="metricInsulationBar" style="width: 80%; background-color: var(--primary);"></div>
						</div>
					</div>

					<div class="metric-row">
						<div class="metric-label">
							<span><?php esc_html_e( 'Tối Ưu Tải Trọng', 'bitco-theme' ); ?></span>
							<span id="metricSavingVal">45%</span>
						</div>
						<div class="metric-bar-bg">
							<div class="metric-bar-fill" id="metricSavingBar" style="width: 45%; background-color: var(--primary);"></div>
						</div>
					</div>
				</div>

				<!-- Technical Table -->
				<table class="tech-table">
					<thead>
						<tr>
							<th colspan="2"><?php esc_html_e( 'Thông Số Kỹ Thuật Đạt Chuẩn', 'bitco-theme' ); ?></th>
						</tr>
					</thead>
					<tbody id="techTableBody">
						<!-- Loaded dynamically by main.js -->
					</tbody>
				</table>

				<div class="tech-actions">
					<a href="#contact" class="btn btn-primary"><i class="fa-regular fa-envelope"></i> <?php esc_html_e( 'Yêu cầu báo giá & Mẫu thử', 'bitco-theme' ); ?></a>
					<a href="#contact" class="btn btn-outline"><i class="fa-solid fa-file-arrow-down"></i> <?php esc_html_e( 'Tải Catalog Kỹ Thuật', 'bitco-theme' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</section>
