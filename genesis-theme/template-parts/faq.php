<?php
/**
 * Template Part: FAQ Section & Schema JSON-LD
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$faqs = array(
	array(
		'q' => __( 'TT GENESIS nằm ở đâu?', 'genesis-theme' ),
		'a' => __( 'Mặt tiền đường 30m (song hành Lê Văn Lương), KDC Đào Sư Tích, phường Nhà Bè, TP.HCM (trước đây: Phước Kiển, Nhà Bè) – liền kề khu đô thị Phú Mỹ Hưng. Dự án có 4 mặt tiền đường và 3 mặt hướng sông.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Ai là chủ đầu tư và đơn vị phát triển dự án?', 'genesis-theme' ),
		'a' => __( 'Chủ đầu tư: Công ty Cổ phần Bất động sản Phúc Long – Phước Kiển. Đơn vị đầu tư & phát triển: liên doanh TT Capital (Việt Nam), Cosmos Initia, Hinokiya, Koterasu (Nhật Bản) và Vietmax Capital (Singapore).', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Giá bán từ bao nhiêu? Đã gồm những gì?', 'genesis-theme' ),
		'a' => __( 'Đơn giá chỉ từ 69 triệu/m² – tính theo phương thức thanh toán chuẩn, diện tích tim tường, chưa bao gồm VAT. Bảng giá chi tiết từng căn và chính sách áp dụng theo thông báo của chủ đầu tư tại từng thời điểm – để lại thông tin để nhận bảng giá mới nhất.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Pháp lý dự án và thời hạn sở hữu thế nào?', 'genesis-theme' ),
		'a' => __( 'Dự án đã có quyết định chủ trương đầu tư, quy hoạch 1/500, quyết định giao đất – chuyển mục đích sử dụng đất và văn bản miễn giấy phép xây dựng. Sở hữu lâu dài đối với tổ chức, cá nhân trong nước và người gốc Việt; 50 năm đối với cá nhân nước ngoài. Tất cả sản phẩm được đăng ký thường trú, tạm trú.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Ngân hàng nào bảo lãnh và hỗ trợ vay?', 'genesis-theme' ),
		'a' => __( 'Ngân hàng bảo lãnh dự án: VPBank. Ngân hàng tài trợ khách hàng mua nhà: VPBank, VietinBank, Vietcombank, ACB, MBBank.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Khi nào ký hợp đồng mua bán và nhận nhà?', 'genesis-theme' ),
		'a' => __( 'Dự kiến ký Hợp đồng mua bán vào Quý 3/2027 và bàn giao vào Quý 3/2029. Trước đó khách hàng ký Văn bản thoả thuận với Công ty CP TT Genesis – đơn vị tư vấn, tiếp thị độc quyền dự án.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Căn hộ bàn giao như thế nào?', 'genesis-theme' ),
		'a' => __( 'Căn hộ điển hình bàn giao hoàn thiện cơ bản với thiết bị thương hiệu Nhật Bản, Châu Âu, Mỹ; có sẵn bếp từ, khoá điện tử 5 chức năng (thẻ, mật mã, vân tay…), Face ID tại sảnh và Intercom App. Căn hộ khối đế và Penthouse bàn giao thô. 100% căn hộ có ban công/logia và sân phơi.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Phí quản lý dự kiến bao nhiêu?', 'genesis-theme' ),
		'a' => __( 'Dự kiến 16.000 đ/m²/tháng (đã gồm VAT) cho năm đầu tiên khi bàn giao. Đơn vị tư vấn quản lý vận hành: CBRE. Kinh phí bảo trì 2% theo quy định.', 'genesis-theme' ),
	),
	array(
		'q' => __( 'Người nước ngoài có được mua không?', 'genesis-theme' ),
		'a' => __( 'Hiện chủ đầu tư đang làm thủ tục xin phép bán cho người nước ngoài. Nếu được chấp thuận, cá nhân/tổ chức nước ngoài được sở hữu không quá 30% số căn hộ trong một toà.', 'genesis-theme' ),
	),
);

$faq_schema = array(
	'@context'   => 'https://schema.org',
	'@type'      => 'FAQPage',
	'mainEntity' => array_map(
		function ( $f ) {
			return array(
				'@type'          => 'Question',
				'name'           => $f['q'],
				'acceptedAnswer' => array(
					'@type' => 'Answer',
					'text'  => $f['a'],
				),
			);
		},
		$faqs
	),
);
?>

<section class="sec sec--cream" id="faq">
	<div class="wrap wrap--narrow">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Hỏi đáp', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Câu hỏi', 'genesis-theme' ); ?> <em><?php esc_html_e( 'thường gặp', 'genesis-theme' ); ?></em></h2>
		</header>
		<div class="faq">
			<?php foreach ( $faqs as $i => $f ) : ?>
				<details <?php echo ( 0 === $i ) ? 'open' : ''; ?>>
					<summary><?php echo esc_html( $f['q'] ); ?></summary>
					<p><?php echo esc_html( $f['a'] ); ?></p>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<script type="application/ld+json">
<?php echo wp_json_encode( $faq_schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT ); ?>
</script>
