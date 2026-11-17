<?php
/**
 * Component: Interactive Builder SVG Character
 *
 * @package BITCO_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$builder_index = isset( $args['index'] ) ? (int) $args['index'] : 0;
$has_brick     = ! empty( $args['has_brick'] );
$extra_class   = isset( $args['brick_class'] ) ? ' ' . esc_attr( $args['brick_class'] ) : '';

$container_classes = 'section-builder-container';
if ( $has_brick ) {
	$container_classes .= ' has-brick';
}

$brick_classes = 'mini-brick-3d landed-brick' . $extra_class;
if ( 0 === $builder_index ) {
	$brick_classes .= ' visible';
}
?>
<div class="<?php echo esc_attr( $container_classes ); ?>" data-builder-index="<?php echo esc_attr( $builder_index ); ?>">
	<div class="builder-svg-container pose-idle">
		<svg class="builder-svg" viewBox="0 0 100 120" width="60" height="72" aria-hidden="true">
			<!-- Body/Trousers -->
			<path d="M 34,95 L 66,95 L 66,115 L 34,115 Z" fill="#1d4ed8" />
			<!-- Boots -->
			<path d="M 32,115 L 46,115 L 44,120 L 30,120 Z" fill="#0f172a" />
			<path d="M 54,115 L 68,115 L 70,120 L 56,120 Z" fill="#0f172a" />
			<!-- Grey Shirt Base -->
			<path d="M 32,55 L 68,55 L 68,95 L 32,95 Z" fill="#cbd5e1" />
			<!-- Blue Vest Overlay -->
			<path d="M 32,55 L 68,55 L 65,92 L 35,92 Z" fill="#2563eb" />
			<!-- Reflective Stripes (white/silver) -->
			<path d="M 40,55 L 40,92 M 60,55 L 60,92" stroke="#f1f5f9" stroke-width="3" />
			<path d="M 35,72 L 65,72" stroke="#f1f5f9" stroke-width="3" />
			<!-- Neck -->
			<rect x="46" y="44" width="8" height="12" fill="#fed7aa" />
			<!-- Beard background -->
			<path d="M 37,34 C 37,45 63,45 63,34 Z" fill="#1e293b" />
			<!-- Face -->
			<circle cx="50" cy="34" r="11" fill="#fed7aa" />
			<!-- Smile -->
			<path d="M 46,37 Q 50,40 54,37" stroke="#1e293b" stroke-width="1.5" fill="none" stroke-linecap="round" />
			<!-- Helmet Dome -->
			<path d="M 33,26 C 33,11 67,11 67,26 Z" fill="#1d4ed8" />
			<!-- Helmet Brim -->
			<rect x="28" y="24" width="44" height="4" fill="#2563eb" rx="1.5" />
			<!-- Arm groups -->
			<path d="M 32,58 L 24,70" stroke="#cbd5e1" stroke-width="8" stroke-linecap="round" />
			<g class="arm-group arm-left-group" style="transform-origin: 32px 58px;">
				<path d="M 32,58 L 18,80" fill="none" stroke="#fed7aa" stroke-width="7" stroke-linecap="round" />
				<circle cx="18" cy="80" r="5.5" fill="#fed7aa" />
			</g>
			<path d="M 68,58 L 76,70" stroke="#cbd5e1" stroke-width="8" stroke-linecap="round" />
			<g class="arm-group arm-right-group" style="transform-origin: 68px 58px;">
				<path d="M 68,58 L 82,80" fill="none" stroke="#fed7aa" stroke-width="7" stroke-linecap="round" />
				<circle cx="82" cy="80" r="5.5" fill="#fed7aa" />
			</g>
		</svg>
		<div class="<?php echo esc_attr( $brick_classes ); ?>">
			<span class="face front"></span>
			<span class="face back"></span>
			<span class="face left"></span>
			<span class="face right"></span>
			<span class="face top"></span>
			<span class="face bottom"></span>
		</div>
	</div>
</div>
