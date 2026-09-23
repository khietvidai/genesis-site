<?php
/**
 * TT GENESIS Customizer Settings
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Theme Customizer settings, sections, and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function genesis_customize_register( $wp_customize ) {

	// Main Panel
	$wp_customize->add_panel(
		'genesis_landing_panel',
		array(
			'title'       => __( 'Cài đặt TT GENESIS Landing Page', 'genesis-theme' ),
			'description' => __( 'Tùy biến thông tin liên hệ, webhook nhận lead, và mã tracking quảng cáo.', 'genesis-theme' ),
			'priority'    => 20,
		)
	);

	// 1. Contact & Sales Section
	$wp_customize->add_section(
		'genesis_contact_section',
		array(
			'title'    => __( 'Thông tin Bán hàng & Chuyên viên', 'genesis-theme' ),
			'panel'    => 'genesis_landing_panel',
			'priority' => 10,
		)
	);

	$contact_fields = array(
		'genesis_advisor_name'  => array(
			'label'   => __( 'Tên chuyên viên tư vấn', 'genesis-theme' ),
			'default' => 'PkD TT Genesis',
			'type'    => 'text',
		),
		'genesis_phone'         => array(
			'label'   => __( 'Số Hotline (chỉ số, dùng cho tel:)', 'genesis-theme' ),
			'default' => '0938912908',
			'type'    => 'text',
		),
		'genesis_phone_display' => array(
			'label'   => __( 'Số Hotline hiển thị trên web', 'genesis-theme' ),
			'default' => '0938.912.908',
			'type'    => 'text',
		),
		'genesis_zalo'          => array(
			'label'   => __( 'Số Zalo tư vấn', 'genesis-theme' ),
			'default' => '0938912908',
			'type'    => 'text',
		),
		'genesis_email'         => array(
			'label'   => __( 'Email nhận liên hệ', 'genesis-theme' ),
			'default' => 'office@lunaholdingsvn.com',
			'type'    => 'email',
		),
		'genesis_company_name'  => array(
			'label'   => __( 'Tên công ty đầy đủ', 'genesis-theme' ),
			'default' => 'CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS',
			'type'    => 'text',
		),
		'genesis_company_short' => array(
			'label'   => __( 'Tên công ty viết tắt', 'genesis-theme' ),
			'default' => 'Luna Holdings',
			'type'    => 'text',
		),
		'genesis_tax_code'      => array(
			'label'   => __( 'Mã số thuế', 'genesis-theme' ),
			'default' => '0318925374',
			'type'    => 'text',
		),
		'genesis_address'       => array(
			'label'   => __( 'Địa chỉ doanh nghiệp', 'genesis-theme' ),
			'default' => '427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam',
			'type'    => 'textarea',
		),
	);

	foreach ( $contact_fields as $key => $args ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => ( 'textarea' === $args['type'] ) ? 'sanitize_textarea_field' : ( ( 'email' === $args['type'] ) ? 'sanitize_email' : 'sanitize_text_field' ),
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => $args['label'],
				'section' => 'genesis_contact_section',
				'type'    => $args['type'],
			)
		);
	}

	// 2. Google Sheets Webhook Section
	$wp_customize->add_section(
		'genesis_webhook_section',
		array(
			'title'       => __( 'Đồng bộ Google Sheets Webhook', 'genesis-theme' ),
			'description' => __( 'Nhập URL Google Apps Script Web App để tự động gửi thông tin lead sang Google Sheets.', 'genesis-theme' ),
			'panel'       => 'genesis_landing_panel',
			'priority'    => 20,
		)
	);

	$wp_customize->add_setting(
		'genesis_webhook_url',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		'genesis_webhook_url',
		array(
			'label'       => __( 'URL Webhook Google Sheets', 'genesis-theme' ),
			'description' => __( 'Nếu để trống, khi khách gửi form hệ thống sẽ lưu vào WP Admin và mở chat Zalo trực tiếp.', 'genesis-theme' ),
			'section'     => 'genesis_webhook_section',
			'type'        => 'url',
		)
	);

	// 3. Tracking Section
	$wp_customize->add_section(
		'genesis_tracking_section',
		array(
			'title'       => __( 'Mã Tracking & Pixels Quảng Cáo', 'genesis-theme' ),
			'description' => __( 'Nhập các ID theo dõi quảng cáo (để trống nếu chưa sử dụng).', 'genesis-theme' ),
			'panel'       => 'genesis_landing_panel',
			'priority'    => 30,
		)
	);

	$tracking_fields = array(
		'genesis_gtm_id'         => array(
			'label'       => __( 'Google Tag Manager ID', 'genesis-theme' ),
			'description' => __( 'Ví dụ: GTM-XXXXXXX', 'genesis-theme' ),
		),
		'genesis_gtag_id'        => array(
			'label'       => __( 'Google Analytics 4 / Google Ads ID', 'genesis-theme' ),
			'description' => __( 'Ví dụ: G-XXXXXXXXXX hoặc AW-XXXXXXXXX', 'genesis-theme' ),
		),
		'genesis_meta_pixel_id'  => array(
			'label'       => __( 'Meta (Facebook) Pixel ID', 'genesis-theme' ),
			'description' => __( 'Dãy số ID của Pixel, ví dụ: 123456789012345', 'genesis-theme' ),
		),
		'genesis_tiktok_pixel_id' => array(
			'label'       => __( 'TikTok Pixel ID', 'genesis-theme' ),
			'description' => __( 'Ví dụ: CXXXXXXXXXXXXXXXXX', 'genesis-theme' ),
		),
	);

	foreach ( $tracking_fields as $key => $args ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'       => $args['label'],
				'description' => $args['description'],
				'section'     => 'genesis_tracking_section',
				'type'        => 'text',
			)
		);
	}

	// 4. Campaign Settings
	$wp_customize->add_section(
		'genesis_campaign_section',
		array(
			'title'       => __( 'Cấu hình Chiến dịch Ưu đãi', 'genesis-theme' ),
			'panel'       => 'genesis_landing_panel',
			'priority'    => 40,
		)
	);

	$wp_customize->add_setting(
		'genesis_countdown_deadline',
		array(
			'default'           => '2026-10-06T23:59:59+07:00',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'genesis_countdown_deadline',
		array(
			'label'       => __( 'Hạn chót đếm ngược ưu đãi (ISO 8601)', 'genesis-theme' ),
			'description' => __( 'Định dạng: YYYY-MM-DDTHH:MM:SS+07:00 (mặc định: 2026-10-06T23:59:59+07:00)', 'genesis-theme' ),
			'section'     => 'genesis_campaign_section',
			'type'        => 'text',
		)
	);

	// 5. Hero Price & Copy Section
	$wp_customize->add_section(
		'genesis_hero_section',
		array(
			'title'       => __( 'Tiêu Đề & Giá Bán Hero', 'genesis-theme' ),
			'panel'       => 'genesis_landing_panel',
			'priority'    => 50,
		)
	);

	$hero_fields = array(
		'genesis_hero_eyebrow' => array( 'label' => __( 'Giới thiệu nhỏ (Eyebrow)', 'genesis-theme' ), 'default' => 'Liên doanh Việt Nam · Nhật Bản · Singapore' ),
		'genesis_hero_price_k' => array( 'label' => __( 'Nhãn giá', 'genesis-theme' ), 'default' => 'Giá chỉ từ' ),
		'genesis_hero_price_v' => array( 'label' => __( 'Số giá', 'genesis-theme' ), 'default' => '69' ),
		'genesis_hero_price_u' => array( 'label' => __( 'Đơn vị giá', 'genesis-theme' ), 'default' => 'triệu/m²' ),
		'genesis_hero_pay_k'   => array( 'label' => __( 'Nhãn thanh toán', 'genesis-theme' ), 'default' => 'Thanh toán cố định · không vay' ),
		'genesis_hero_pay_v'   => array( 'label' => __( 'Số thanh toán', 'genesis-theme' ), 'default' => '29' ),
		'genesis_hero_pay_u'   => array( 'label' => __( 'Đơn vị thanh toán', 'genesis-theme' ), 'default' => 'triệu/tháng' ),
	);

	foreach ( $hero_fields as $key => $args ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => $args['label'],
				'section' => 'genesis_hero_section',
				'type'    => 'text',
			)
		);
	}
}
add_action( 'customize_register', 'genesis_customize_register' );
