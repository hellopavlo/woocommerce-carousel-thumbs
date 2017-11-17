<?php
/**
 * Plugin Name: Carousel Slider Thumbs for WooCommerce
 * Plugin URI: https://pavlowp.com/woocommerce-carousel-slider-thumbs
 * Description: Adds carousel slider functionality to WooCommerce single product thumbnails.
 * Version: 1.0.0
 * Author: PavloWP
 * Author URI: https://pavlowp.com
 * Requires at least: 4.4
 * Tested up to: 4.9
 *
 * Text Domain: carousel-thumbs
 * Domain Path: /i18n/languages/
 *
 * @package PWP_Carousel_Thumbs
 * @author PavloWP
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Include the main PWP_Carousel_Thumbs class.
if ( ! class_exists( 'PWP_Carousel_Thumbs' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-carousel-thumbs.php';
}

/**
 * Main instance of PWP_Carousel_Thumbs.
 *
 * Returns the main instance of PWP_Carousel_Thumbs.
 *
 * @since  1.0
 * @return PWP_Carousel_Thumbs
 */
function pwp_carousel_thumbs() {
	// TODO: Add WooCommerce activation check.
	return PWP_Carousel_Thumbs::instance();
}

/**
 * Run the plugin.
 */
pwp_carousel_thumbs();
