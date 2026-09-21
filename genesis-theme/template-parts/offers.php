<?php
/**
 * Template Part: Offers & Countdown Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$deadline = genesis_get_option( 'genesis_countdown_deadline', '2026-10-06T23:59:59+07:00' );

$offers = array(
	array(
		'big'   => '1%',
		'title' => __( 'Chiết khấu giữ chỗ sớm', 'genesis-theme' ),
		'text'  => __( 'Áp dụng cho khách hàng có giữ chỗ đến hết ngày 06/10/2026.', 'genesis-theme' ),
		'tag'   => __( 'Sắp hết hạn', 'genesis-theme' ),
	),
	array(
		'big'   => '29 triệu',
		'unit'  => '/tháng',
		'title' => __( 'Thanh toán cố định – không vay', 'genesis-theme' ),
		'text'  => __( 'Phương thức “Dễ sở hữu 2”: sau khi ký HĐMB chỉ đóng cố định 29 triệu/tháng trong 23 tháng.', 'genesis-theme' ),
	),
	array(
		'big'   => __( 'Đến 8%', 'genesis-theme' ),
		'title' => __( 'Chiết khấu thanh toán nhanh', 'genesis-theme' ),
		'text'  => __( 'Nhanh 30: CK 3% · Nhanh 50: CK 5% · Nhanh 70: CK 8%.', 'genesis-theme' ),
	),
	array(
		'big'   => '100%',
		'unit'  => ' HTLS',
		'title' => __( 'Vay 40% – hỗ trợ lãi suất đến 100%', 'genesis-theme' ),
		'text'  => __( 'Ân hạn gốc 24 tháng, hỗ trợ lãi suất đến khi có thông báo nhận nhà (*).', 'genesis-theme' ),
	),
	array(
		'big'   => __( '3 món', 'genesis-theme' ),
		'title' => __( 'Quà tặng gói thiết bị cao cấp', 'genesis-theme' ),
		'text'  => __( 'Máy lạnh Toshiba cho tất cả phòng ngủ, máy rửa chén Hafele (căn 2–3PN), máy lọc nước uống tại vòi Ecowater – cho giao dịch Đợt 1.', 'genesis-theme' ),
	),
	array(
		'big'   => '1 – 2%',
		'title' => __( 'Ưu đãi thân thiết & mua nhiều', 'genesis-theme' ),
		'text'  => __( 'CK 1% cho khách đã mua TT AVIO. Mua 2–3 căn CK 1%, 4–5 căn CK 1,5%, từ 6 căn CK 2%.', 'genesis-theme' ),
	),
);
?>

<section class="sec sec--dark" id="uu-dai">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Chính sách bán hàng Đợt 1', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Ưu đãi dành cho', 'genesis-theme' ); ?> <em><?php esc_html_e( 'khách hàng tiên phong', 'genesis-theme' ); ?></em></h2>
			<p class="lead"><?php esc_html_e( 'Giai đoạn mở bán đầu tiên luôn có mức giá và chính sách tốt nhất. Ưu đãi giữ chỗ sớm kết thúc sau:', 'genesis-theme' ); ?></p>
			<div class="countdown" data-deadline="<?php echo esc_attr( $deadline ); ?>" aria-live="off">
				<div><b data-cd="d">--</b><span><?php esc_html_e( 'ngày', 'genesis-theme' ); ?></span></div>
				<div><b data-cd="h">--</b><span><?php esc_html_e( 'giờ', 'genesis-theme' ); ?></span></div>
				<div><b data-cd="m">--</b><span><?php esc_html_e( 'phút', 'genesis-theme' ); ?></span></div>
				<div><b data-cd="s">--</b><span><?php esc_html_e( 'giây', 'genesis-theme' ); ?></span></div>
			</div>
		</header>
		<div class="offers">
			<?php foreach ( $offers as $o ) : ?>
				<article class="offer">
					<?php if ( ! empty( $o['tag'] ) ) : ?>
						<span class="offer__tag"><?php echo esc_html( $o['tag'] ); ?></span>
					<?php endif; ?>
					<div class="offer__big">
						<?php echo esc_html( $o['big'] ); ?>
						<?php if ( ! empty( $o['unit'] ) ) : ?>
							<small><?php echo esc_html( $o['unit'] ); ?></small>
						<?php endif; ?>
					</div>
					<h3><?php echo esc_html( $o['title'] ); ?></h3>
					<p><?php echo esc_html( $o['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<p class="fine"><?php esc_html_e( '(*) Chi tiết theo thông báo chính sách bán hàng do chủ đầu tư ban hành tại từng thời điểm. Các chính sách có thể không áp dụng đồng thời.', 'genesis-theme' ); ?></p>
		<div class="center">
			<a href="#dang-ky" class="btn btn--gold btn--lg" data-track="cta_offers"><?php esc_html_e( 'Giữ chỗ ưu tiên – nhận chiết khấu 1%', 'genesis-theme' ); ?></a>
		</div>
	</div>
</section>
