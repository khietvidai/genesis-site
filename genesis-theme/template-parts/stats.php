<?php
/**
 * Template Part: Stats Section
 *
 * @package Genesis_Theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$stats = array(
	array( 'v' => '1,9 ha', 'l' => __( 'Tổng diện tích khu đất', 'genesis-theme' ) ),
	array( 'v' => '2 tháp', 'l' => __( 'Maris & Lucis · 30 tầng', 'genesis-theme' ) ),
	array( 'v' => '1.438', 'l' => __( 'Sản phẩm cao cấp', 'genesis-theme' ) ),
	array( 'v' => '88', 'l' => __( 'Tiện ích Compound Resort', 'genesis-theme' ) ),
	array( 'v' => 'Q3/2029', 'l' => __( 'Bàn giao dự kiến', 'genesis-theme' ) ),
	array( 'v' => 'Lâu dài', 'l' => __( 'Sổ hồng cho người Việt Nam', 'genesis-theme' ) ),
);
?>

<section class="stats" aria-label="<?php esc_attr_e( 'Tổng quan dự án', 'genesis-theme' ); ?>">
	<div class="wrap stats__grid">
		<?php foreach ( $stats as $s ) : ?>
			<div class="stat">
				<strong><?php echo esc_html( $s['v'] ); ?></strong>
				<span><?php echo esc_html( $s['l'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</section>
