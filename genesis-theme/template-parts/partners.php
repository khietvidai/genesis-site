<?php
/**
 * Template Part: Partners Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();

$partner_logos = array(
	array( 'f' => 'hinokiya', 'n' => 'Hinokiya Group', 'w' => 423, 'h' => 66, 'dh' => 20 ),
	array( 'f' => 'cosmos-initia', 'n' => 'Cosmos Initia – Daiwa House Group', 'w' => 538, 'h' => 150, 'dh' => 46 ),
	array( 'f' => 'tt-capital', 'n' => 'TT Capital', 'w' => 314, 'h' => 168, 'dh' => 54 ),
	array( 'f' => 'vietmax-capital', 'n' => 'Vietmax Capital', 'w' => 488, 'h' => 132, 'dh' => 42 ),
	array( 'f' => 'koterasu', 'n' => 'Koterasu Partners', 'w' => 436, 'h' => 162, 'dh' => 50 ),
);

$partners = array(
	array( 'n' => 'TT Capital', 'c' => 'Việt Nam', 'd' => __( 'Nhà phát triển bất động sản Sáng tạo – Đột phá – Tiên phong, kế thừa thành công từ TT AVIO.', 'genesis-theme' ) ),
	array( 'n' => 'Cosmos Initia', 'c' => 'Nhật Bản', 'd' => __( 'Thương hiệu 50 năm, thành viên Tập đoàn Daiwa House. Khoảng 2.000 dự án, hơn 100.000 sản phẩm.', 'genesis-theme' ) ),
	array( 'n' => 'Hinokiya Group', 'c' => 'Nhật Bản', 'd' => __( 'Thành viên Tập đoàn Yamada HD, doanh số hơn 5.000 căn nhà mỗi năm.', 'genesis-theme' ) ),
	array( 'n' => 'Koterasu Group', 'c' => 'Nhật Bản', 'd' => __( 'Quỹ đầu tư tài chính bất động sản đa quốc gia: Nhật Bản, Việt Nam, Châu Âu.', 'genesis-theme' ) ),
	array( 'n' => 'Vietmax Capital', 'c' => 'Singapore', 'd' => __( 'Định chế tài chính chuyên biệt về bất động sản, thành lập bởi Quỹ đầu tư Waymax Singapore.', 'genesis-theme' ) ),
);

$consultants = array(
	array( __( 'Thiết kế kiến trúc', 'genesis-theme' ), 'TWOG Architecture' ),
	array( __( 'Thiết kế nội thất', 'genesis-theme' ), 'Vertical Studio' ),
	array( __( 'Design & Build', 'genesis-theme' ), 'RICONS' ),
	array( __( 'Tư vấn giám sát', 'genesis-theme' ), 'CORE ASIA' ),
	array( __( 'Quản lý vận hành', 'genesis-theme' ), 'CBRE' ),
	array( __( 'Công trình xanh EDGE', 'genesis-theme' ), 'ARDOR Green' ),
);
?>

<section class="sec sec--cream" id="doi-tac">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Liên doanh phát triển dự án', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Kiến tạo các', 'genesis-theme' ); ?> <em><?php esc_html_e( 'giá trị bền vững', 'genesis-theme' ); ?></em></h2>
		</header>
		<figure class="wide jv">
			<img src="<?php echo esc_url( $theme_uri . '/assets/img/jv-signing.webp' ); ?>" alt="<?php esc_attr_e( 'Lễ ký kết liên doanh phát triển dự án TT GENESIS', 'genesis-theme' ); ?>" width="1400" height="788" loading="lazy" />
			<figcaption><?php esc_html_e( 'Lễ ký kết liên doanh Việt Nam – Nhật Bản – Singapore', 'genesis-theme' ); ?></figcaption>
		</figure>
		<ul class="plogos" aria-label="<?php esc_attr_e( 'Liên doanh đầu tư và phát triển dự án', 'genesis-theme' ); ?>">
			<?php foreach ( $partner_logos as $l ) : ?>
				<li><img src="<?php echo esc_url( $theme_uri . '/assets/img/partners/' . $l['f'] . '.webp' ); ?>" alt="<?php echo esc_attr( $l['n'] ); ?>" width="<?php echo esc_attr( $l['w'] ); ?>" height="<?php echo esc_attr( $l['h'] ); ?>" style="--h:<?php echo esc_attr( $l['dh'] ); ?>px;" loading="lazy" /></li>
			<?php endforeach; ?>
		</ul>
		<div class="partners">
			<?php foreach ( $partners as $p ) : ?>
				<article class="partner">
					<span><?php echo esc_html( $p['c'] ); ?></span>
					<h3><?php echo esc_html( $p['n'] ); ?></h3>
					<p><?php echo esc_html( $p['d'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="consult">
			<?php foreach ( $consultants as $c ) : ?>
				<div><span><?php echo esc_html( $c[0] ); ?></span><b><?php echo esc_html( $c[1] ); ?></b></div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
