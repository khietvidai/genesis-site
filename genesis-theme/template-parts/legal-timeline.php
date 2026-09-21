<?php
/**
 * Template Part: Legal & Timeline Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$legal = array(
	array( '26/06/2025', __( 'Quyết định 3198 – UBND TP.HCM chấp thuận chủ trương đầu tư, chấp thuận nhà đầu tư', 'genesis-theme' ) ),
	array( '18/12/2025', __( 'Văn bản 1918 – chấp thuận quy hoạch tổng mặt bằng tỷ lệ 1/500', 'genesis-theme' ) ),
	array( '01/06/2026', __( 'Văn bản 3250 – giao đất, chuyển mục đích sử dụng đất', 'genesis-theme' ) ),
	array( '12/06/2026', __( 'Văn bản 20731 – Sở Xây dựng thông báo kết quả thẩm định Báo cáo NCKT đầu tư xây dựng', 'genesis-theme' ) ),
	array( '09/07/2026', __( 'Văn bản 24718 – Sở Xây dựng về việc miễn giấy phép xây dựng', 'genesis-theme' ) ),
);

$timeline = array(
	array( '07/2026', __( 'Lễ khởi công', 'genesis-theme' ) ),
	array( '09/2026', __( 'Kick-off & khai trương WOW Center', 'genesis-theme' ) ),
	array( '10/2026', __( 'Khai trương nhà mẫu · công bố Đợt 1 (dự kiến 24/10)', 'genesis-theme' ) ),
	array( 'Q3/2027', __( 'Dự kiến ký Hợp đồng mua bán', 'genesis-theme' ) ),
	array( 'Q3/2029', __( 'Dự kiến bàn giao', 'genesis-theme' ) ),
);
?>

<section class="sec sec--dark" id="phap-ly">
	<div class="wrap split split--top">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Pháp lý minh bạch', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Hồ sơ', 'genesis-theme' ); ?> <em><?php esc_html_e( 'đầy đủ', 'genesis-theme' ); ?></em></h2>
			<ul class="legal">
				<?php foreach ( $legal as $l ) : ?>
					<li><time><?php echo esc_html( $l[0] ); ?></time><span><?php echo esc_html( $l[1] ); ?></span></li>
				<?php endforeach; ?>
			</ul>
			<p class="loc__note"><?php esc_html_e( 'Chủ đầu tư: Công ty CP Bất động sản Phúc Long – Phước Kiển · Ngân hàng bảo lãnh: VPBank.', 'genesis-theme' ); ?></p>
		</div>
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Tiến độ', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Lộ trình', 'genesis-theme' ); ?> <em><?php esc_html_e( 'dự kiến', 'genesis-theme' ); ?></em></h2>
			<ol class="tl">
				<?php foreach ( $timeline as $t ) : ?>
					<li><b><?php echo esc_html( $t[0] ); ?></b><span><?php echo esc_html( $t[1] ); ?></span></li>
				<?php endforeach; ?>
			</ol>
		</div>
	</div>
</section>
