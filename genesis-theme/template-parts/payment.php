<?php
/**
 * Template Part: Payment Schedules Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$payments = array(
	array(
		'id'    => 'de-so-huu-2',
		'tab'   => __( 'Dễ sở hữu 2 · 29tr/tháng', 'genesis-theme' ),
		'hl'    => __( '29 triệu/tháng', 'genesis-theme' ),
		'sub'   => __( 'Cố định trong 23 tháng – không cần vay ngân hàng', 'genesis-theme' ),
		'steps' => array(
			array( '10%', __( 'Ký Văn bản thoả thuận', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng tiếp theo', 'genesis-theme' ) ),
			array( '10%', __( 'Ký HĐMB · dự kiến Q3/2027', 'genesis-theme' ) ),
			array( '29 triệu/tháng', __( 'Trong 23 tháng tiếp theo', 'genesis-theme' ) ),
			array( 'Đủ 95%', __( 'Khi bàn giao · dự kiến Q3/2029', 'genesis-theme' ) ),
			array( '5%', __( 'Khi nhận Giấy chứng nhận', 'genesis-theme' ) ),
		),
	),
	array(
		'id'    => 'de-so-huu',
		'tab'   => __( 'Dễ sở hữu · 39tr/tháng', 'genesis-theme' ),
		'hl'    => __( '39 triệu/tháng', 'genesis-theme' ),
		'sub'   => __( 'Cố định trong 23 tháng – giảm áp lực khi nhận nhà', 'genesis-theme' ),
		'steps' => array(
			array( '10%', __( 'Ký Văn bản thoả thuận', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng tiếp theo', 'genesis-theme' ) ),
			array( '10%', __( 'Ký HĐMB · dự kiến Q3/2027', 'genesis-theme' ) ),
			array( '39 triệu/tháng', __( 'Trong 23 tháng tiếp theo', 'genesis-theme' ) ),
			array( 'Đủ 95%', __( 'Khi bàn giao · dự kiến Q3/2029', 'genesis-theme' ) ),
			array( '5%', __( 'Khi nhận Giấy chứng nhận', 'genesis-theme' ) ),
		),
	),
	array(
		'id'    => 'chuan',
		'tab'   => __( 'Chuẩn', 'genesis-theme' ),
		'hl'    => __( 'Giãn đều đến 2029', 'genesis-theme' ),
		'sub'   => __( '40% chia nhỏ trong 20 tháng sau HĐMB – áp dụng đơn giá từ 69 triệu/m²', 'genesis-theme' ),
		'steps' => array(
			array( '10%', __( 'Ký Văn bản thoả thuận', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng tiếp theo', 'genesis-theme' ) ),
			array( '10%', __( 'Ký HĐMB · dự kiến Q3/2027', 'genesis-theme' ) ),
			array( '40%', __( 'Chia 20 tháng: (1% + 1% + 1% + 1% + 6%) × 4 lần', 'genesis-theme' ) ),
			array( '25%', __( 'Khi bàn giao · dự kiến Q3/2029', 'genesis-theme' ) ),
			array( '5%', __( 'Khi nhận Giấy chứng nhận', 'genesis-theme' ) ),
		),
	),
	array(
		'id'    => 'vay',
		'tab'   => __( 'Vay 40%', 'genesis-theme' ),
		'hl'    => __( 'HTLS đến 100%', 'genesis-theme' ),
		'sub'   => __( 'Ân hạn gốc 24 tháng · hỗ trợ lãi suất đến thông báo nhận nhà (*)', 'genesis-theme' ),
		'steps' => array(
			array( '10%', __( 'Ký Văn bản thoả thuận', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng', 'genesis-theme' ) ),
			array( '5%', __( 'Sau 3 tháng tiếp theo', 'genesis-theme' ) ),
			array( '10%', __( 'Ký HĐMB · dự kiến Q3/2027', 'genesis-theme' ) ),
			array( '40%', __( 'Ngân hàng giải ngân trong 30 ngày', 'genesis-theme' ) ),
			array( '25%', __( 'Khi bàn giao · dự kiến Q3/2029', 'genesis-theme' ) ),
			array( '5%', __( 'Khi nhận Giấy chứng nhận', 'genesis-theme' ) ),
		),
	),
	array(
		'id'    => 'nhanh',
		'tab'   => __( 'Thanh toán nhanh', 'genesis-theme' ),
		'hl'    => __( 'Chiết khấu 3% – 8%', 'genesis-theme' ),
		'sub'   => __( 'Dành cho khách hàng có sẵn dòng tiền', 'genesis-theme' ),
		'steps' => array(
			array( 'Nhanh 30 · CK 3%', __( '30% khi ký VBTT, 8 đợt × 5%, 25% bàn giao, 5% nhận GCN', 'genesis-theme' ) ),
			array( 'Nhanh 50 · CK 5%', __( '50% khi ký VBTT, 4 đợt × 5%, 25% bàn giao, 5% nhận GCN', 'genesis-theme' ) ),
			array( 'Nhanh 70 · CK 8%', __( '70% khi ký VBTT, 25% bàn giao, 5% nhận GCN', 'genesis-theme' ) ),
		),
	),
);
?>

<section class="sec sec--dark" id="thanh-toan">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Phương thức thanh toán', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Chọn lộ trình', 'genesis-theme' ); ?> <em><?php esc_html_e( 'vừa với dòng tiền', 'genesis-theme' ); ?></em> <?php esc_html_e( 'của bạn', 'genesis-theme' ); ?></h2>
		</header>
		<div class="tabs" data-tabs>
			<div class="tabs__bar" role="tablist" aria-label="<?php esc_attr_e( 'Phương thức thanh toán', 'genesis-theme' ); ?>">
				<?php foreach ( $payments as $i => $p ) : ?>
					<button role="tab" type="button" id="tab-<?php echo esc_attr( $p['id'] ); ?>" aria-controls="pn-<?php echo esc_attr( $p['id'] ); ?>" aria-selected="<?php echo ( 0 === $i ) ? 'true' : 'false'; ?>" tabindex="<?php echo ( 0 === $i ) ? '0' : '-1'; ?>"><?php echo esc_html( $p['tab'] ); ?></button>
				<?php endforeach; ?>
			</div>
			<?php foreach ( $payments as $i => $p ) : ?>
				<div class="pay" role="tabpanel" id="pn-<?php echo esc_attr( $p['id'] ); ?>" aria-labelledby="tab-<?php echo esc_attr( $p['id'] ); ?>" <?php echo ( 0 !== $i ) ? 'hidden' : ''; ?>>
					<div class="pay__hl">
						<strong><?php echo esc_html( $p['hl'] ); ?></strong>
						<span><?php echo esc_html( $p['sub'] ); ?></span>
					</div>
					<ol class="pay__steps">
						<?php foreach ( $p['steps'] as $step ) : ?>
							<li><b><?php echo esc_html( $step[0] ); ?></b><span><?php echo esc_html( $step[1] ); ?></span></li>
						<?php endforeach; ?>
					</ol>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="banks">
			<span><?php esc_html_e( 'Ngân hàng đồng hành:', 'genesis-theme' ); ?></span>
			<b>VPBank</b><b>VietinBank</b><b>Vietcombank</b><b>ACB</b><b>MBBank</b>
		</div>
		<p class="fine"><?php esc_html_e( '(*) Lịch thanh toán tóm tắt theo tài liệu chính sách Đợt 1; chi tiết theo thông báo chính sách do chủ đầu tư ban hành.', 'genesis-theme' ); ?></p>
		<div class="center">
			<a href="#dang-ky" class="btn btn--gold btn--lg" data-track="cta_payment"><?php esc_html_e( 'Nhận bảng tính dòng tiền theo căn', 'genesis-theme' ); ?></a>
		</div>
	</div>
</section>
