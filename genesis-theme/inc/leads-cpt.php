<?php
/**
 * TT GENESIS Leads Custom Post Type & CRM Management
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Custom Post Type: genesis_lead
 */
function genesis_register_lead_cpt() {
	$labels = array(
		'name'               => __( 'Khách hàng tiềm năng', 'genesis-theme' ),
		'singular_name'      => __( 'Khách hàng tiềm năng', 'genesis-theme' ),
		'menu_name'          => __( 'Khách hàng (Leads)', 'genesis-theme' ),
		'all_items'          => __( 'Tất cả Khách hàng', 'genesis-theme' ),
		'add_new'            => __( 'Thêm Lead mới', 'genesis-theme' ),
		'add_new_item'       => __( 'Thêm Lead mới', 'genesis-theme' ),
		'edit_item'          => __( 'Chi tiết Khách hàng', 'genesis-theme' ),
		'new_item'           => __( 'Lead mới', 'genesis-theme' ),
		'view_item'          => __( 'Xem Lead', 'genesis-theme' ),
		'search_items'       => __( 'Tìm kiếm Lead', 'genesis-theme' ),
		'not_found'          => __( 'Chưa có lead nào', 'genesis-theme' ),
		'not_found_in_trash' => __( 'Không có lead trong thùng rác', 'genesis-theme' ),
	);

	$args = array(
		'labels'              => $labels,
		'public'              => false,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'query_var'           => false,
		'rewrite'             => false,
		'capability_type'     => 'post',
		'has_archive'         => false,
		'hierarchical'        => false,
		'menu_position'       => 25,
		'menu_icon'           => 'dashicons-id-alt',
		'supports'            => array( 'title' ),
	);

	register_post_type( 'genesis_lead', $args );
}
add_action( 'init', 'genesis_register_lead_cpt' );

/**
 * Custom columns for genesis_lead list table.
 *
 * @param array $columns Existing columns.
 * @return array Modified columns.
 */
function genesis_lead_columns( $columns ) {
	$new_columns = array(
		'cb'           => $columns['cb'],
		'title'        => __( 'Họ và tên', 'genesis-theme' ),
		'phone'        => __( 'Số điện thoại', 'genesis-theme' ),
		'contact_pref' => __( 'Ưu tiên liên hệ', 'genesis-theme' ),
		'interest'     => __( 'Loại căn quan tâm', 'genesis-theme' ),
		'form_id'      => __( 'Vị trí Form', 'genesis-theme' ),
		'utm'          => __( 'Chiến dịch (UTM)', 'genesis-theme' ),
		'date'         => __( 'Thời gian gửi', 'genesis-theme' ),
	);
	return $new_columns;
}
add_filter( 'manage_genesis_lead_posts_columns', 'genesis_lead_columns' );

/**
 * Display data in custom columns.
 *
 * @param string $column Column name.
 * @param int    $post_id Post ID.
 */
function genesis_lead_custom_column_data( $column, $post_id ) {
	switch ( $column ) {
		case 'phone':
			$phone = get_post_meta( $post_id, '_lead_phone', true );
			if ( $phone ) {
				echo '<a href="tel:' . esc_attr( $phone ) . '"><strong>' . esc_html( $phone ) . '</strong></a>';
			} else {
				echo '—';
			}
			break;

		case 'contact_pref':
			$pref = get_post_meta( $post_id, '_lead_contact_pref', true );
			if ( 'Zalo' === $pref ) {
				echo '<span style="display:inline-block;padding:2px 8px;border-radius:4px;background:#0068ff;color:#fff;font-size:12px;font-weight:600;">Zalo</span>';
			} elseif ( $pref ) {
				echo '<span style="display:inline-block;padding:2px 8px;border-radius:4px;background:#2d5a3d;color:#fff;font-size:12px;font-weight:600;">' . esc_html( $pref ) . '</span>';
			} else {
				echo '—';
			}
			break;

		case 'interest':
			$interest = get_post_meta( $post_id, '_lead_interest', true );
			echo $interest ? esc_html( $interest ) : '—';
			break;

		case 'form_id':
			$form_id = get_post_meta( $post_id, '_lead_form_id', true );
			echo $form_id ? '<code>' . esc_html( $form_id ) . '</code>' : '—';
			break;

		case 'utm':
			$src = get_post_meta( $post_id, '_lead_utm_source', true );
			$cam = get_post_meta( $post_id, '_lead_utm_campaign', true );
			$is_sample = get_post_meta( $post_id, '_lead_is_sample', true );
			if ( $is_sample ) {
				echo '<span style="background:#fff3cd;color:#856404;padding:2px 6px;border-radius:3px;font-size:11px;font-weight:bold;margin-right:4px;">Sample</span>';
			}
			if ( $src || $cam ) {
				echo esc_html( $src ? $src : 'direct' );
				if ( $cam ) {
					echo ' / <small>' . esc_html( $cam ) . '</small>';
				}
			} else {
				echo '<span style="color:#888;">Direct / Organic</span>';
			}
			break;
	}
}
add_action( 'manage_genesis_lead_posts_custom_column', 'genesis_lead_custom_column_data', 10, 2 );

/**
 * Register Metabox for Lead details.
 */
function genesis_lead_add_metabox() {
	add_meta_box(
		'genesis_lead_detail_box',
		__( 'Thông Tin Chi Tiết Khách Hàng & Chiến Dịch Ads', 'genesis-theme' ),
		'genesis_lead_metabox_html',
		'genesis_lead',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'genesis_lead_add_metabox' );

/**
 * Output Metabox HTML.
 *
 * @param WP_Post $post Post object.
 */
function genesis_lead_metabox_html( $post ) {
	$phone        = get_post_meta( $post->ID, '_lead_phone', true );
	$pref         = get_post_meta( $post->ID, '_lead_contact_pref', true );
	$interest     = get_post_meta( $post->ID, '_lead_interest', true );
	$form_id      = get_post_meta( $post->ID, '_lead_form_id', true );
	$ip           = get_post_meta( $post->ID, '_lead_ip', true );
	$time         = get_post_meta( $post->ID, '_lead_time', true );
	$page         = get_post_meta( $post->ID, '_lead_page', true );
	$utm_source   = get_post_meta( $post->ID, '_lead_utm_source', true );
	$utm_medium   = get_post_meta( $post->ID, '_lead_utm_medium', true );
	$utm_campaign = get_post_meta( $post->ID, '_lead_utm_campaign', true );
	$utm_content  = get_post_meta( $post->ID, '_lead_utm_content', true );
	$utm_term     = get_post_meta( $post->ID, '_lead_utm_term', true );
	$fbclid       = get_post_meta( $post->ID, '_lead_fbclid', true );
	$gclid        = get_post_meta( $post->ID, '_lead_gclid', true );
	$ttclid       = get_post_meta( $post->ID, '_lead_ttclid', true );
	$is_sample    = get_post_meta( $post->ID, '_lead_is_sample', true );
	?>
	<?php if ( $is_sample ) : ?>
		<div style="background:#fff3cd;color:#856404;border:1px solid #ffeeba;padding:10px 14px;border-radius:4px;margin-bottom:12px;">
			<strong><?php esc_html_e( '💡 Đây là Khách Hàng Tiềm Năng Mẫu (Sample Data)', 'genesis-theme' ); ?></strong>
			— <?php esc_html_e( 'Dữ liệu này được tạo để bạn xem trước cách hệ thống ghi nhận lead từ quảng cáo Facebook, Google và TikTok.', 'genesis-theme' ); ?>
		</div>
	<?php endif; ?>
	<table class="widefat striped" style="margin-top:10px;">
		<tbody>
			<tr>
				<th style="width:220px;"><?php esc_html_e( 'Họ và tên:', 'genesis-theme' ); ?></th>
				<td><strong><?php echo esc_html( $post->post_title ); ?></strong></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Số điện thoại:', 'genesis-theme' ); ?></th>
				<td>
					<a href="tel:<?php echo esc_attr( $phone ); ?>" style="font-size:16px;font-weight:bold;color:#0073aa;">
						<?php echo esc_html( $phone ); ?>
					</a>
					<a href="https://zalo.me/<?php echo esc_attr( preg_replace( '/\D/', '', $phone ) ); ?>" target="_blank" rel="noopener" class="button button-small" style="margin-left:10px;">
						Mở Zalo nhắn tin &rarr;
					</a>
				</td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Ưu tiên liên hệ:', 'genesis-theme' ); ?></th>
				<td><?php echo esc_html( $pref ? $pref : '—' ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Loại căn quan tâm:', 'genesis-theme' ); ?></th>
				<td><?php echo esc_html( $interest ? $interest : '—' ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Vị trí Form đăng ký:', 'genesis-theme' ); ?></th>
				<td><code><?php echo esc_html( $form_id ? $form_id : '—' ); ?></code></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Trang đăng ký (URL):', 'genesis-theme' ); ?></th>
				<td><a href="<?php echo esc_url( $page ); ?>" target="_blank"><?php echo esc_html( $page ? $page : '—' ); ?></a></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Thời gian gửi:', 'genesis-theme' ); ?></th>
				<td><?php echo esc_html( $time ? $time : $post->post_date ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Địa chỉ IP:', 'genesis-theme' ); ?></th>
				<td><code><?php echo esc_html( $ip ? $ip : '—' ); ?></code></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'UTM Source / Medium:', 'genesis-theme' ); ?></th>
				<td><?php echo esc_html( ( $utm_source || $utm_medium ) ? "{$utm_source} / {$utm_medium}" : 'Direct / Trực tiếp' ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'UTM Campaign:', 'genesis-theme' ); ?></th>
				<td><?php echo esc_html( $utm_campaign ? $utm_campaign : '—' ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'UTM Content / Term:', 'genesis-theme' ); ?></th>
				<td><?php echo esc_html( ( $utm_content || $utm_term ) ? "{$utm_content} / {$utm_term}" : '—' ); ?></td>
			</tr>
			<tr>
				<th><?php esc_html_e( 'Click IDs (Ads Tracking):', 'genesis-theme' ); ?></th>
				<td>
					<?php if ( $fbclid ) : ?>
						<div><strong>FBCLID (Facebook):</strong> <code><?php echo esc_html( $fbclid ); ?></code></div>
					<?php endif; ?>
					<?php if ( $gclid ) : ?>
						<div><strong>GCLID (Google):</strong> <code><?php echo esc_html( $gclid ); ?></code></div>
					<?php endif; ?>
					<?php if ( $ttclid ) : ?>
						<div><strong>TTCLID (TikTok):</strong> <code><?php echo esc_html( $ttclid ); ?></code></div>
					<?php endif; ?>
					<?php if ( ! $fbclid && ! $gclid && ! $ttclid ) : ?>
						<em>Không có mã click quảng cáo</em>
					<?php endif; ?>
				</td>
			</tr>
		</tbody>
	</table>
	<?php
}

/**
 * Add Export CSV and Sample Data buttons to the lead list table.
 *
 * @param string $which The position of the tablenav ('top' or 'bottom').
 */
function genesis_lead_add_export_button( $which ) {
	global $typenow;
	if ( 'genesis_lead' === $typenow && 'top' === $which ) {
		$export_url   = admin_url( 'admin-post.php?action=genesis_export_leads&nonce=' . wp_create_nonce( 'genesis_export_leads_nonce' ) );
		$seed_url     = admin_url( 'admin-post.php?action=genesis_seed_leads&nonce=' . wp_create_nonce( 'genesis_seed_leads_nonce' ) );
		$settings_url = admin_url( 'edit.php?post_type=genesis_lead&page=genesis-campaign-settings' );
		?>
		<div class="alignleft actions" style="display:flex;gap:6px;align-items:center;">
			<a href="<?php echo esc_url( $export_url ); ?>" class="button button-primary">
				<span class="dashicons dashicons-download" style="vertical-align:middle;margin-top:-2px;"></span>
				<?php esc_html_e( 'Xuất Lead (CSV / Excel)', 'genesis-theme' ); ?>
			</a>
			<a href="<?php echo esc_url( $settings_url ); ?>" class="button">
				<span class="dashicons dashicons-admin-generic" style="vertical-align:middle;margin-top:-2px;"></span>
				<?php esc_html_e( '⚙️ Cài đặt Ads & Hotline', 'genesis-theme' ); ?>
			</a>
			<a href="<?php echo esc_url( $seed_url ); ?>" class="button" onclick="return confirm('Tạo 4 khách hàng mẫu (Facebook, Google, TikTok Ads) để test?');">
				<span class="dashicons dashicons-database-add" style="vertical-align:middle;margin-top:-2px;"></span>
				<?php esc_html_e( '+ Tạo thêm Lead mẫu', 'genesis-theme' ); ?>
			</a>
		</div>
		<?php
	}
}
add_action( 'manage_posts_extra_tablenav', 'genesis_lead_add_export_button' );

/**
 * Handle CSV Export action.
 */
function genesis_handle_lead_csv_export() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Bạn không có quyền truy cập tính năng này.', 'genesis-theme' ) );
	}

	check_admin_referer( 'genesis_export_leads_nonce', 'nonce' );

	$filename = 'genesis-leads-' . gmdate( 'Y-m-d-His' ) . '.csv';

	header( 'Content-Type: text/csv; charset=utf-8' );
	header( 'Content-Disposition: attachment; filename=' . $filename );
	header( 'Pragma: no-cache' );
	header( 'Expires: 0' );

	// Output UTF-8 BOM so Excel opens Vietnamese characters correctly
	echo "\xEF\xBB\xBF";

	$output = fopen( 'php://output', 'w' );

	// Header row
	fputcsv(
		$output,
		array(
			'ID',
			'Họ và tên',
			'Số điện thoại',
			'Kênh ưu tiên',
			'Loại căn quan tâm',
			'Vị trí Form',
			'Trang đăng ký',
			'Thời gian gửi',
			'IP',
			'UTM Source',
			'UTM Medium',
			'UTM Campaign',
			'UTM Content',
			'UTM Term',
			'FBCLID',
			'GCLID',
			'TTCLID',
		)
	);

	$leads = get_posts(
		array(
			'post_type'      => 'genesis_lead',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC',
		)
	);

	foreach ( $leads as $lead ) {
		$row = array(
			$lead->ID,
			$lead->post_title,
			get_post_meta( $lead->ID, '_lead_phone', true ),
			get_post_meta( $lead->ID, '_lead_contact_pref', true ),
			get_post_meta( $lead->ID, '_lead_interest', true ),
			get_post_meta( $lead->ID, '_lead_form_id', true ),
			get_post_meta( $lead->ID, '_lead_page', true ),
			get_post_meta( $lead->ID, '_lead_time', true ),
			get_post_meta( $lead->ID, '_lead_ip', true ),
			get_post_meta( $lead->ID, '_lead_utm_source', true ),
			get_post_meta( $lead->ID, '_lead_utm_medium', true ),
			get_post_meta( $lead->ID, '_lead_utm_campaign', true ),
			get_post_meta( $lead->ID, '_lead_utm_content', true ),
			get_post_meta( $lead->ID, '_lead_utm_term', true ),
			get_post_meta( $lead->ID, '_lead_fbclid', true ),
			get_post_meta( $lead->ID, '_lead_gclid', true ),
			get_post_meta( $lead->ID, '_lead_ttclid', true ),
		);
		fputcsv( $output, $row );
	}

	fclose( $output );
	exit;
}
add_action( 'admin_post_genesis_export_leads', 'genesis_handle_lead_csv_export' );

/**
 * Seed 4 realistic sample leads representing Facebook, Google, and TikTok Ads.
 */
function genesis_seed_sample_leads_data() {
	$samples = array(
		array(
			'name'         => 'Nguyễn Minh Tuấn',
			'phone'        => '0912345678',
			'contact_pref' => 'Zalo',
			'interest'     => '2PN Basic',
			'form_id'      => 'hero',
			'utm_source'   => 'facebook',
			'utm_medium'   => 'cpc',
			'utm_campaign' => 'fb_ads_genesis_nam_saigon',
			'utm_content'  => 'banner_thap_maris',
			'utm_term'     => 'can_ho_nhat_ban',
			'fbclid'       => 'fb_lead_sample_abc123456',
			'gclid'        => '',
			'ttclid'       => '',
			'ip'           => '14.161.25.80',
			'time'         => gmdate( 'd/m/Y H:i:s', time() - 3600 * 2 ),
		),
		array(
			'name'         => 'Trần Thị Mai Anh',
			'phone'        => '0987654321',
			'contact_pref' => 'Gọi điện',
			'interest'     => 'Studio',
			'form_id'      => 'final',
			'utm_source'   => 'google',
			'utm_medium'   => 'search',
			'utm_campaign' => 'gads_can_ho_nha_be',
			'utm_content'  => 'adgroup_gia_tot',
			'utm_term'     => 'mua căn hộ tt genesis',
			'fbclid'       => '',
			'gclid'        => 'gads_lead_sample_xyz789012',
			'ttclid'       => '',
			'ip'           => '113.160.224.12',
			'time'         => gmdate( 'd/m/Y H:i:s', time() - 3600 * 5 ),
		),
		array(
			'name'         => 'Lê Hoàng Long',
			'phone'        => '0908112233',
			'contact_pref' => 'Zalo',
			'interest'     => '3PN Basic',
			'form_id'      => 'cta_plan_3br-basic',
			'utm_source'   => 'tiktok',
			'utm_medium'   => 'video',
			'utm_campaign' => 'tt_review_nha_mau',
			'utm_content'  => 'video_hoang_hon_song',
			'utm_term'     => '',
			'fbclid'       => '',
			'gclid'        => '',
			'ttclid'       => 'tt_lead_sample_tiktok456',
			'ip'           => '42.112.98.54',
			'time'         => gmdate( 'd/m/Y H:i:s', time() - 3600 * 9 ),
		),
		array(
			'name'         => 'Phạm Thu Hương',
			'phone'        => '0933557799',
			'contact_pref' => 'Zalo',
			'interest'     => '1PN',
			'form_id'      => 'hero',
			'utm_source'   => 'zalo_ads',
			'utm_medium'   => 'cpm',
			'utm_campaign' => 'zalo_form_dot1',
			'utm_content'  => 'chiet_khau_1_phan_tram',
			'utm_term'     => '',
			'fbclid'       => '',
			'gclid'        => '',
			'ttclid'       => '',
			'ip'           => '171.244.18.99',
			'time'         => gmdate( 'd/m/Y H:i:s', time() - 3600 * 18 ),
		),
	);

	foreach ( $samples as $item ) {
		$post_id = wp_insert_post(
			array(
				'post_title'  => $item['name'],
				'post_type'   => 'genesis_lead',
				'post_status' => 'publish',
			)
		);
		if ( ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, '_lead_phone', $item['phone'] );
			update_post_meta( $post_id, '_lead_contact_pref', $item['contact_pref'] );
			update_post_meta( $post_id, '_lead_interest', $item['interest'] );
			update_post_meta( $post_id, '_lead_form_id', $item['form_id'] );
			update_post_meta( $post_id, '_lead_page', home_url() );
			update_post_meta( $post_id, '_lead_time', $item['time'] );
			update_post_meta( $post_id, '_lead_ip', $item['ip'] );
			update_post_meta( $post_id, '_lead_utm_source', $item['utm_source'] );
			update_post_meta( $post_id, '_lead_utm_medium', $item['utm_medium'] );
			update_post_meta( $post_id, '_lead_utm_campaign', $item['utm_campaign'] );
			update_post_meta( $post_id, '_lead_utm_content', $item['utm_content'] );
			update_post_meta( $post_id, '_lead_utm_term', $item['utm_term'] );
			update_post_meta( $post_id, '_lead_fbclid', $item['fbclid'] );
			update_post_meta( $post_id, '_lead_gclid', $item['gclid'] );
			update_post_meta( $post_id, '_lead_ttclid', $item['ttclid'] );
			update_post_meta( $post_id, '_lead_is_sample', '1' );
		}
	}
	update_option( 'genesis_sample_leads_seeded', '1' );
}

/**
 * Handle manual seed leads action.
 */
function genesis_handle_seed_leads_action() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'Bạn không có quyền thực hiện thao tác này.', 'genesis-theme' ) );
	}
	check_admin_referer( 'genesis_seed_leads_nonce', 'nonce' );
	genesis_seed_sample_leads_data();
	wp_safe_redirect( admin_url( 'edit.php?post_type=genesis_lead&genesis_seeded=1' ) );
	exit;
}
add_action( 'admin_post_genesis_seed_leads', 'genesis_handle_seed_leads_action' );

/**
 * Auto-seed sample data on theme switch if none exists.
 */
function genesis_on_theme_activation() {
	$seeded = get_option( 'genesis_sample_leads_seeded' );
	if ( ! $seeded ) {
		genesis_seed_sample_leads_data();
	}
}
add_action( 'after_switch_theme', 'genesis_on_theme_activation' );

/**
 * Register Admin Settings Page: "Cài đặt Ads & Hotline"
 */
function genesis_register_campaign_settings_menu() {
	add_submenu_page(
		'edit.php?post_type=genesis_lead',
		__( 'Cài đặt Chiến dịch Ads TT GENESIS', 'genesis-theme' ),
		__( '⚙️ Cài đặt Ads & Hotline', 'genesis-theme' ),
		'manage_options',
		'genesis-campaign-settings',
		'genesis_render_campaign_settings_page'
	);
}
add_action( 'admin_menu', 'genesis_register_campaign_settings_menu' );

/**
 * Render Quick Campaign Settings Page.
 */
function genesis_render_campaign_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// Handle Save POST
	$saved = false;
	if ( isset( $_POST['genesis_save_campaign'] ) && check_admin_referer( 'genesis_campaign_settings_action', 'genesis_campaign_nonce' ) ) {
		$fields = array(
			'genesis_advisor_name',
			'genesis_phone',
			'genesis_phone_display',
			'genesis_zalo',
			'genesis_email',
			'genesis_company_name',
			'genesis_company_short',
			'genesis_tax_code',
			'genesis_address',
			'genesis_webhook_url',
			'genesis_gtm_id',
			'genesis_gtag_id',
			'genesis_meta_pixel_id',
			'genesis_tiktok_pixel_id',
			'genesis_countdown_deadline',
			'genesis_hero_eyebrow',
			'genesis_hero_price_k',
			'genesis_hero_price_v',
			'genesis_hero_price_u',
			'genesis_hero_pay_k',
			'genesis_hero_pay_v',
			'genesis_hero_pay_u',
		);

		foreach ( $fields as $f ) {
			if ( isset( $_POST[ $f ] ) ) {
				if ( 'genesis_webhook_url' === $f ) {
					set_theme_mod( $f, esc_url_raw( wp_unslash( $_POST[ $f ] ) ) );
				} elseif ( 'genesis_address' === $f ) {
					set_theme_mod( $f, sanitize_textarea_field( wp_unslash( $_POST[ $f ] ) ) );
				} elseif ( 'genesis_email' === $f ) {
					set_theme_mod( $f, sanitize_email( wp_unslash( $_POST[ $f ] ) ) );
				} else {
					set_theme_mod( $f, sanitize_text_field( wp_unslash( $_POST[ $f ] ) ) );
				}
			}
		}
		$saved = true;
	}

	$advisor       = genesis_get_option( 'genesis_advisor_name', 'Phòng Kinh doanh Luna Holdings' );
	$phone         = genesis_get_option( 'genesis_phone', '0938912908' );
	$phone_display = genesis_get_option( 'genesis_phone_display', '0938.912.908' );
	$zalo          = genesis_get_option( 'genesis_zalo', '0938912908' );
	$email         = genesis_get_option( 'genesis_email', 'office@lunaholdingsvn.com' );
	$company       = genesis_get_option( 'genesis_company_name', 'CÔNG TY CP KINH DOANH BẤT ĐỘNG SẢN LUNA HOLDINGS' );
	$company_short = genesis_get_option( 'genesis_company_short', 'Luna Holdings' );
	$tax_code      = genesis_get_option( 'genesis_tax_code', '0318925374' );
	$address       = genesis_get_option( 'genesis_address', '427 Đường Số 1, Phường An Lạc, TP. Hồ Chí Minh, Việt Nam' );
	$webhook_url   = genesis_get_option( 'genesis_webhook_url', '' );
	$gtm_id        = genesis_get_option( 'genesis_gtm_id', '' );
	$gtag_id       = genesis_get_option( 'genesis_gtag_id', '' );
	$meta_pixel    = genesis_get_option( 'genesis_meta_pixel_id', '' );
	$tiktok_pixel  = genesis_get_option( 'genesis_tiktok_pixel_id', '' );
	$deadline      = genesis_get_option( 'genesis_countdown_deadline', '2026-10-06T23:59:59+07:00' );
	$hero_eyebrow  = genesis_get_option( 'genesis_hero_eyebrow', 'Liên doanh Việt Nam · Nhật Bản · Singapore' );
	$price_k       = genesis_get_option( 'genesis_hero_price_k', 'Giá chỉ từ' );
	$price_v       = genesis_get_option( 'genesis_hero_price_v', '69' );
	$price_u       = genesis_get_option( 'genesis_hero_price_u', 'triệu/m²' );
	$pay_k         = genesis_get_option( 'genesis_hero_pay_k', 'Thanh toán cố định · không vay' );
	$pay_v         = genesis_get_option( 'genesis_hero_pay_v', '29' );
	$pay_u         = genesis_get_option( 'genesis_hero_pay_u', 'triệu/tháng' );
	?>
	<div class="wrap" style="max-width:1050px;margin-top:20px;">
		<h1 style="display:flex;align-items:center;gap:10px;">
			<span class="dashicons dashicons-admin-generic" style="font-size:32px;width:32px;height:32px;"></span>
			<?php esc_html_e( 'Cài Đặt Nhanh Chiến Dịch Ads & Hotline (TT GENESIS)', 'genesis-theme' ); ?>
		</h1>
		<p style="font-size:14px;color:#555;margin-bottom:20px;">
			<?php esc_html_e( 'Trang cấu hình dành cho Marketers / Sales. Mọi nội dung hiện tại là Sample Data chuẩn dự án TT GENESIS, bạn chỉ cần sửa lại Hotline, Zalo hoặc mã Pixel của mình là có thể chạy ads được ngay.', 'genesis-theme' ); ?>
		</p>

		<?php if ( $saved ) : ?>
			<div class="notice notice-success is-dismissible" style="padding:10px 14px;font-size:14px;border-left-color:#46b450;">
				<p><strong>✅ <?php esc_html_e( 'Đã lưu cấu hình chiến dịch thành công! Website đã được cập nhật và sẵn sàng chạy ads.', 'genesis-theme' ); ?></strong></p>
			</div>
		<?php endif; ?>

		<form method="post" action="">
			<?php wp_nonce_field( 'genesis_campaign_settings_action', 'genesis_campaign_nonce' ); ?>

			<!-- Khối 1: Thông tin bán hàng & Hotline -->
			<div class="postbox" style="margin-bottom:20px;border-radius:6px;overflow:hidden;">
				<div class="postbox-header" style="background:#253349;color:#fff;padding:12px 18px;">
					<h2 style="color:#fff;margin:0;font-size:16px;">1. 📞 Thông Tin Tư Vấn & Hotline Nhận Khách</h2>
				</div>
				<div class="inside" style="padding:18px;">
					<table class="form-table">
						<tr>
							<th scope="row"><label for="genesis_advisor_name"><?php esc_html_e( 'Tên chuyên viên tư vấn', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_advisor_name" id="genesis_advisor_name" value="<?php echo esc_attr( $advisor ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Hiển thị trên form, avatar và nút Zalo (dùng tên đơn vị tư vấn, ví dụ: Phòng Kinh doanh Luna Holdings. Không dùng tên gợi ý là chủ đầu tư hay phòng kinh doanh của chủ đầu tư).', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_phone"><?php esc_html_e( 'Số điện thoại Hotline', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_phone" id="genesis_phone" value="<?php echo esc_attr( $phone ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Viết liền không dấu cách, dùng để gắn link bấm gọi tel: (ví dụ: 0938912908).', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_phone_display"><?php esc_html_e( 'Số điện thoại hiển thị', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_phone_display" id="genesis_phone_display" value="<?php echo esc_attr( $phone_display ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Dạng chữ hiển thị trên web cho đẹp mắt (ví dụ: 0938.912.908).', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_zalo"><?php esc_html_e( 'Số Zalo tư vấn', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_zalo" id="genesis_zalo" value="<?php echo esc_attr( $zalo ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Khách bấm vào nút Zalo hoặc khi gửi form sẽ mở chat trực tiếp tới số này.', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_email"><?php esc_html_e( 'Email liên hệ', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="email" name="genesis_email" id="genesis_email" value="<?php echo esc_attr( $email ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_company_name"><?php esc_html_e( 'Tên công ty / Đại lý phân phối', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_company_name" id="genesis_company_name" value="<?php echo esc_attr( $company ); ?>" class="large-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_company_short"><?php esc_html_e( 'Tên viết tắt / Thương hiệu', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_company_short" id="genesis_company_short" value="<?php echo esc_attr( $company_short ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_tax_code"><?php esc_html_e( 'Mã số thuế', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_tax_code" id="genesis_tax_code" value="<?php echo esc_attr( $tax_code ); ?>" class="regular-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_address"><?php esc_html_e( 'Địa chỉ văn phòng', 'genesis-theme' ); ?></label></th>
							<td>
								<textarea name="genesis_address" id="genesis_address" rows="2" class="large-text"><?php echo esc_textarea( $address ); ?></textarea>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<!-- Khối 2: Webhook Google Sheets -->
			<div class="postbox" style="margin-bottom:20px;border-radius:6px;overflow:hidden;">
				<div class="postbox-header" style="background:#0f6d38;color:#fff;padding:12px 18px;">
					<h2 style="color:#fff;margin:0;font-size:16px;">2. 📊 Đồng Bộ Lead Về Google Sheets (Webhook)</h2>
				</div>
				<div class="inside" style="padding:18px;">
					<table class="form-table">
						<tr>
							<th scope="row"><label for="genesis_webhook_url"><?php esc_html_e( 'URL Google Apps Script Web App', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="url" name="genesis_webhook_url" id="genesis_webhook_url" value="<?php echo esc_attr( $webhook_url ); ?>" class="large-text" placeholder="https://script.google.com/macros/s/AKfycb.../exec" />
								<p class="description">
									<?php esc_html_e( 'Mỗi khi khách điền form, dữ liệu vừa được lưu vào mục "Khách hàng" ở WP Admin, vừa tự động gửi tới Google Sheet này.', 'genesis-theme' ); ?><br />
									<strong><?php esc_html_e( 'Mẹo:', 'genesis-theme' ); ?></strong> <?php esc_html_e( 'Nếu bạn để trống ô này, khi khách gửi form hệ thống sẽ tự động mở cửa sổ chat Zalo trực tiếp với chuyên viên tư vấn để không làm rơi mất lead.', 'genesis-theme' ); ?>
								</p>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<!-- Khối 3: Mã Tracking Quảng Cáo -->
			<div class="postbox" style="margin-bottom:20px;border-radius:6px;overflow:hidden;">
				<div class="postbox-header" style="background:#1d2433;color:#fff;padding:12px 18px;">
					<h2 style="color:#fff;margin:0;font-size:16px;">3. 🎯 Mã Tracking & Pixels Quảng Cáo (Facebook, TikTok, Google)</h2>
				</div>
				<div class="inside" style="padding:18px;">
					<p class="description" style="margin-bottom:14px;">
						<?php esc_html_e( 'Chỉ cần nhập ID (không cần dán cả đoạn mã script phức tạp), theme sẽ tự động nhúng chuẩn SEO và kích hoạt sự kiện chuyển đổi khi khách điền form.', 'genesis-theme' ); ?>
					</p>
					<table class="form-table">
						<tr>
							<th scope="row"><label for="genesis_meta_pixel_id"><?php esc_html_e( 'Meta (Facebook) Pixel ID', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_meta_pixel_id" id="genesis_meta_pixel_id" value="<?php echo esc_attr( $meta_pixel ); ?>" class="regular-text" placeholder="Ví dụ: 123456789012345" />
								<p class="description"><?php esc_html_e( 'Tự động bắn sự kiện PageView khi vào trang và Lead khi gửi form.', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_tiktok_pixel_id"><?php esc_html_e( 'TikTok Pixel ID', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_tiktok_pixel_id" id="genesis_tiktok_pixel_id" value="<?php echo esc_attr( $tiktok_pixel ); ?>" class="regular-text" placeholder="Ví dụ: C9XXXXXXXXXXXXXXXXX" />
								<p class="description"><?php esc_html_e( 'Tự động bắn sự kiện SubmitForm khi khách điền thông tin.', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_gtag_id"><?php esc_html_e( 'Google Analytics 4 / Google Ads ID', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_gtag_id" id="genesis_gtag_id" value="<?php echo esc_attr( $gtag_id ); ?>" class="regular-text" placeholder="Ví dụ: G-XXXXXXXXXX hoặc AW-XXXXXXXXX" />
								<p class="description"><?php esc_html_e( 'Tự động theo dõi chuyển đổi generate_lead trong Google Analytics.', 'genesis-theme' ); ?></p>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_gtm_id"><?php esc_html_e( 'Google Tag Manager (GTM) ID', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_gtm_id" id="genesis_gtm_id" value="<?php echo esc_attr( $gtm_id ); ?>" class="regular-text" placeholder="Ví dụ: GTM-XXXXXXX" />
							</td>
						</tr>
					</table>
				</div>
			</div>

			<!-- Khối 4: Giá bán & Đếm ngược -->
			<div class="postbox" style="margin-bottom:20px;border-radius:6px;overflow:hidden;">
				<div class="postbox-header" style="background:#a97c50;color:#fff;padding:12px 18px;">
					<h2 style="color:#fff;margin:0;font-size:16px;">4. 🏷️ Giá Bán & Thời Gian Đếm Ngược</h2>
				</div>
				<div class="inside" style="padding:18px;">
					<table class="form-table">
						<tr>
							<th scope="row"><label for="genesis_hero_eyebrow"><?php esc_html_e( 'Dòng giới thiệu nhỏ trên đầu Hero', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_hero_eyebrow" id="genesis_hero_eyebrow" value="<?php echo esc_attr( $hero_eyebrow ); ?>" class="large-text" />
							</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Khối giá bán nổi bật', 'genesis-theme' ); ?></th>
							<td>
								<input type="text" name="genesis_hero_price_k" value="<?php echo esc_attr( $price_k ); ?>" style="width:120px;" placeholder="Giá chỉ từ" />
								<input type="text" name="genesis_hero_price_v" value="<?php echo esc_attr( $price_v ); ?>" style="width:70px;font-weight:bold;" placeholder="69" />
								<input type="text" name="genesis_hero_price_u" value="<?php echo esc_attr( $price_u ); ?>" style="width:100px;" placeholder="triệu/m²" />
							</td>
						</tr>
						<tr>
							<th scope="row"><?php esc_html_e( 'Khối thanh toán nổi bật', 'genesis-theme' ); ?></th>
							<td>
								<input type="text" name="genesis_hero_pay_k" value="<?php echo esc_attr( $pay_k ); ?>" style="width:220px;" placeholder="Thanh toán cố định · không vay" />
								<input type="text" name="genesis_hero_pay_v" value="<?php echo esc_attr( $pay_v ); ?>" style="width:70px;font-weight:bold;" placeholder="29" />
								<input type="text" name="genesis_hero_pay_u" value="<?php echo esc_attr( $pay_u ); ?>" style="width:110px;" placeholder="triệu/tháng" />
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="genesis_countdown_deadline"><?php esc_html_e( 'Thời gian kết thúc đếm ngược', 'genesis-theme' ); ?></label></th>
							<td>
								<input type="text" name="genesis_countdown_deadline" id="genesis_countdown_deadline" value="<?php echo esc_attr( $deadline ); ?>" class="regular-text" />
								<p class="description"><?php esc_html_e( 'Định dạng ISO 8601: YYYY-MM-DDTHH:MM:SS+07:00 (ví dụ: 2026-10-06T23:59:59+07:00).', 'genesis-theme' ); ?></p>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<div style="margin-top:20px;display:flex;gap:12px;align-items:center;">
				<input type="submit" name="genesis_save_campaign" class="button button-primary button-hero" value="<?php esc_attr_e( '💾 Lưu Cài Đặt Chiến Dịch', 'genesis-theme' ); ?>" />
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" target="_blank" class="button button-secondary button-hero">
					<?php esc_html_e( '🚀 Xem Trang Chủ Landing Page →', 'genesis-theme' ); ?>
				</a>
			</div>
		</form>
	</div>
	<?php
}

/**
 * Admin notice for sample leads seeded.
 */
function genesis_sample_leads_admin_notice() {
	if ( isset( $_GET['genesis_seeded'] ) ) {
		?>
		<div class="notice notice-success is-dismissible">
			<p><strong><?php esc_html_e( '✅ Đã tạo thành công 4 khách hàng tiềm năng mẫu (từ kênh Facebook, Google, TikTok Ads) để bạn kiểm tra quản lý Lead & xuất file Excel!', 'genesis-theme' ); ?></strong></p>
		</div>
		<?php
	}
}
add_action( 'admin_notices', 'genesis_sample_leads_admin_notice' );
