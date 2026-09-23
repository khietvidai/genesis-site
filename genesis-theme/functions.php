<?php
/**
 * TT GENESIS Theme Functions & Definitions
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'GENESIS_VERSION', '1.0.0' );

/**
 * Helper to retrieve Customizer theme options with fallback default values.
 *
 * @param string $key Option key.
 * @param mixed  $default Default value.
 * @return mixed
 */
function genesis_get_option( $key, $default = '' ) {
	$defaults = array(
		'genesis_advisor_name'       => 'PkD TT Genesis',
		'genesis_phone'              => '0938912908',
		'genesis_phone_display'      => '0938.912.908',
		'genesis_zalo'               => '0938912908',
		'genesis_email'              => 'office@lunaholdingsvn.com',
		'genesis_company_name'       => 'CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS',
		'genesis_company_short'      => 'Luna Holdings',
		'genesis_tax_code'           => '0318925374',
		'genesis_address'            => '427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam',
		'genesis_webhook_url'        => '',
		'genesis_gtm_id'             => '',
		'genesis_gtag_id'            => '',
		'genesis_meta_pixel_id'      => '',
		'genesis_tiktok_pixel_id'    => '',
		'genesis_countdown_deadline' => '2026-10-06T23:59:59+07:00',
		'genesis_hero_eyebrow'       => 'Liên doanh Việt Nam · Nhật Bản · Singapore',
		'genesis_hero_title'         => 'Căn hộ Tri thức Nhật Bản',
		'genesis_hero_sub'           => 'tại Nam Sài Gòn – liền kề Phú Mỹ Hưng',
		'genesis_hero_price_k'       => 'Giá chỉ từ',
		'genesis_hero_price_v'       => '69',
		'genesis_hero_price_u'       => 'triệu/m²',
		'genesis_hero_pay_k'         => 'Thanh toán cố định · không vay',
		'genesis_hero_pay_v'         => '29',
		'genesis_hero_pay_u'         => 'triệu/tháng',
	);

	if ( empty( $default ) && isset( $defaults[ $key ] ) ) {
		$default = $defaults[ $key ];
	}

	return get_theme_mod( $key, $default );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function genesis_setup() {
	load_theme_textdomain( 'genesis-theme', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'genesis_setup' );

/**
 * Enqueue scripts and styles.
 */
function genesis_scripts() {
	// Google Fonts
	wp_enqueue_style(
		'genesis-fonts',
		'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,500&display=swap',
		array(),
		null
	);

	// Theme Stylesheet
	wp_enqueue_style(
		'genesis-landing-style',
		get_template_directory_uri() . '/assets/css/landing.css',
		array(),
		GENESIS_VERSION
	);

	// Theme JavaScript
	wp_enqueue_script(
		'genesis-landing-script',
		get_template_directory_uri() . '/assets/js/landing.js',
		array(),
		GENESIS_VERSION,
		true
	);

	$zalo = genesis_get_option( 'genesis_zalo', '0938912908' );

	// Localize script data for AJAX and configuration
	wp_localize_script(
		'genesis-landing-script',
		'genesis_data',
		array(
			'ajax_url'    => admin_url( 'admin-ajax.php' ),
			'nonce'       => wp_create_nonce( 'genesis_lead_nonce' ),
			'webhook_url' => genesis_get_option( 'genesis_webhook_url', '' ),
			'zalo_href'   => 'https://zalo.me/' . preg_replace( '/\D/', '', $zalo ),
			'advisor'     => genesis_get_option( 'genesis_advisor_name', 'PkD TT Genesis' ),
			'deadline'    => genesis_get_option( 'genesis_countdown_deadline', '2026-10-06T23:59:59+07:00' ),
		)
	);
}
add_action( 'wp_enqueue_scripts', 'genesis_scripts' );

// Include Theme Modules
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/leads-cpt.php';
require_once get_template_directory() . '/inc/lead-handler.php';
