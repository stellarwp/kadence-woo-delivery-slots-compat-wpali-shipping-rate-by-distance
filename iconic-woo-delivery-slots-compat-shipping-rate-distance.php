<?php
/**
 * Plugin Name:     WooCommerce Delivery Slots by Kadence [WpAli: Shipping Rate by Distance]
 * Plugin URI:      https://iconicwp.com/products/woocommerce-delivery-slots/
 * Description:     Compatibility between WooCommerce Delivery Slots by Kadence and Shipping Rate by distance by Ali Khallad
 * Author:          Kadence WP
 * Author URI:      https://www.kadencewp.com/
 * Text Domain:     iconic-woo-delivery-slots-compat-wpali-srbd
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Iconic_Woo_Delivery_Slots_Compat_WPALI_SRBD
 */

/**
 * Is Shipping Rate by distance plugin active?
 *
 * @return bool
 */
function iconic_compat_srbd_is_active() {
	return defined( 'WPALI_DISTANCESHIPPING_VERSION' );
}

/**
 * Remove default options.
 *
 * @return array
 */
function iconic_compat_srbd_modify_shipping_method_id( $shipping_method_options ) {
	if ( ! iconic_compat_srbd_is_active() ) {
		return $shipping_method_options;
	}

	$new_shipping_method_options = array();
	foreach ( $shipping_method_options as $id => $name ) {
		if ( false !== strpos( $id, 'distance_rate_shipping_method:' ) ) {
			$new_id                                 = str_replace( 'distance_rate_shipping_method:', 'shipping_rate_by_distance:', $id );
			$new_shipping_method_options[ $new_id ] = $name;
		} else {
			$new_shipping_method_options[ $id ] = $name;
		}
	}

	unset( $new_shipping_method_options['distance_rate_shipping_method'] );

	return $new_shipping_method_options;
}

add_filter( 'iconic_wds_shipping_method_options', 'iconic_compat_srbd_modify_shipping_method_id', 10 );
