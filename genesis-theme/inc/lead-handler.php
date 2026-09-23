<?php
/**
 * TT GENESIS AJAX Form Lead Submission Handler
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Handle AJAX Lead Form Submission.
 */
function genesis_ajax_submit_lead() {
	// Verify Nonce
	$nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'genesis_lead_nonce' ) ) {
		wp_send_json_error(
			array( 'message' => __( 'Phiên làm việc đã hết hạn. Vui lòng tải lại trang và thử lại.', 'genesis-theme' ) ),
			403
		);
	}

	// Honeypot spam check - silent pass for bots
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success(
			array( 'message' => __( 'Đăng ký thành công!', 'genesis-theme' ) )
		);
	}

	// Sanitize & validate name
	$name = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	if ( mb_strlen( $name, 'UTF-8' ) < 2 ) {
		wp_send_json_error(
			array( 'message' => __( 'Vui lòng nhập họ tên của bạn (tối thiểu 2 ký tự).', 'genesis-theme' ) ),
			400
		);
	}

	// Sanitize & validate phone
	$raw_phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$phone     = preg_replace( '/[\s.\-()]/', '', $raw_phone );
	$phone     = preg_replace( '/^\+?84/', '0', $phone );

	if ( ! preg_match( '/^0(3|5|7|8|9)\d{8}$/', $phone ) ) {
		wp_send_json_error(
			array( 'message' => __( 'Số điện thoại chưa đúng định dạng. Vui lòng kiểm tra lại.', 'genesis-theme' ) ),
			400
		);
	}

	// Sanitize other fields
	$interest     = isset( $_POST['interest'] ) ? sanitize_text_field( wp_unslash( $_POST['interest'] ) ) : 'Chưa xác định';
	$contact_pref = isset( $_POST['contact_pref'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_pref'] ) ) : 'Zalo';
	$form_id      = isset( $_POST['form'] ) ? sanitize_text_field( wp_unslash( $_POST['form'] ) ) : 'default';
	$page         = isset( $_POST['page'] ) ? esc_url_raw( wp_unslash( $_POST['page'] ) ) : home_url();
	$time         = isset( $_POST['time'] ) ? sanitize_text_field( wp_unslash( $_POST['time'] ) ) : current_time( 'Y-m-d H:i:s' );

	// Client IP address
	$ip = '';
	if ( ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] ) ) {
		$ip = sanitize_text_field( wp_unslash( $_SERVER['HTTP_CF_CONNECTING_IP'] ) );
	} elseif ( ! empty( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) {
		$forwarded = explode( ',', sanitize_text_field( wp_unslash( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ) );
		$ip        = trim( $forwarded[0] );
	} elseif ( ! empty( $_SERVER['REMOTE_ADDR'] ) ) {
		$ip = sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) );
	}

	// UTM Tracking fields
	$utm_keys = array( 'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'fbclid', 'gclid', 'ttclid' );
	$utms     = array();
	foreach ( $utm_keys as $k ) {
		$utms[ $k ] = isset( $_POST[ $k ] ) ? sanitize_text_field( wp_unslash( $_POST[ $k ] ) ) : '';
	}

	// 1. Layer 1: Save Lead to WordPress Database (CPT genesis_lead)
	$post_id = wp_insert_post(
		array(
			'post_title'  => $name,
			'post_type'   => 'genesis_lead',
			'post_status' => 'publish',
		),
		true
	);

	if ( is_wp_error( $post_id ) ) {
		wp_send_json_error(
			array( 'message' => __( 'Lỗi hệ thống khi lưu thông tin. Vui lòng liên hệ hotline.', 'genesis-theme' ) ),
			500
		);
	}

	// Save meta fields
	update_post_meta( $post_id, '_lead_phone', $phone );
	update_post_meta( $post_id, '_lead_contact_pref', $contact_pref );
	update_post_meta( $post_id, '_lead_interest', $interest );
	update_post_meta( $post_id, '_lead_form_id', $form_id );
	update_post_meta( $post_id, '_lead_page', $page );
	update_post_meta( $post_id, '_lead_time', $time );
	update_post_meta( $post_id, '_lead_ip', $ip );

	foreach ( $utms as $k => $val ) {
		update_post_meta( $post_id, '_lead_' . $k, $val );
	}

	// 2. Layer 2: Forward to Google Sheets Webhook if configured
	$webhook_url = genesis_get_option( 'genesis_webhook_url', '' );
	if ( ! empty( $webhook_url ) && filter_var( $webhook_url, FILTER_VALIDATE_URL ) ) {
		$payload = array_merge(
			array(
				'name'         => $name,
				'phone'        => $phone,
				'interest'     => $interest,
				'contact_pref' => $contact_pref,
				'form'         => $form_id,
				'page'         => $page,
				'time'         => $time,
			),
			$utms
		);

		// Non-blocking asynchronous HTTP POST request to avoid delaying user response
		wp_remote_post(
			$webhook_url,
			array(
				'method'    => 'POST',
				'timeout'   => 5,
				'blocking'  => false,
				'body'      => $payload,
				'sslverify' => false,
			)
		);
	}

	// 3. Layer 3: Send Email Notification to recipient email if configured
	$notify_email = genesis_get_option( 'genesis_email', 'office@lunaholdingsvn.com' );
	if ( ! empty( $notify_email ) && is_email( $notify_email ) ) {
		$subject = sprintf( '[TT GENESIS] Khách hàng mới: %s - %s', $name, $phone );
		$body    = sprintf(
			"Thông báo có khách hàng mới đăng ký tư vấn TT GENESIS:\n\n" .
			"- Họ tên: %s\n" .
			"- Số điện thoại: %s\n" .
			"- Nhu cầu quan tâm: %s\n" .
			"- Kênh liên hệ: %s\n" .
			"- Form đăng ký: %s\n" .
			"- Thời gian: %s\n" .
			"- Trang: %s\n" .
			"- IP: %s\n\n" .
			"Xem chi tiết tại trang quản trị WordPress: %s\n",
			$name,
			$phone,
			$interest,
			$contact_pref,
			$form_id,
			$time,
			$page,
			$ip,
			admin_url( 'post.php?post=' . $post_id . '&action=edit' )
		);
		$headers = array( 'Content-Type: text/plain; charset=UTF-8' );
		@wp_mail( $notify_email, $subject, $body, $headers );
	}

	// 4. Layer 4: Return JSON Success
	wp_send_json_success(
		array(
			'message'      => sprintf(
				/* translators: %s: phone number */
				__( 'Đăng ký thành công! Chuyên viên sẽ liên hệ %s trong thời gian sớm nhất.', 'genesis-theme' ),
				esc_html( $phone )
			),
			'lead_id'      => $post_id,
			'phone'        => $phone,
			'interest'     => $interest,
			'webhook_sent' => ! empty( $webhook_url ),
		)
	);
}
add_action( 'wp_ajax_genesis_submit_lead', 'genesis_ajax_submit_lead' );
add_action( 'wp_ajax_nopriv_genesis_submit_lead', 'genesis_ajax_submit_lead' );
