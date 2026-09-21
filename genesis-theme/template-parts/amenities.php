<?php
/**
 * Template Part: Amenities Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();

$zones = array(
	array(
		'img' => 'amenity-oasis',
		't'   => 'THE OASIS',
		's'   => __( 'Ốc đảo thủy dưỡng · 1.358 m²', 'genesis-theme' ),
		'd'   => __( 'Hồ bơi công nghệ muối khoáng: hồ người lớn dài 39m, hồ trẻ em 275 m² mặt nước.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-apollo',
		't'   => 'APOLLO',
		's'   => __( 'Quảng trường tri thức · ~1.118 m²', 'genesis-theme' ),
		'd'   => __( 'Thảm xanh cho những kết nối tự nhiên, đa thế hệ.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-galaxy',
		't'   => 'GALAXY',
		's'   => __( 'Trạm khai phá · ~1.000 m²', 'genesis-theme' ),
		'd'   => __( 'Khu vui chơi – vận động sáng tạo dành cho trẻ em.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-olympic',
		't'   => 'OLYMPIC',
		's'   => __( 'Khu vận động thể chất · ~870 m²', 'genesis-theme' ),
		'd'   => __( 'Đường chạy bộ trên cao, sân bóng rổ, thiết bị thể thao ngoài trời.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-bbq',
		't'   => 'HEALING GARDEN',
		's'   => __( 'Vườn thư thái & BBQ', 'genesis-theme' ),
		'd'   => __( 'Vườn thiền, vườn rau xanh, khu BBQ, không gian thưởng trà.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-library',
		't'   => 'WISDOM FLOOR',
		's'   => __( 'Thư viện 24/7 · Co-working', 'genesis-theme' ),
		'd'   => __( 'Thư viện sách, khu thảo luận nhóm, sofa đọc sách riêng tư.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-kids',
		't'   => __( 'VƯỜN TUỔI THƠ', 'genesis-theme' ),
		's'   => __( 'Nhà trẻ · khu vui chơi trong nhà', 'genesis-theme' ),
		'd'   => __( 'Rạp chiếu phim trẻ em, khu vui chơi và trường mầm non 1.400 m² tại tháp Lucis.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-gym',
		't'   => 'WELLNESS CENTER',
		's'   => 'Gym · Yoga · Sauna',
		'd'   => __( 'Phòng Gym, Yoga & Dance, xông hơi nam – nữ, Golf 3D.', 'genesis-theme' ),
	),
	array(
		'img' => 'amenity-lounge',
		't'   => 'CIGAR LOUNGE',
		's'   => __( 'Không gian khẳng định vị thế', 'genesis-theme' ),
		'd'   => __( 'Cigar Lounge, phòng yến tiệc lớn – nhỏ, khu tiếp thực.', 'genesis-theme' ),
	),
);
?>

<section class="sec sec--cream" id="tien-ich">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Compound Resort đa thế hệ', 'genesis-theme' ); ?></p>
			<h2>88 <?php esc_html_e( 'tiện ích nuôi dưỡng', 'genesis-theme' ); ?> <em><?php esc_html_e( 'Thân – Tâm – Trí', 'genesis-theme' ); ?></em></h2>
			<p class="lead"><?php esc_html_e( 'Hơn 8.000 m² tiện ích ngoài trời và 2.800 m² tiện ích trong nhà – từ học tập đến vận động, từ kết nối đến tĩnh tại, mỗi thành viên đều có khoảng không của riêng mình.', 'genesis-theme' ); ?></p>
		</header>
		<figure class="wide">
			<img src="<?php echo esc_url( $theme_uri . '/assets/img/amenity-night.webp' ); ?>" alt="<?php esc_attr_e( 'Toàn cảnh hệ tiện ích nội khu TT GENESIS với kim tự tháp trung tâm và hồ bơi', 'genesis-theme' ); ?>" width="1600" height="900" loading="lazy" />
			<figcaption><?php esc_html_e( 'Toạ độ trung tâm PYRAMID (~836 m²) – biểu tượng tri thức giữa lòng nội khu', 'genesis-theme' ); ?></figcaption>
		</figure>
		<div class="zones">
			<?php foreach ( $zones as $z ) : ?>
				<article class="zone">
					<img src="<?php echo esc_url( $theme_uri . '/assets/img/' . $z['img'] . '.webp' ); ?>" alt="<?php echo esc_attr( $z['t'] . ' – ' . $z['s'] ); ?>" loading="lazy" width="700" height="394" data-zoom />
					<div class="zone__tx">
						<h3><?php echo esc_html( $z['t'] ); ?></h3>
						<p class="zone__s"><?php echo esc_html( $z['s'] ); ?></p>
						<p><?php echo esc_html( $z['d'] ); ?></p>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
		<div class="center">
			<a href="#dang-ky" class="btn btn--navy btn--lg" data-track="cta_amenities"><?php esc_html_e( 'Đặt lịch tham quan WOW Center', 'genesis-theme' ); ?></a>
		</div>
	</div>
</section>
