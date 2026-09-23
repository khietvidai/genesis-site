<?php
/**
 * Template Part: Reusable Lead Form
 *
 * @package Genesis_Theme
 *
 * @param array $args Form arguments (id, title, subtitle, cta, compact).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$form_id  = isset( $args['id'] ) ? esc_attr( $args['id'] ) : 'default';
$title    = isset( $args['title'] ) ? esc_html( $args['title'] ) : __( 'Đăng ký nhận thông tin', 'genesis-theme' );
$subtitle = isset( $args['subtitle'] ) ? esc_html( $args['subtitle'] ) : '';
$cta      = isset( $args['cta'] ) ? esc_html( $args['cta'] ) : __( 'Đăng ký ngay', 'genesis-theme' );
$compact  = ! empty( $args['compact'] );

$advisor       = genesis_get_option( 'genesis_advisor_name', 'PkD TT Genesis' );
$company_short = genesis_get_option( 'genesis_company_short', 'Luna Holdings' );
$tax_code      = genesis_get_option( 'genesis_tax_code', '0318925374' );
$zalo_raw      = genesis_get_option( 'genesis_zalo', '0938912908' );
$zalo_href     = 'https://zalo.me/' . preg_replace( '/\D/', '', $zalo_raw );

// Calculate initials for avatar
$clean_name = preg_replace( '/^(Ms\.|Mr\.|Mrs\.)\s*/i', '', $advisor );
$words      = preg_split( '/\s+/', trim( $clean_name ) );
$initials   = '';
if ( ! empty( $words ) ) {
	foreach ( array_slice( $words, 0, 2 ) as $w ) {
		$initials .= mb_substr( $w, 0, 1, 'UTF-8' );
	}
}
$initials = mb_strtoupper( $initials, 'UTF-8' );
?>

<form class="lf" data-lead="<?php echo $form_id; ?>" novalidate>
	<h3 class="lf__t"><?php echo $title; ?></h3>
	<?php if ( $subtitle ) : ?>
		<p class="lf__s"><?php echo $subtitle; ?></p>
	<?php endif; ?>

	<ul class="lf__get">
		<li><?php esc_html_e( 'Bảng giá từng căn & mặt bằng tầng', 'genesis-theme' ); ?></li>
		<li><?php esc_html_e( 'Chính sách Đợt 1 & bảng tính dòng tiền', 'genesis-theme' ); ?></li>
	</ul>

	<label>
		<span><?php esc_html_e( 'Họ và tên', 'genesis-theme' ); ?></span>
		<input type="text" name="fullname" autocomplete="name" placeholder="<?php esc_attr_e( 'Tên của bạn', 'genesis-theme' ); ?>" required />
	</label>
	<label>
		<span><?php esc_html_e( 'Số điện thoại', 'genesis-theme' ); ?></span>
		<input type="tel" name="phone" autocomplete="tel" inputmode="tel" placeholder="<?php esc_attr_e( 'Số di động của bạn', 'genesis-theme' ); ?>" required />
	</label>

	<fieldset class="lf__pref">
		<legend><?php esc_html_e( 'Bạn muốn nhận thông tin qua', 'genesis-theme' ); ?></legend>
		<label><input type="radio" name="contact_pref" value="Zalo" checked /><span><?php esc_html_e( 'Nhắn Zalo trước', 'genesis-theme' ); ?></span></label>
		<label><input type="radio" name="contact_pref" value="Gọi điện" /><span><?php esc_html_e( 'Gọi điện', 'genesis-theme' ); ?></span></label>
	</fieldset>

	<?php if ( $compact ) : ?>
		<input type="hidden" name="interest" value="Chưa xác định" />
	<?php else : ?>
		<label>
			<span><?php esc_html_e( 'Loại căn quan tâm', 'genesis-theme' ); ?> <i>(<?php esc_html_e( 'không bắt buộc', 'genesis-theme' ); ?>)</i></span>
			<select name="interest">
				<option value="Chưa xác định"><?php esc_html_e( 'Cần tư vấn thêm', 'genesis-theme' ); ?></option>
				<option value="Studio"><?php esc_html_e( 'Studio · 35 m²', 'genesis-theme' ); ?></option>
				<option value="1PN"><?php esc_html_e( '1 phòng ngủ · 53 m²', 'genesis-theme' ); ?></option>
				<option value="2PN"><?php esc_html_e( '2 phòng ngủ · 69–74 m²', 'genesis-theme' ); ?></option>
				<option value="3PN"><?php esc_html_e( '3 phòng ngủ · 95–120 m²', 'genesis-theme' ); ?></option>
				<option value="Khác"><?php esc_html_e( 'Duplex / Sân vườn / Penthouse', 'genesis-theme' ); ?></option>
			</select>
		</label>
	<?php endif; ?>

	<input type="text" name="website" tabindex="-1" autocomplete="off" class="lf__hp" aria-hidden="true" />
	<button type="submit" class="btn btn--gold btn--block"><?php echo $cta; ?></button>
	<p class="lf__msg" role="status"></p>

	<div class="lf__who">
		<span class="lf__ava" aria-hidden="true"><?php echo esc_html( $initials ); ?></span>
		<p>
			<b><?php echo esc_html( $advisor ); ?></b> <?php esc_html_e( 'sẽ trực tiếp gửi thông tin cho bạn', 'genesis-theme' ); ?>
			<small><?php printf( esc_html__( 'Chuyên viên tư vấn · %1$s · MST %2$s', 'genesis-theme' ), esc_html( $company_short ), esc_html( $tax_code ) ); ?></small>
		</p>
	</div>
	<ul class="lf__trust">
		<li><?php esc_html_e( 'Chỉ 1 chuyên viên liên hệ', 'genesis-theme' ); ?></li>
		<li><?php esc_html_e( 'Không gọi làm phiền', 'genesis-theme' ); ?></li>
		<li><?php esc_html_e( 'Không chia sẻ số', 'genesis-theme' ); ?></li>
	</ul>
	<p class="lf__p">
		<?php printf( esc_html__( 'Bằng việc gửi, bạn đồng ý để %s liên hệ tư vấn về TT GENESIS. Bạn có thể yêu cầu xoá thông tin bất cứ lúc nào.', 'genesis-theme' ), esc_html( $company_short ) ); ?>
		<a href="<?php echo esc_url( $zalo_href ); ?>" target="_blank" rel="noopener" data-track="zalo_form_<?php echo $form_id; ?>"><?php esc_html_e( 'Chưa muốn để lại số? Chat Zalo trực tiếp →', 'genesis-theme' ); ?></a>
	</p>
</form>
