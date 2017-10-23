<?php
/**
 * Infinity Pro.
 *
 * This file adds the required CSS to the front end to the Infinity Pro Theme.
 *
 * @package Infinity
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/infinity/
 */

add_action( 'wp_enqueue_scripts', 'infinity_css' );
/**
* Checks the settings for the link color color, accent color, and header
* If any of these value are set the appropriate CSS is output
*
* @since 1.0.0
*/
function infinity_css() {

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	$color_accent = get_theme_mod( 'infinity_accent_color', infinity_customizer_get_default_accent_color() );

	$opts = apply_filters( 'infinity_images', array( '1', '3', '5', '7' ) );

	$settings = array();

	foreach( $opts as $opt ) {
		$settings[$opt]['image'] = preg_replace( '/^https?:/', '', get_option( $opt .'-infinity-image', sprintf( '%s/images/bg-%s.jpg', get_stylesheet_directory_uri(), $opt ) ) );
	}

	$css = '';
	$woo_css = '';

	foreach ( $settings as $section => $value ) {

		$background = $value['image'] ? sprintf( 'background-image: url(%s);', $value['image'] ) : '';

		if ( is_front_page() ) {
			$css .= ( ! empty( $section ) && ! empty( $background ) ) ? sprintf( '.front-page-%s { %s }', $section, $background ) : '';
		}

	}

	$css .= ( infinity_customizer_get_default_accent_color() !== $color_accent ) ? sprintf( '

		a,
		.entry-title a:focus,
		.entry-title a:hover,
		.featured-content .entry-meta a:hover,
		.featured-content .entry-meta a:focus,
		.front-page .genesis-nav-menu a:hover,
		.front-page .genesis-nav-menu a:focus,
		.front-page .offscreen-content-icon button:hover,
		.front-page .offscreen-content-icon button:focus,
		.front-page .white .genesis-nav-menu a:hover,
		.front-page .white .genesis-nav-menu a:focus,
		.genesis-nav-menu a:focus,
		.genesis-nav-menu a:hover,
		.genesis-nav-menu .current-menu-item > a,
		.genesis-nav-menu .sub-menu .current-menu-item > a:focus,
		.genesis-nav-menu .sub-menu .current-menu-item > a:hover,
		.js nav button:focus,
		.js .menu-toggle:focus,
		.offscreen-content button:hover,
		.offscreen-content-icon button:hover,
		.site-footer a:hover,
		.site-footer a:focus {
			color: %1$s;
		}

		button,
		input[type="button"],
		input[type="reset"],
		input[type="select"],
		input[type="submit"],
		.button,
		.enews-widget input:hover[type="submit"],
		.footer-widgets .button:hover {
			background-color: %1$s;
		}

		', $color_accent ) : '';
		
	$woo_css .= ( infinity_customizer_get_default_accent_color() !== $color_accent ) ? sprintf( '

		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce .woocommerce-breadcrumb a:focus,
		.woocommerce-info:before,
		.woocommerce-message:before {
			color: %1$s;
		}

		.woocommerce a.button:hover,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button:hover,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button:hover,
		.woocommerce input.button.alt:hover,
		.woocommerce #respond input#submit:hover,
		.woocommerce #respond input#submit.alt:hover,
		.woocommerce input:hover[type="submit"] {
			background-color: %1$s;
		}

		.woocommerce-error,
		.woocommerce-info,
		.woocommerce-message {
			border-top-color: %1$s;
		}

		', $color_accent ) : '';

	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}
	
	if ( $woo_css ) {
		wp_add_inline_style( 'infinity-woocommerce-styles', $woo_css );
	}

}
