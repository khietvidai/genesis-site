<?php
/**
 * Template Part: Location Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();

$distances = array(
	array( 'v' => '01 phút', 'l' => __( 'Đến sảnh chờ Metro số 4 & số 7', 'genesis-theme' ) ),
	array( 'v' => '03 phút', 'l' => __( 'Đến trung tâm Phú Mỹ Hưng', 'genesis-theme' ) ),
	array( 'v' => '05 phút', 'l' => __( 'Đến các TTTM cao cấp, trường Đại học danh tiếng và Metro Bến Thành – Cần Giờ', 'genesis-theme' ) ),
);

$infra = array(
	array( 't' => __( 'Đường song hành Lê Văn Lương (D1 – 30m)', 'genesis-theme' ), 'd' => __( 'Mặt tiền dự án · nối Vĩnh Phước – Cây Khô', 'genesis-theme' ) ),
	array( 't' => __( 'Đường trên cao Nguyễn Hữu Thọ', 'genesis-theme' ), 'd' => __( '4 làn xe · 6.100 tỷ · KC Q4/2026 – HT 2028', 'genesis-theme' ) ),
	array( 't' => __( 'Đường Vĩnh Phước – Cây Khô', 'genesis-theme' ), 'd' => __( '4 làn xe · 6.100 tỷ · KC Q4/2025 – HT 2028', 'genesis-theme' ) ),
	array( 't' => __( 'Cầu Nguyễn Khoái', 'genesis-theme' ), 'd' => __( 'Lộ giới 35m · 3.700 tỷ · dự kiến HT Q2/2028', 'genesis-theme' ) ),
	array( 't' => __( 'Cầu Thủ Thiêm 4', 'genesis-theme' ), 'd' => __( '8 làn xe · 5.063 tỷ · dự kiến HT Q4/2028', 'genesis-theme' ) ),
	array( 't' => __( 'Cầu Phú Mỹ 2 · Cầu Cần Giờ', 'genesis-theme' ), 'd' => __( '23.186 tỷ & 13.349 tỷ · dự kiến HT 2029', 'genesis-theme' ) ),
	array( 't' => __( 'Metro Bến Thành – Cần Giờ', 'genesis-theme' ), 'd' => __( '102.430 tỷ · KC 2025 – dự kiến HT 2028', 'genesis-theme' ) ),
	array( 't' => __( 'Metro số 4 · Metro số 7', 'genesis-theme' ), 'd' => __( 'Dự kiến khởi công 2027 – 2030 · HT 2035', 'genesis-theme' ) ),
);
?>

<section class="sec sec--dark" id="vi-tri">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Vị trí chiến lược', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Một bước chân,', 'genesis-theme' ); ?> <em><?php esc_html_e( 'ngàn kết nối', 'genesis-theme' ); ?></em></h2>
			<p class="lead"><?php esc_html_e( 'Mặt tiền đường 30m, KDC Đào Sư Tích, phường Nhà Bè, TP.HCM – tâm điểm “thủ phủ” giáo dục quốc tế Nam Sài Gòn với RMIT, SSIS, LSTS, CIS, ABCIS…', 'genesis-theme' ); ?></p>
		</header>
		<div class="loc">
			<figure class="loc__map">
				<img src="<?php echo esc_url( $theme_uri . '/assets/img/location-map.webp' ); ?>" alt="<?php esc_attr_e( 'Bản đồ vị trí TT GENESIS và các tuyến kết nối Nam Sài Gòn', 'genesis-theme' ); ?>" width="1800" height="1012" loading="lazy" data-zoom />
			</figure>
			<div class="loc__side">
				<ul class="dist">
					<?php foreach ( $distances as $d ) : ?>
						<li><strong><?php echo esc_html( $d['v'] ); ?></strong><span><?php echo esc_html( $d['l'] ); ?></span></li>
					<?php endforeach; ?>
				</ul>
				<p class="loc__note"><?php esc_html_e( 'Hưởng trọn hệ sinh thái Phú Mỹ Hưng: Crescent Mall, Lotte Mart, SC VivoCity, Cầu Ánh Sao, Art Center, SECC cùng hệ thống bệnh viện và trường quốc tế.', 'genesis-theme' ); ?></p>
			</div>
		</div>
		<div class="edu">
			<figure class="loc__map">
				<img src="<?php echo esc_url( $theme_uri . '/assets/img/edu-map.webp' ); ?>" alt="<?php esc_attr_e( 'Bản đồ hệ thống trường quốc tế quanh TT GENESIS', 'genesis-theme' ); ?>" width="946" height="797" loading="lazy" data-zoom />
			</figure>
			<div>
				<h3 class="sub sub--left"><?php esc_html_e( 'Toạ độ vun bồi tri thức', 'genesis-theme' ); ?></h3>
				<p class="loc__note"><?php esc_html_e( 'Bao quanh dự án là mạng lưới trường học danh tiếng – nền tảng cho cộng đồng cư dân tri thức và nguồn khách thuê chuyên gia ổn định:', 'genesis-theme' ); ?></p>
				<ul class="chips">
					<li>ĐH RMIT</li><li>ĐH Tôn Đức Thắng</li><li>SSIS – Saigon South</li><li>CIS – Canadian</li><li>ABCIS</li><li>Lawrence S. Ting</li><li>Singapore Int’l School</li><li>Japanese Int’l School</li><li>Korean Int’l School</li><li>Taipei School</li><li>VStar School · VFI School</li>
				</ul>
			</div>
		</div>
		<h3 class="sub"><?php esc_html_e( 'Hạ tầng tỷ đô quanh dự án', 'genesis-theme' ); ?></h3>
		<div class="infra">
			<?php foreach ( $infra as $i ) : ?>
				<div class="infra__it">
					<b><?php echo esc_html( $i['t'] ); ?></b>
					<span><?php echo esc_html( $i['d'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
		<p class="fine"><?php esc_html_e( 'Thông tin quy hoạch, tiến độ hạ tầng mang tính tham khảo theo công bố tại thời điểm tháng 9/2026.', 'genesis-theme' ); ?></p>
	</div>
</section>
