<?php
/**
 * Theme scripts and styles.
 *
 * @package   Boilerplate\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @copyright MIT
 */

namespace Boilerplate\Theme;

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
	wp_register_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,700', [], CHILD_THEME_VERSION );
	wp_enqueue_style( 'boilerplate', asset( 'css/style.css' ), [
		'normalize',
		'google-fonts',
	], CHILD_THEME_VERSION );

	wp_enqueue_script( 'boilerplate', asset( 'js/boilerplate.js' ), [], CHILD_THEME_VERSION, true );

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
