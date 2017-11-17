<?php
/**
 * PWP_Carousel_Thumbs main class
 *
 * @author   PavloWP
 * @package  PWP_Carousel_Thumbs
 * @since    1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main PWP_Carousel_Thumbs Class.
 *
 * @class PWP_Carousel_Thumbs
 * @version	1.0.0
 */
final class PWP_Carousel_Thumbs {

	/**
	 * PWP_Carousel_Thumbs version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * The single instance of the class.
	 *
	 * @var PWP_Carousel_Thumbs
	 * @since 1.0
	 */
	protected static $_instance = null;

	/**
	 * Main PWP_Carousel_Thumbs Instance.
	 *
	 * Ensures only one instance of PWP_Carousel_Thumbs is loaded or can be loaded.
	 *
	 * @since 1.0
	 * @static
	 * @see pwp_carousel_thumbs()
	 * @return PWP_Carousel_Thumbs - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'carousel-thumbs' ), '1.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'carousel-thumbs' ), '1.0' );
	}

	/**
	 * PWP_Carousel_Thumbs Constructor.
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @since 1.0
	 */
	private function hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		add_action( 'woocommerce_loaded', array( $this, 'remove_woocommerce_product_image' ) );
		add_action( 'woocommerce_before_single_product_summary', array( $this, 'show_product_images' ), 20 );

		// Disable WooCommerce native FlexSlider init to avoid conflicts.
		add_filter( 'woocommerce_single_product_flexslider_enabled', '__return_false' );
	}

	/**
	 * Enqueue styles.
	 */
	public function enqueue_styles() {
		wp_register_style( 'flexslider', $this->plugin_url() . '/assets/css/flexslider.css', array(), $this->version );
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// TODO: Add hooks to JS parameters via localize script.
		wp_register_script( 'woocommerce-carousel-thumbs', $this->plugin_url() . '/assets/js/woocommerce-carousel-thumbs' . $suffix . '.js', array( 'jquery', 'flexslider' ), $this->version );
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugin_dir_url( dirname( __FILE__ ) ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( dirname( __FILE__ ) ) );
	}

	/**
	 * Remove WooCommerce product image before displaying own template.
	 */
	public function remove_woocommerce_product_image() {
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
	}

	/**
	 * Output the product image before the single product summary.
	 */
	public function show_product_images() {
		wp_enqueue_style( 'flexslider' );
		wp_enqueue_script( 'woocommerce-carousel-thumbs' );
		include $this->plugin_path() . '/templates/product-images.php';
	}

	/**
	 * Change gallery class to duplicate the gallery without conflicts.
	 *
	 * @param array $classes Array of gallery classes.
	 *
	 * @return array
	 */
	public function change_gallery_class( $classes ) {
		$key = array_search( 'woocommerce-product-gallery', $classes );
		if ( is_numeric( $key ) ) {
			$classes[ $key ] = 'woocommerce-product-gallery-thumbs';
		}
		return $classes;
	}
}
