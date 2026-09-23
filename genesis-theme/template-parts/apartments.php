<?php
/**
 * Template Part: Apartments & Floor Plans Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri = get_template_directory_uri();

$plans = array(
	array( 'id' => 'studio', 'tab' => 'Studio', 'name' => 'Studio · AURA', 'img' => 'plan-studio', 'tt' => '35,24 m²', 'lt' => '31,82 m²', 'note' => __( 'Tối ưu cho người trẻ & cho thuê', 'genesis-theme' ) ),
	array( 'id' => '1br', 'tab' => '1PN', 'name' => '1 phòng ngủ · 1WC · AURA', 'img' => 'plan-1br', 'tt' => '52,92 m²', 'lt' => '48,99 m²', 'note' => __( 'Ban công & sân phơi tách biệt', 'genesis-theme' ) ),
	array( 'id' => '2br-basic', 'tab' => '2PN Basic', 'name' => '2 phòng ngủ · 2WC · LUMINA Basic', 'img' => 'plan-2br-basic', 'tt' => '69,00 m²', 'lt' => '63,42 m²', 'note' => __( 'Dòng 2PN chủ lực – chiếm khoảng 66% giỏ hàng dự án', 'genesis-theme' ) ),
	array( 'id' => '2br-corner', 'tab' => '2PN Corner', 'name' => '2 phòng ngủ · 2WC · LUMINA Corner', 'img' => 'plan-2br-corner', 'tt' => '71,92 m²', 'lt' => '66,77 m²', 'note' => __( 'Căn góc 2 mặt thoáng', 'genesis-theme' ) ),
	array( 'id' => '2br-plus', 'tab' => '2PN Plus', 'name' => '2 phòng ngủ · 2WC · LUMINA Plus', 'img' => 'plan-2br-plus', 'tt' => '73,96 m²', 'lt' => '68,34 m²', 'note' => __( 'Rộng rãi cho gia đình trẻ', 'genesis-theme' ) ),
	array( 'id' => '3br-basic', 'tab' => '3PN Basic', 'name' => '3 phòng ngủ · 2WC · TIDAL Basic', 'img' => 'plan-3br-basic', 'tt' => '94,55 m²', 'lt' => '88,83 m²', 'note' => __( 'Không gian đa thế hệ', 'genesis-theme' ) ),
	array( 'id' => '3br-plus', 'tab' => '3PN Plus', 'name' => '3 phòng ngủ · 2WC · TIDAL Plus', 'img' => 'plan-3br-plus', 'tt' => '119,57 m²', 'lt' => '113,16 m²', 'note' => __( 'Không gian rộng rãi cho gia đình đa thế hệ', 'genesis-theme' ) ),
);
?>

<section class="sec sec--dark" id="can-ho">
	<div class="wrap">
		<header class="sec__hd">
			<p class="eyebrow"><?php esc_html_e( 'Thiết kế căn hộ', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Khi con người', 'genesis-theme' ); ?> <em><?php esc_html_e( 'kết nối với thiên nhiên', 'genesis-theme' ); ?></em></h2>
			<p class="lead"><?php esc_html_e( 'Thiết kế bởi TWOG: 100% phòng khách và phòng ngủ nhìn trực diện bên ngoài, 100% căn hộ có ban công và sân phơi, tỷ lệ vàng 6 thang máy cho 12–13 căn mỗi tầng.', 'genesis-theme' ); ?></p>
		</header>
		<div class="tabs" data-tabs>
			<div class="tabs__bar" role="tablist" aria-label="<?php esc_attr_e( 'Loại căn hộ', 'genesis-theme' ); ?>">
				<?php foreach ( $plans as $i => $p ) : ?>
					<button role="tab" type="button" id="tab-<?php echo esc_attr( $p['id'] ); ?>" aria-controls="pn-<?php echo esc_attr( $p['id'] ); ?>" aria-selected="<?php echo ( 2 === $i ) ? 'true' : 'false'; ?>" tabindex="<?php echo ( 2 === $i ) ? '0' : '-1'; ?>"><?php echo esc_html( $p['tab'] ); ?></button>
				<?php endforeach; ?>
			</div>
			<?php foreach ( $plans as $i => $p ) : ?>
				<div class="plan" role="tabpanel" id="pn-<?php echo esc_attr( $p['id'] ); ?>" aria-labelledby="tab-<?php echo esc_attr( $p['id'] ); ?>" <?php echo ( 2 !== $i ) ? 'hidden' : ''; ?>>
					<img src="<?php echo esc_url( $theme_uri . '/assets/img/' . $p['img'] . '.webp' ); ?>" alt="<?php echo esc_attr( sprintf( __( 'Mặt bằng căn hộ %s', 'genesis-theme' ), $p['name'] ) ); ?>" width="1400" height="787" loading="lazy" data-zoom />
					<div class="plan__info">
						<h3><?php echo esc_html( $p['name'] ); ?></h3>
						<dl>
							<div><dt><?php esc_html_e( 'Diện tích tim tường', 'genesis-theme' ); ?></dt><dd><?php echo esc_html( $p['tt'] ); ?></dd></div>
							<div><dt><?php esc_html_e( 'Diện tích thông thuỷ', 'genesis-theme' ); ?></dt><dd><?php echo esc_html( $p['lt'] ); ?></dd></div>
						</dl>
						<p><?php echo esc_html( $p['note'] ); ?></p>
						<a href="#dang-ky" class="btn btn--gold" data-track="cta_plan_<?php echo esc_attr( $p['id'] ); ?>" data-interest="<?php echo esc_attr( $p['tab'] ); ?>">
							<?php printf( esc_html__( 'Xem giá căn %s', 'genesis-theme' ), esc_html( $p['tab'] ) ); ?>
						</a>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="mix">
			<div><b>1.363</b><span><?php esc_html_e( 'Căn hộ (tầng 3–30)', 'genesis-theme' ); ?></span></div>
			<div><b>42</b><span><?php esc_html_e( 'Căn Duplex khối đế', 'genesis-theme' ); ?></span></div>
			<div><b>12</b><span><?php esc_html_e( 'Căn hộ sân vườn', 'genesis-theme' ); ?></span></div>
			<div><b>9</b><span>Penthouse</span></div>
			<div><b>12</b><span><?php esc_html_e( 'Nhà liên kế', 'genesis-theme' ); ?></span></div>
		</div>
		<p class="fine"><?php esc_html_e( 'Hình ảnh minh hoạ, đồ nội thất chỉ mang tính chất tham khảo. Thông số bàn giao theo hợp đồng.', 'genesis-theme' ); ?></p>
	</div>
</section>
