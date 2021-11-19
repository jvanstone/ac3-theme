<?php
/**
 * Astra Child Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package astra-child
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_dequeue_style( 'astra-theme-css' );
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-theme-css' ), CHILD_THEME_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


/**
 *  Add Page title to Updates
 */
function custom_blog_header() {
	if ( is_page( 'Updates' ) ) {
		echo '<h1 class="entry-title astra-blog-header" > Blog </h1>';
	}
}


remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


/**
 *  Add Products to the Top of the Shop
 */
function add_product_category_dropdown() {
	print '<div class="woocommerce-product-tags">';
	the_widget( 'WC_Widget_Product_Categories', 'hierarchical=0' );

	print '</div>';
}
add_action( 'woocommerce_before_shop_loop', 'add_product_category_dropdown' );

/**
 *  Add Products to the Top of the Shop
 *
 *  @param string $format Display the Currency Name.
 *  @param string $currency_pos WooCommerce Set Currency.
 */
function add_price_suffix( $format, $currency_pos ) {
	switch ( $currency_pos ) {
		case 'left':
			$currency = get_woocommerce_currency();
			$format   = '%1$s%2$s&nbsp;' . $currency;
			break;
	}
	return $format;
}

add_action( 'woocommerce_price_format', 'add_price_suffix', 1, 2 );


