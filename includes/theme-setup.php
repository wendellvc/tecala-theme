<?php
/**
 * Theme setup.
 *
 * @package   BedrockBoilerplate\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @copyright MIT
 */

namespace Tecala\Theme;

add_action( 'genesis_setup', __NAMESPACE__ . '\\theme_setup', 15 );
/**
 * Theme Setup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function theme_setup() {

	$theme_support = [
		'genesis-accessibility'       => [
			'404-page',
			'headings',
			'rems',
			'search-form',
		],
		'genesis-footer-widgets'      => 4,
		'genesis-menus'               => [
			'primary' => __( 'Primary Menu', 'tecala' ),
		],
		'genesis-responsive-viewport' => null,
		'genesis-structural-wraps'    => [
			'header',
			'site-inner',
			'footer-widgets',
			'footer',
		],
		'html5'                       => [
			'caption',
			'gallery',
			'search-form',
		],
		/**
		 * Enable features from Soil when plugin is activated
		 *
		 * @link https://roots.io/plugins/soil/
		 */
		'soil-clean-up'               => null,
		'soil-disable-trackbacks'     => null,
		'soil-jquery-cdn'             => null,
		'soil-nav-walker'             => null,
		'soil-nice-search'            => null,
		'soil-relative-urls'          => null,
	];

	array_map( 'add_theme_support', array_keys( $theme_support ), $theme_support );
	add_theme_support( 'custom-header',
		array(
			'header_image' => '',
			'header-selector' => '.site-title a',
			'header-text' => false,
		)
	);

}

add_action( 'init', __NAMESPACE__ . '\\add_image_sizes' );
/**
 * Add theme specific image sizes.
 *
 * @since 0.1.0
 *
 * @return void
 */
function add_image_sizes() {

	$image_sizes = [
		'banner-image' => [ 1280, 800, true ],
	];

	array_walk( $image_sizes, function ( $args, $name ) {
		add_image_size( $name, $args[0], $args[1], isset( $args[2] ) ? $args[2] : false );
	} );

}

function add_additional_class_on_li($classes, $item, $args) {
    // if(isset($args->add_li_class)) {
		// print_r($item);

      $classes[] = 'nav-item';
			// print_r($classes); echo '<br>';
    // }
    return $classes;
}
add_filter('nav_menu_css_class', __NAMESPACE__ . '\\add_additional_class_on_li', 1, 3);

////////////////////////////////////////////////////////
//
// REQUIRED PLUGINS
//
////////////////////////////////////////////////////////

require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

if ( !is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ){
	add_action( 'admin_notices', __NAMESPACE__ . '\\admin_notice_error_acf' );
}

function admin_notice_error_acf() {
	$class = 'notice notice-error';
	$message = __( 'Advanced Custom Fields Pro is MISSING!', 'tecala');
	printf( '<div class="%1$s"><p>%2$s</p></div>', $class, $message );
}
