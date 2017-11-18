jQuery( function ( $ ) {

	$('.slider').flexslider({
		selector: '.woocommerce-product-gallery > .woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image',
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: ".thumb-carousel",
		before: function ( slider ) {
			var galleryHeight = slider.container.height(),
				zoomEnabled  = false;

			zoomTarget = slider.container.find( '.woocommerce-product-gallery__image' ).eq( slider.animatingTo );
			slider.container.find('.woocommerce-product-gallery__trigger').css('left', zoomTarget.position().left + 15);

			$( zoomTarget ).each( function( index, target ) {
				var image = $( target ).find( 'img' );

				if ( image.data( 'large_image_height' ) > galleryHeight ) {
					zoomEnabled = true;
					return false;
				}
			} );

			// But only zoom if the img is larger than its container.
			if ( zoomEnabled ) {
				var zoom_options = {
					touch: false
				};

				if ( 'ontouchstart' in window ) {
					zoom_options.on = 'click';
				}

				zoomTarget.trigger( 'zoom.destroy' );
				zoomTarget.zoom( zoom_options );
			}
		}
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

	// Trigger resize after main image loads to ensure correct gallery size.
	$( '.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image:eq(0) .wp-post-image' ).one( 'load', function() {
		var $image = $( this );

		if ( $image ) {
			setTimeout( function() {
				var setHeight = $image.closest( '.woocommerce-product-gallery__image' ).height();
				var $viewport = $image.closest( '.flex-viewport' );

				if ( setHeight && $viewport ) {
					$viewport.height( setHeight );
				}
			}, 100 );
		}
	} ).each( function() {
		if ( this.complete ) {
			$( this ).load();
		}
	});

});