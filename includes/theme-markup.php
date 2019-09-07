<?php
/**
 * Theme markup customizations.
 *
 * @package   Boilerplate\Theme
 * @author    Craig Simpson <craig.simpson@intimation.uk>
 * @copyright Copyright (c) 2019, Intimation Creative
 * @copyright MIT
 */

namespace Boilerplate\Theme;

add_action( 'genesis_setup', __NAMESPACE__ . '\\theme_markup', 20 );
/**
 * Global page setup.
 *
 * @since 0.1.0
 *
 * @return void
 */
function theme_markup() {

	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	add_filter( 'genesis_edit_post_link', '__return_false' );

	remove_action( 'genesis_doctype', 'genesis_do_doctype' );
	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
	remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

	remove_filter( 'body_class', 'genesis_header_body_classes' );

}

add_action( 'genesis_doctype', __NAMESPACE__ . '\\boilerplate_do_doctype' );
/**
 * Add no-js class to html tag, and immediately remove it with JS.
 *
 * @link http://www.paulirish.com/2009/avoiding-the-fouc-v3/
 *
 * @since  0.1.0
 *
 * @return void
 */
function boilerplate_do_doctype() {
	include locate_template( 'template-parts/doctype.php' );
}

add_filter( 'wp_get_attachment_image_attributes', __NAMESPACE__ . '\\boilerplate_lazy_load_images' );
/**
 * Filter in the new loading attribute on images.
 *
 * @param array $attributes Existing image attributes.
 *
 * @return array
 */
function boilerplate_lazy_load_images( $attributes ) {
	return array_merge( $attributes, [
		'loading' => 'lazy'
	] );
}
