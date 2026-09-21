<?php
/**
 * Footer Template
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$theme_uri     = get_template_directory_uri();
$phone         = genesis_get_option( 'genesis_phone', '0903595058' );
$phone_display = genesis_get_option( 'genesis_phone_display', '0903 595 058' );
$tel_href      = 'tel:' . preg_replace( '/\D/', '', $phone );
$zalo_raw      = genesis_get_option( 'genesis_zalo', '0903595058' );
$zalo_href     = 'https://zalo.me/' . preg_replace( '/\D/', '', $zalo_raw );
$advisor       = genesis_get_option( 'genesis_advisor_name', 'Ms. Kim Thuý' );
$email         = genesis_get_option( 'genesis_email', 'lunanguyen2626@gmail.com' );
$company       = genesis_get_option( 'genesis_company_name', 'CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS' );
$company_short = genesis_get_option( 'genesis_company_short', 'Luna Holdings' );
$tax_code      = genesis_get_option( 'genesis_tax_code', '0318925374' );
$address       = genesis_get_option( 'genesis_address', '427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam' );
?>

</main>

<!-- ================= FOOTER ================= -->
<footer class="ft">
	<div class="wrap ft__grid">
		<div>
			<img src="<?php echo esc_url( $theme_uri . '/assets/img/logo-white.png' ); ?>" alt="TT GENESIS" width="156" height="40" loading="lazy" />
			<p><?php esc_html_e( 'Căn hộ Tri thức Nhật Bản tại Nam Sài Gòn.', 'genesis-theme' ); ?><br /><?php esc_html_e( 'Mặt tiền đường 30m, KDC Đào Sư Tích, phường Nhà Bè, TP.HCM.', 'genesis-theme' ); ?></p>
		</div>
		<div>
			<h4><?php esc_html_e( 'Đơn vị tư vấn & phân phối', 'genesis-theme' ); ?></h4>
			<p>
				<b><?php echo esc_html( $company ); ?></b><br />
				<?php printf( esc_html__( 'MST: %s', 'genesis-theme' ), esc_html( $tax_code ) ); ?><br />
				<?php echo esc_html( $address ); ?>
			</p>
		</div>
		<div>
			<h4><?php esc_html_e( 'Liên hệ', 'genesis-theme' ); ?></h4>
			<p>
				Hotline/Zalo: <a href="<?php echo esc_url( $tel_href ); ?>" data-track="call_footer"><?php echo esc_html( $phone_display ); ?></a> (<?php echo esc_html( $advisor ); ?>)<br />
				Email: <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
			</p>
		</div>
	</div>
	<div class="wrap ft__legal">
		<p>
			<?php
			printf(
				esc_html__( 'Trang thông tin do %s – đơn vị tư vấn, phân phối – thực hiện; không phải website chính thức của chủ đầu tư. Thông tin, hình ảnh, giá bán và chính sách trên trang mang tính tham khảo, được tổng hợp từ tài liệu của đơn vị phát triển dự án và có thể thay đổi theo từng thời điểm mà không cần báo trước; nội dung chính thức căn cứ theo hợp đồng và văn bản do chủ đầu tư ban hành. Hình ảnh phối cảnh chỉ mang tính minh hoạ.', 'genesis-theme' ),
				esc_html( $company_short )
			);
			?>
		</p>
		<p><?php esc_html_e( 'Thông tin cá nhân bạn cung cấp chỉ được dùng để tư vấn về dự án TT GENESIS và không chia sẻ cho bên thứ ba.', 'genesis-theme' ); ?></p>
		<p>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $company_short ); ?>.</p>
	</div>
</footer>

<!-- ================= STICKY MOBILE BAR ================= -->
<div class="mbar" role="navigation" aria-label="<?php esc_attr_e( 'Liên hệ nhanh', 'genesis-theme' ); ?>">
	<a href="<?php echo esc_url( $tel_href ); ?>" data-track="call_sticky">
		<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/></svg>
		<?php esc_html_e( 'Gọi ngay', 'genesis-theme' ); ?>
	</a>
	<a href="<?php echo esc_url( $zalo_href ); ?>" target="_blank" rel="noopener" data-track="zalo_sticky">
		<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 3C6.5 3 2 6.8 2 11.5c0 2.6 1.4 5 3.6 6.5L5 21l3.6-1.6c1 .3 2.2.6 3.4.6 5.5 0 10-3.8 10-8.5S17.500 3 12 3z"/></svg>
		Zalo
	</a>
	<a href="#dang-ky" class="mbar__main" data-track="cta_sticky"><?php esc_html_e( 'Nhận bảng giá', 'genesis-theme' ); ?></a>
</div>

<!-- Floating buttons (desktop) -->
<div class="fab">
	<a href="<?php echo esc_url( $zalo_href ); ?>" target="_blank" rel="noopener" class="fab__z" aria-label="<?php esc_attr_e( 'Chat Zalo', 'genesis-theme' ); ?>" data-track="zalo_fab">Zalo</a>
	<a href="<?php echo esc_url( $tel_href ); ?>" class="fab__c" aria-label="<?php echo esc_attr( sprintf( __( 'Gọi %s', 'genesis-theme' ), $phone_display ) ); ?>" data-track="call_fab">
		<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/></svg>
	</a>
</div>

<!-- Lightbox Modal -->
<div class="lb" hidden>
	<button type="button" class="lb__x" aria-label="<?php esc_attr_e( 'Đóng', 'genesis-theme' ); ?>">×</button>
	<img alt="" />
</div>

<?php wp_footer(); ?>
</body>
</html>
