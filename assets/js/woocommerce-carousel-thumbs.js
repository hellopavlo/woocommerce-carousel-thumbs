jQuery( function ( $ ) {
	$('.slider').flexslider({
		selector: '.woocommerce-product-gallery > .woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image',
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: ".thumb-carousel"
	});

	$('.thumb-carousel').flexslider({
		selector: '.woocommerce-product-gallery-thumbs > .woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image',
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 185,
		itemMargin: 5,
		asNavFor: '.slider',
		start: function() {
			$('.woocommerce-product-gallery-thumbs').css( 'opacity', 1 );
		}
	});
});