<?php
/**
 * Template Part: Strengths Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();

$strengths = array(
	array(
		'n' => '01',
		't' => __( 'Liên doanh quốc tế', 'genesis-theme' ),
		'd' => __( 'Việt Nam – Nhật Bản – Singapore: kinh nghiệm triển khai, tiềm lực tài chính mạnh, phát triển theo triết lý “Next Good”.', 'genesis-theme' ),
	),
	array(
		'n' => '02',
		't' => __( 'Vị trí đa kết nối', 'genesis-theme' ),
		'd' => __( 'Liền kề Phú Mỹ Hưng, nằm trong hạ tầng tỷ đô của TOD Khu Nam. 3 mặt hướng sông, 4 mặt tiền đường.', 'genesis-theme' ),
	),
	array(
		'n' => '03',
		't' => __( 'Thiết kế ưu việt', 'genesis-theme' ),
		'd' => __( 'Compound Resort hơn 10.800 m² với 88 tiện ích. 6 thang máy/tầng. 100% phòng khách, phòng ngủ nhìn trực diện bên ngoài.', 'genesis-theme' ),
	),
	array(
		'n' => '04',
		't' => __( 'Chuẩn bàn giao vượt trội', 'genesis-theme' ),
		'd' => __( 'Thương hiệu Nhật Bản – Châu Âu – Mỹ: Toshiba, Panasonic, TOTO, Yale, Hafele, Hager, An Cường.', 'genesis-theme' ),
	),
	array(
		'n' => '05',
		't' => __( 'Bảo chứng từ đối tác', 'genesis-theme' ),
		'd' => __( 'Tổng thầu RICONS, thiết kế TWOG, tư vấn công trình xanh EDGE – ARDOR Green, quản lý vận hành CBRE.', 'genesis-theme' ),
	),
	array(
		'n' => '06',
		't' => __( 'Chính sách dễ sở hữu', 'genesis-theme' ),
		'd' => __( 'Giá vừa túi tiền từ 69 triệu/m², nhiều phương thức thanh toán linh hoạt, 5 ngân hàng đồng hành.', 'genesis-theme' ),
	),
);
?>

<section class="sec sec--cream" id="tong-quan">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Vì sao chọn TT GENESIS', 'genesis-theme' ); ?></p>
			<h2>6 <?php esc_html_e( 'yếu tố', 'genesis-theme' ); ?> <em><?php esc_html_e( 'gia tăng giá trị', 'genesis-theme' ); ?></em></h2>
		</header>
		<div class="strengths">
			<?php foreach ( $strengths as $s ) : ?>
				<article class="strength">
					<span class="strength__n"><?php echo esc_html( $s['n'] ); ?></span>
					<h3><?php echo esc_html( $s['t'] ); ?></h3>
					<p><?php echo esc_html( $s['d'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<figure class="wide">
			<img src="<?php echo esc_url( $theme_uri . '/assets/img/aerial-night.webp' ); ?>" alt="<?php esc_attr_e( 'Toàn cảnh TT GENESIS về đêm giữa Nam Sài Gòn, bao quanh bởi sông nước', 'genesis-theme' ); ?>" width="1800" height="1012" loading="lazy" />
			<figcaption><?php esc_html_e( '3 mặt hướng sông · 4 mặt tiền đường · vận hành chuẩn Compound với 2 lối ra vào riêng biệt', 'genesis-theme' ); ?></figcaption>
		</figure>
	</div>
</section>
