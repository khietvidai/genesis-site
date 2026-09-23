<?php
/**
 * Template Part: Hero Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();
$zalo_raw  = genesis_get_option( 'genesis_zalo', '0938912908' );
$zalo_href = 'https://zalo.me/' . preg_replace( '/\D/', '', $zalo_raw );

$eyebrow = genesis_get_option( 'genesis_hero_eyebrow', 'Liên doanh Việt Nam · Nhật Bản · Singapore' );
$price_k = genesis_get_option( 'genesis_hero_price_k', 'Giá chỉ từ' );
$price_v = genesis_get_option( 'genesis_hero_price_v', '69' );
$price_u = genesis_get_option( 'genesis_hero_price_u', 'triệu/m²' );
$pay_k   = genesis_get_option( 'genesis_hero_pay_k', 'Thanh toán cố định · không vay' );
$pay_v   = genesis_get_option( 'genesis_hero_pay_v', '29' );
$pay_u   = genesis_get_option( 'genesis_hero_pay_u', 'triệu/tháng' );
?>

<section class="hero">
	<picture class="hero__bg">
		<source media="(max-width: 767px)" srcset="<?php echo esc_url( $theme_uri . '/assets/img/hero-m.webp' ); ?>" />
		<img src="<?php echo esc_url( $theme_uri . '/assets/img/hero.webp' ); ?>" alt="<?php esc_attr_e( 'Phối cảnh hai tháp Maris và Lucis của TT GENESIS bên sông lúc hoàng hôn', 'genesis-theme' ); ?>" width="2000" height="968" fetchpriority="high" />
	</picture>
	<div class="wrap hero__in">
		<div class="hero__copy">
			<p class="eyebrow"><?php echo esc_html( $eyebrow ); ?></p>
			<h1>
				<span class="h1__small"><?php esc_html_e( 'Căn hộ', 'genesis-theme' ); ?></span>
				<?php esc_html_e( 'Tri thức', 'genesis-theme' ); ?> <em><?php esc_html_e( 'Nhật Bản', 'genesis-theme' ); ?></em>
				<span class="h1__sub"><?php esc_html_e( 'tại Nam Sài Gòn – liền kề Phú Mỹ Hưng', 'genesis-theme' ); ?></span>
			</h1>
			<div class="hero__price">
				<div class="pricebox">
					<span class="pricebox__k"><?php echo esc_html( $price_k ); ?></span>
					<span class="pricebox__v"><?php echo esc_html( $price_v ); ?><small> <?php echo esc_html( $price_u ); ?></small></span>
				</div>
				<div class="pricebox">
					<span class="pricebox__k"><?php echo esc_html( $pay_k ); ?></span>
					<span class="pricebox__v"><?php echo esc_html( $pay_v ); ?><small> <?php echo esc_html( $pay_u ); ?></small></span>
				</div>
			</div>
			<p class="hero__note"><?php esc_html_e( 'Đơn giá theo phương thức thanh toán chuẩn, diện tích tim tường, chưa gồm VAT. Thanh toán cố định áp dụng theo phương thức “Dễ sở hữu 2”.', 'genesis-theme' ); ?></p>
			<ul class="hero__ticks">
				<li><?php esc_html_e( '88 tiện ích Compound Resort trên 1,9 ha', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Sổ hồng sở hữu lâu dài · VPBank bảo lãnh', 'genesis-theme' ); ?></li>
				<?php $genesis_deadline = genesis_get_option( 'genesis_countdown_deadline', '2026-10-06T23:59:59+07:00' ); ?>
				<li data-expires="<?php echo esc_attr( $genesis_deadline ); ?>"><?php esc_html_e( 'Chiết khấu 1% cho khách đăng ký sớm đến 06/10/2026 (*)', 'genesis-theme' ); ?></li>
				<li data-show-after="<?php echo esc_attr( $genesis_deadline ); ?>" hidden><?php esc_html_e( 'Chính sách thanh toán linh hoạt, đến 8% chiết khấu', 'genesis-theme' ); ?></li>
			</ul>
			<div class="hero__cta">
				<a href="#dang-ky" class="btn btn--gold btn--lg" data-track="cta_hero"><?php esc_html_e( 'Nhận bảng giá & chính sách', 'genesis-theme' ); ?></a>
				<a href="<?php echo esc_url( $zalo_href ); ?>" target="_blank" rel="noopener" class="btn btn--ghost btn--lg" data-track="zalo_hero"><?php esc_html_e( 'Chat Zalo tư vấn', 'genesis-theme' ); ?></a>
			</div>
		</div>
		<div class="hero__form">
			<?php
			get_template_part(
				'template-parts/form-lead',
				null,
				array(
					'id'       => 'hero',
					'compact'  => true,
					'title'    => __( 'Nhận bảng giá Đợt 1', 'genesis-theme' ),
					'subtitle' => __( 'Miễn phí, không ràng buộc. Bạn chọn cách nhận – qua Zalo hoặc điện thoại.', 'genesis-theme' ),
					'cta'      => __( 'Gửi tôi bảng giá', 'genesis-theme' ),
				)
			);
			?>
		</div>
	</div>
</section>
