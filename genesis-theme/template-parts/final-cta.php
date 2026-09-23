<?php
/**
 * Template Part: Final CTA & Consultation Form Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$phone         = genesis_get_option( 'genesis_phone', '0938912908' );
$phone_display = genesis_get_option( 'genesis_phone_display', '0938.912.908' );
$advisor       = genesis_get_option( 'genesis_advisor_name', 'PkD TT Genesis' );
$zalo_raw      = genesis_get_option( 'genesis_zalo', '0938912908' );
$zalo_href     = 'https://zalo.me/' . preg_replace( '/\D/', '', $zalo_raw );
$tel_href      = 'tel:' . preg_replace( '/\D/', '', $phone );
?>

<section class="final" id="dang-ky">
	<img class="final__bg" src="<?php echo esc_url( $theme_uri . '/assets/img/amenity-oasis.webp' ); ?>" alt="" width="1400" height="788" loading="lazy" />
	<div class="wrap final__in">
		<div class="final__copy">
			<p class="eyebrow"><?php esc_html_e( 'Đăng ký tư vấn 1:1', 'genesis-theme' ); ?></p>
			<h2><?php esc_html_e( 'Nhận bảng giá, mặt bằng &', 'genesis-theme' ); ?> <em><?php esc_html_e( 'chính sách Đợt 1', 'genesis-theme' ); ?></em></h2>
			<ul class="ticks ticks--light">
				<li><?php esc_html_e( 'Bảng giá chi tiết từng căn – cập nhật trong ngày', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Bảng tính dòng tiền theo phương thức bạn chọn', 'genesis-theme' ); ?></li>
				<li><?php esc_html_e( 'Đặt lịch tham quan WOW Center & nhà mẫu', 'genesis-theme' ); ?></li>
			</ul>
			<div class="final__contact">
				<a href="<?php echo esc_url( $tel_href ); ?>" class="btn btn--gold btn--lg" data-track="call_final">
					<?php printf( esc_html__( 'Gọi %s', 'genesis-theme' ), esc_html( $phone_display ) ); ?>
				</a>
				<a href="<?php echo esc_url( $zalo_href ); ?>" target="_blank" rel="noopener" class="btn btn--ghost btn--lg" data-track="zalo_final">
					<?php printf( esc_html__( 'Zalo %s', 'genesis-theme' ), esc_html( $advisor ) ); ?>
				</a>
			</div>
		</div>
		<?php
		get_template_part(
			'template-parts/form-lead',
			null,
			array(
				'id'       => 'final',
				'title'    => __( 'Đăng ký nhận thông tin', 'genesis-theme' ),
				'subtitle' => __( 'Miễn phí, không ràng buộc. Bạn chọn cách nhận – qua Zalo hoặc điện thoại.', 'genesis-theme' ),
				'cta'      => __( 'Đăng ký ngay', 'genesis-theme' ),
				'compact'  => false,
			)
		);
		?>
	</div>
</section>
