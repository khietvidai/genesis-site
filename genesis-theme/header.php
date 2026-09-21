<?php
/**
 * Header Template
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri       = get_template_directory_uri();
$phone           = genesis_get_option( 'genesis_phone', '0903595058' );
$phone_display   = genesis_get_option( 'genesis_phone_display', '0903 595 058' );
$tel_href        = 'tel:' . preg_replace( '/\D/', '', $phone );
$gtm_id          = genesis_get_option( 'genesis_gtm_id', '' );
$gtag_id         = genesis_get_option( 'genesis_gtag_id', '' );
$meta_pixel_id   = genesis_get_option( 'genesis_meta_pixel_id', '' );
$tiktok_pixel_id = genesis_get_option( 'genesis_tiktok_pixel_id', '' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#16213a" />
	<link rel="icon" type="image/png" href="<?php echo esc_url( $theme_uri . '/assets/img/favicon.png' ); ?>" />

	<?php if ( is_front_page() ) : ?>
		<meta name="description" content="<?php echo esc_attr( __( 'TT GENESIS – căn hộ cao cấp liền kề Phú Mỹ Hưng, liên doanh Việt Nam – Nhật Bản – Singapore. 88 tiện ích Compound Resort, giá từ 69 triệu/m², thanh toán cố định 29 triệu/tháng không vay. Nhận bảng giá & chính sách mới nhất.', 'genesis-theme' ) ); ?>" />
	<?php endif; ?>

	<meta property="og:type" content="website" />
	<meta property="og:locale" content="vi_VN" />
	<meta property="og:title" content="<?php echo esc_attr( wp_get_document_title() ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( __( 'TT GENESIS – căn hộ cao cấp liền kề Phú Mỹ Hưng, liên doanh Việt Nam – Nhật Bản – Singapore. 88 tiện ích Compound Resort, giá từ 69 triệu/m², thanh toán cố định 29 triệu/tháng.', 'genesis-theme' ) ); ?>" />
	<meta property="og:image" content="<?php echo esc_url( $theme_uri . '/assets/img/og-cover.jpg' ); ?>" />
	<meta name="twitter:card" content="summary_large_image" />

	<link rel="preload" as="image" href="<?php echo esc_url( $theme_uri . '/assets/img/hero.webp' ); ?>" media="(min-width: 768px)" fetchpriority="high" />
	<link rel="preload" as="image" href="<?php echo esc_url( $theme_uri . '/assets/img/hero-m.webp' ); ?>" media="(max-width: 767px)" fetchpriority="high" />

	<?php if ( ! empty( $gtm_id ) ) : ?>
		<!-- Google Tag Manager -->
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','<?php echo esc_js( $gtm_id ); ?>');</script>
		<!-- End Google Tag Manager -->
	<?php endif; ?>

	<?php if ( ! empty( $gtag_id ) ) : ?>
		<!-- Global site tag (gtag.js) - Google Analytics / Google Ads -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $gtag_id ); ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '<?php echo esc_js( $gtag_id ); ?>');
		</script>
	<?php endif; ?>

	<?php if ( ! empty( $meta_pixel_id ) ) : ?>
		<!-- Meta Pixel Code -->
		<script>
			!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '<?php echo esc_js( $meta_pixel_id ); ?>');
			fbq('track', 'PageView');
		</script>
		<!-- End Meta Pixel Code -->
	<?php endif; ?>

	<?php if ( ! empty( $tiktok_pixel_id ) ) : ?>
		<!-- TikTok Pixel Code -->
		<script>
			!function(w,d,t){w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"];ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{};ttq._i[e]=[];ttq._i[e]._u=i;ttq._t=ttq._t||{};ttq._t[e]=+new Date;ttq._o=ttq._o||{};ttq._o[e]=n||{};var o=d.createElement("script");o.type="text/javascript";o.async=!0;o.src=i+"?sdkid="+e+"&lib="+t;var a=d.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};ttq.load('<?php echo esc_js( $tiktok_pixel_id ); ?>');ttq.page();}(window,document,'ttq');
		</script>
		<!-- End TikTok Pixel Code -->
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! empty( $gtm_id ) ) : ?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr( $gtm_id ); ?>" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
<?php endif; ?>

<a class="skip" href="#dang-ky"><?php esc_html_e( 'Đến form đăng ký', 'genesis-theme' ); ?></a>

<!-- ================= HEADER ================= -->
<header class="hd" id="top">
	<div class="wrap hd__in">
		<a href="#top" class="hd__logo" aria-label="TT GENESIS">
			<img src="<?php echo esc_url( $theme_uri . '/assets/img/logo-white.png' ); ?>" alt="TT GENESIS" width="156" height="40" />
		</a>
		<nav class="hd__nav" aria-label="<?php esc_attr_e( 'Điều hướng', 'genesis-theme' ); ?>">
			<a href="#uu-dai"><?php esc_html_e( 'Ưu đãi', 'genesis-theme' ); ?></a>
			<a href="#vi-tri"><?php esc_html_e( 'Vị trí', 'genesis-theme' ); ?></a>
			<a href="#tien-ich"><?php esc_html_e( 'Tiện ích', 'genesis-theme' ); ?></a>
			<a href="#can-ho"><?php esc_html_e( 'Căn hộ', 'genesis-theme' ); ?></a>
			<a href="#thanh-toan"><?php esc_html_e( 'Thanh toán', 'genesis-theme' ); ?></a>
			<a href="#phap-ly"><?php esc_html_e( 'Pháp lý', 'genesis-theme' ); ?></a>
			<a href="#faq"><?php esc_html_e( 'Hỏi đáp', 'genesis-theme' ); ?></a>
		</nav>
		<a href="<?php echo esc_url( $tel_href ); ?>" class="btn btn--gold hd__call" data-track="call_header">
			<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/></svg>
			<span><?php echo esc_html( $phone_display ); ?></span>
		</a>
	</div>
</header>

<main>
