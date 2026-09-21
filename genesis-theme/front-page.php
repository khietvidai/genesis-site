<?php
/**
 * Template: Front Page (Landing Page TT GENESIS)
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

get_template_part( 'template-parts/hero' );
get_template_part( 'template-parts/stats' );
get_template_part( 'template-parts/offers' );
get_template_part( 'template-parts/strengths' );
get_template_part( 'template-parts/location' );
get_template_part( 'template-parts/amenities' );
get_template_part( 'template-parts/apartments' );
get_template_part( 'template-parts/handover' );
get_template_part( 'template-parts/payment' );
get_template_part( 'template-parts/partners' );
get_template_part( 'template-parts/legal-timeline' );
get_template_part( 'template-parts/faq' );
get_template_part( 'template-parts/final-cta' );

get_footer();
