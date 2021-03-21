<?php
/**
 * Theme scripts and styles.
 *
 * @package   BedrockBoilerplate\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @copyright MIT
 */

namespace Tecala\Theme;

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );
/**
 * Skeleton scripts and styles.
 *
 * @since 0.1.0
 *
 * @return void
 */
function enqueue_scripts() {

	wp_register_style( 'normalize', asset( 'css/normalize.css' ), false, '8.0.0' );
	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;600&display=swap', [], CHILD_THEME_VERSION );
	wp_register_style( 'bootstrap-css', asset('vendor/bootstrap/css/bootstrap.min.css'), [], CHILD_THEME_VERSION );
	wp_register_style( 'fontawesome-css', asset('vendor/fontawesome/css/fontawesome.min.css'), [], CHILD_THEME_VERSION );
	wp_register_style( 'fontawesome-solid-css', asset('vendor/fontawesome/css/solid.min.css'), [], CHILD_THEME_VERSION );
	wp_enqueue_style( 'tecala', asset( 'css/style.css' ), [
		'normalize',
		'google-fonts',
		'bootstrap-css',
		'fontawesome-css',
		'fontawesome-solid-css'
	], CHILD_THEME_VERSION );

	wp_enqueue_script( 'bootstrap-js', asset('vendor/bootstrap/js/bootstrap.min.js'), [], CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'fontawesome-js', asset('vendor/fontawesome/js/fontawesome.min.js'), [], CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'fontawesome-solid-js', asset('vendor/fontawesome/js/solid.min.js'), [], CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'tecala', asset( 'js/global.js' ), [], CHILD_THEME_VERSION, true );

}

if ( ! function_exists( 'asset' ) ) {
	/**
	 * Return a hashed asset name if it exists.
	 *
	 * @param string $path Relative path to asset.
	 *
	 * @return string
	 */
	function asset( $path ) {
		static $manifest = null;

		if ( null === $manifest ) {
			$manifest_path = get_stylesheet_directory() . '/assets/assets.json';
			$manifest      = file_exists( $manifest_path ) ? json_decode( file_get_contents( $manifest_path ), true ) : [];
		}

		if ( array_key_exists( $path, $manifest ) ) {
			return esc_url( get_stylesheet_directory_uri() . '/assets/' . $manifest[ $path ] );
		}

		return esc_url( get_stylesheet_directory_uri() . '/assets/' . $path );
	}
}
