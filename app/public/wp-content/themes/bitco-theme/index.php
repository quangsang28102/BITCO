<?php
/**
 * The main template file
 *
 * @package BITCO_Theme
 */

get_header();
?>

<main id="primary" class="site-main" style="padding: 120px 0 60px;">
	<div class="container">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title section-title">', '</h1>' ); ?>
					</header>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>
				</article>
				<?php
			endwhile;
		else :
			?>
			<p><?php esc_html_e( 'Không tìm thấy nội dung phù hợp.', 'bitco-theme' ); ?></p>
			<?php
		endif;
		?>
	</div>
</main>

<?php
get_footer();
