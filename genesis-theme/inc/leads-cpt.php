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
				echo '<span style="display:inline-block;padding:2px 8px;border-radius:4px;background:#0068ff;color:#fff;font-size:12px;">Zalo</span>';
			} elseif ( $pref ) {
				echo '<span style="display:inline-block;padding:2px 8px;border-radius:4px;background:#2d5a3d;color:#fff;font-size:12px;">' . esc_html( $pref ) . '</span>';
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
		__( 'Thông Tin Chi Tiết Khách Hàng & Chiến Dịch', 'genesis-theme' ),
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
	?>
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
						<div><strong>FBCLID:</strong> <code><?php echo esc_html( $fbclid ); ?></code></div>
					<?php endif; ?>
					<?php if ( $gclid ) : ?>
						<div><strong>GCLID:</strong> <code><?php echo esc_html( $gclid ); ?></code></div>
					<?php endif; ?>
					<?php if ( $ttclid ) : ?>
						<div><strong>TTCLID:</strong> <code><?php echo esc_html( $ttclid ); ?></code></div>
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
 * Add Export CSV button to the lead list table.
 *
 * @param string $which The position of the tablenav ('top' or 'bottom').
 */
function genesis_lead_add_export_button( $which ) {
	global $typenow;
	if ( 'genesis_lead' === $typenow && 'top' === $which ) {
		$export_url = admin_url( 'admin-post.php?action=genesis_export_leads&nonce=' . wp_create_nonce( 'genesis_export_leads_nonce' ) );
		?>
		<div class="alignleft actions">
			<a href="<?php echo esc_url( $export_url ); ?>" class="button button-primary">
				<span class="dashicons dashicons-download" style="vertical-align:middle;margin-top:-2px;"></span>
				<?php esc_html_e( 'Xuất danh sách Lead (CSV / Excel)', 'genesis-theme' ); ?>
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
