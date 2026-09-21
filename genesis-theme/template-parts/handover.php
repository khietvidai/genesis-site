<?php
/**
 * Template Part: Handover Specifications Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
?>

<section class="sec sec--cream" id="ban-giao">
	<div class="wrap split">
		<div>
			<p class="eyebrow"><?php esc_html_e( 'Chuẩn bàn giao', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Thương hiệu', 'genesis-theme' ); ?> <em><?php esc_html_e( 'Nhật Bản, Châu Âu & Mỹ', 'genesis-theme' ); ?></em></h2>
			<ul class="ticks">
				<li><?php esc_html_e( 'Thiết bị vệ sinh TOTO, Grohe · thiết bị điện Panasonic, Hager', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Khoá điện tử vân tay Yale · phụ kiện Hafele · gỗ An Cường · sơn Jotun', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Kính Low-E cách nhiệt, hệ thống nước uống tại vòi', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Face ID tại sảnh, Intercom App, thang máy 2,5 m/s dùng thẻ từ', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Wifi miễn phí khu công cộng · hơn 5.000 m² đậu ô tô bổ sung tại hầm', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Công trình theo tiêu chuẩn xanh EDGE', 'genesis-theme' ); ?></li>
			</ul>
		</div>
		<figure>
			<img src="<?php echo esc_url( $theme_uri . '/assets/img/interior.webp' ); ?>" alt="<?php esc_attr_e( 'Phòng khách căn hộ TT GENESIS với ban công nhìn trực diện ra bên ngoài', 'genesis-theme' ); ?>" width="1400" height="538" loading="lazy" />
		</figure>
	</div>
</section>
