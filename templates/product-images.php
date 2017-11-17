<?php
/**
 * Single Product Images
 *
 * @author  PavloWP
 * @package PWP_Carousel_Thumbs
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} ?>

<div class="cthbs-product-gallery-container" style="float: left; width: 48%;">
	<div class="slider flexslider">
		<?php woocommerce_show_product_images(); ?>
	</div>
	<?php add_filter( 'woocommerce_single_product_image_gallery_classes', array( pwp_carousel_thumbs(), 'change_gallery_class' ) ); ?>
	<div class="thumb-carousel flexslider">
		<?php woocommerce_show_product_images(); ?>
	</div>
	<?php remove_filter( 'woocommerce_single_product_image_gallery_classes', array( pwp_carousel_thumbs(), 'change_gallery_class' ) ); ?>
</div>
