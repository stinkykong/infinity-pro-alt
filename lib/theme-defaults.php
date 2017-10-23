<?php
/**
 * Infinity Pro.
 *
 * This file adds the default theme settings to the Infinity Pro Theme.
 *
 * @package Infinity
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/infinity/
 */

//* Infinity Theme Setting Defaults
add_filter( 'genesis_theme_settings_defaults', 'infinity_theme_defaults' );
function infinity_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 8;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'full-width-content';

	return $defaults;

}

//* Infinity Theme Setup
add_action( 'after_switch_theme', 'infinity_theme_setting_defaults' );
function infinity_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 8,	
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 0,
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'full-width-content',
		) );
		
	} 

	update_option( 'posts_per_page', 8 );

}

//* Simple Social Icon Defaults
add_filter( 'simple_social_default_styles', 'infinity_social_default_styles' );
function infinity_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'alignleft',
		'background_color'       => '#f5f5f5',
		'background_color_hover' => '#000000',
		'border_color'           => '#ffffff',
		'border_color_hover'     => '#ffffff',
		'border_radius'          => 3,
		'border_width'           => 0,
		'icon_color'             => '#000000',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 36,
		);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}

//* Define WooCommerce Image Sizes
add_action( 'after_switch_theme', 'infinity_woocommerce_image_dimensions', 1 );
function infinity_woocommerce_image_dimensions() {

	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}

  	$catalog = array(
		'width' 	=> '300',	// px
		'height'	=> '300',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);
	$thumbnail = array(
		'width' 	=> '180',	// px
		'height'	=> '180',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 	    // Product category thumbs
	update_option( 'shop_single_image_size', $single );         // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs

}
