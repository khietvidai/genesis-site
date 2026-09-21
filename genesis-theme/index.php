<?php
/**
 * Main Index Template Fallback
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// If accessed as front page or fallback, load landing template
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'wrap' ); ?> style="padding: 120px 20px 60px;">
			<h1 style="color:#fff;"><?php the_title(); ?></h1>
			<div class="entry-content" style="color:rgba(255,255,255,0.85);margin-top:20px;">
				<?php the_content(); ?>
			</div>
		</article>
		<?php
	}
} else {
	get_template_part( 'template-parts/hero' );
}

get_footer();
