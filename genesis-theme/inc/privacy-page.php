<?php
/**
 * Tự tạo trang "Chính sách bảo mật thông tin" khi kích hoạt theme
 * (Google Ads yêu cầu công khai việc thu thập & chia sẻ dữ liệu khách hàng).
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Nội dung mặc định của trang chính sách bảo mật.
 *
 * @return string
 */
function genesis_privacy_policy_content() {
	$company = genesis_get_option( 'genesis_company_name', 'CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS' );
	$short   = genesis_get_option( 'genesis_company_short', 'Luna Holdings' );
	$tax     = genesis_get_option( 'genesis_tax_code', '0318925374' );
	$addr    = genesis_get_option( 'genesis_address', '427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam' );
	$email   = genesis_get_option( 'genesis_email', 'office@lunaholdingsvn.com' );
	$phone   = genesis_get_option( 'genesis_phone_display', '0938.912.908' );

	$h = function ( $t ) {
		return '<h2>' . esc_html( $t ) . '</h2>';
	};
	$p = function ( $t ) {
		return '<p>' . $t . '</p>';
	};

	return implode(
		"\n",
		array(
			$p( 'Cập nhật lần cuối: ' . esc_html( wp_date( 'd/m/Y' ) ) ),
			$h( '1. Đơn vị chịu trách nhiệm' ),
			$p( 'Trang thông tin về dự án TT GENESIS này do <strong>' . esc_html( $company ) . '</strong> (MST ' . esc_html( $tax ) . ', địa chỉ ' . esc_html( $addr ) . ') vận hành với vai trò đơn vị tư vấn, phân phối. Chúng tôi không phải chủ đầu tư dự án.' ),
			$h( '2. Thông tin chúng tôi thu thập' ),
			'<ul><li>Thông tin bạn tự điền vào form: họ tên, số điện thoại, cách liên hệ bạn chọn và loại căn hộ quan tâm.</li><li>Thông tin kỹ thuật đi kèm khi gửi form: thời điểm gửi, địa chỉ IP, trang bạn đang xem và nguồn truy cập (tham số chiến dịch quảng cáo utm, mã nhấp gclid, fbclid, ttclid).</li><li>Nếu trang có gắn công cụ đo lường của Google, Meta hoặc TikTok, các công cụ này có thể dùng cookie hoặc công nghệ tương tự để ghi nhận lượt xem trang và lượt gửi form.</li></ul>',
			$p( 'Chúng tôi không thu thập số CMND/CCCD, thông tin tài khoản ngân hàng hay mật khẩu qua trang này.' ),
			$h( '3. Mục đích sử dụng' ),
			'<ul><li>Liên hệ để gửi bảng giá, mặt bằng, chính sách bán hàng và tư vấn về dự án TT GENESIS theo đúng cách liên hệ bạn đã chọn.</li><li>Đo lường hiệu quả quảng cáo và cải thiện nội dung trang.</li></ul>',
			$p( 'Chúng tôi chỉ xử lý thông tin khi có sự đồng ý của bạn, thể hiện qua việc bạn chủ động gửi form.' ),
			$h( '4. Chia sẻ thông tin' ),
			'<ul><li>Chúng tôi <strong>không bán</strong> và không chia sẻ số điện thoại của bạn cho môi giới, sàn giao dịch hay bên thứ ba khác để tiếp thị.</li><li>Dữ liệu đo lường có thể được chia sẻ với nền tảng quảng cáo (Google, Meta, TikTok) để đo lường hiệu quả chiến dịch thay mặt chúng tôi.</li><li>Chúng tôi có thể cung cấp thông tin khi cơ quan nhà nước có thẩm quyền yêu cầu theo quy định pháp luật.</li></ul>',
			$h( '5. Thời gian lưu trữ' ),
			$p( 'Thông tin được lưu trong thời gian cần thiết để tư vấn về dự án, tối đa 24 tháng kể từ lần liên hệ cuối, hoặc cho đến khi bạn yêu cầu xoá.' ),
			$h( '6. Quyền của bạn' ),
			$p( 'Bạn có quyền yêu cầu xem, chỉnh sửa, xoá thông tin; rút lại sự đồng ý; hoặc yêu cầu ngừng liên hệ bất cứ lúc nào. Chúng tôi sẽ xử lý yêu cầu trong vòng 72 giờ làm việc.' ),
			$h( '7. Bảo mật' ),
			$p( 'Trang sử dụng kết nối mã hoá HTTPS. Quyền truy cập dữ liệu khách hàng chỉ giới hạn cho nhân sự phụ trách tư vấn của ' . esc_html( $short ) . '.' ),
			$h( '8. Liên hệ' ),
			$p( 'Email: ' . esc_html( $email ) . '<br />Điện thoại: ' . esc_html( $phone ) . '<br />Địa chỉ: ' . esc_html( $addr ) ),
		)
	);
}

/**
 * Tạo trang và đặt làm trang chính sách bảo mật nếu site chưa có trang đã xuất bản.
 */
function genesis_ensure_privacy_page() {
	$current = (int) get_option( 'wp_page_for_privacy_policy' );
	if ( $current && 'publish' === get_post_status( $current ) ) {
		return;
	}
	$page_id = wp_insert_post(
		array(
			'post_title'   => 'Chính sách bảo mật thông tin',
			'post_name'    => 'chinh-sach-bao-mat',
			'post_content' => genesis_privacy_policy_content(),
			'post_status'  => 'publish',
			'post_type'    => 'page',
		)
	);
	if ( $page_id && ! is_wp_error( $page_id ) ) {
		update_option( 'wp_page_for_privacy_policy', (int) $page_id );
	}
}
add_action( 'after_switch_theme', 'genesis_ensure_privacy_page' );
