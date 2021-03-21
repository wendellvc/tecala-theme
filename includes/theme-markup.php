<?php
/**
 * Theme markup customizations.
 *
 * @package   BedrockBoilerplate\Theme
 * @author    Wendell Cabalhin <cabalhinwendell@gmail.com>
 * @copyright Copyright (c) 2021
 * @copyright MIT
 */

namespace Tecala\Theme;

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

	/* remove default header */
	remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
	remove_action( 'genesis_header', 'genesis_do_header' );
	remove_action( 'genesis_header', 'genesis_header_markup_close', 15 ) ;
	remove_action( 'genesis_after_header', 'genesis_do_nav' );

	/** Reposition footer outside main wrap */
	remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
	remove_action( 'genesis_footer', 'genesis_do_footer' );
	remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 ) ;

	remove_filter( 'body_class', 'genesis_header_body_classes' );

	remove_action( 'genesis_loop', 'genesis_do_loop' );

	/* Remove page titles site wide */
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_post_title', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 10 );

	// Removes div.site-inner's div.wrap
	add_filter( 'genesis_structural_wrap-site-inner', '__return_empty_string' );

	add_filter( 'genesis_edit_post_link', '__return_false' );
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

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

/*
** header opening wrapper
*/
add_action( 'genesis_before_header',  __NAMESPACE__ . '\\custom_output_before_header_wrap', 5 );
function custom_output_before_header_wrap() {
	include locate_template( 'template-parts/header/wrap-open.php' );
}

/*
** site header contents
*/
add_action( 'genesis_header', __NAMESPACE__ . '\\custom_site_header' );
function custom_site_header() {
	include locate_template( 'template-parts/header/site-header.php' );
}

/*
** header closing wrapper
*/
add_action( 'genesis_after_header', __NAMESPACE__ . '\\custom_output_after_header_wrap', 15 );
function custom_output_after_header_wrap() {
	include locate_template( 'template-parts/header/wrap-close.php' );
}


/*
** main content - ACF
*/
add_action( 'genesis_after_loop', 'genesis_do_loop' );



/*
** footer opening wrapper
*/
add_action( 'genesis_footer',  __NAMESPACE__ . '\\custom_output_before_footer_wrap', 5 );
function custom_output_before_footer_wrap() {
	include locate_template( 'template-parts/footer/wrap-open.php' );
}

/*
** site footer contents
*/
add_action( 'genesis_footer', __NAMESPACE__ . '\\custom_site_footer' );
function custom_site_footer() {
	include locate_template( 'template-parts/footer/site-footer.php' );
}

/*
** header closing wrapper
*/
add_action( 'genesis_footer', __NAMESPACE__ . '\\custom_output_after_footer_wrap', 15 );
function custom_output_after_footer_wrap() {
	include locate_template( 'template-parts/footer/wrap-close.php' );
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

if(function_exists('acf_register_block_type')){
	add_action('acf/init',  __NAMESPACE__ . '\\register_acf_block_types');
}

function register_acf_block_types(){

	/*  Hero block*/
	acf_register_block_type(
		array(
			'name' => 'hero',
			'title' => __('Hero'),
			'description' => __('A custom hero block'),
			'render_template' => 'template-parts/blocks/hero.php',
			'icon' => 'editor-paste-text',
			'keywords' => array('hero'),
		)
	);

	/*  Section block*/
	acf_register_block_type(
		array(
			'name' => 'section',
			'title' => __('Section'),
			'description' => __('A custom section block'),
			'render_template' => 'template-parts/blocks/section.php',
			'icon' => 'editor-paste-text',
			'keywords' => array('section', 'services'),
		)
	);

	/*  Boxes block*/
	acf_register_block_type(
		array(
			'name' => 'boxes',
			'title' => __('Boxes'),
			'description' => __('A custom boxes block'),
			'render_template' => 'template-parts/blocks/boxes.php',
			'icon' => 'editor-paste-text',
			'keywords' => array('expertise', 'boxes'),
		)
	);

	/*  CTA Banner block*/
	acf_register_block_type(
		array(
			'name' => 'cta_banner',
			'title' => __('CTA Banner'),
			'description' => __('A custom cta banner block'),
			'render_template' => 'template-parts/blocks/cta-banner.php',
			'icon' => 'editor-paste-text',
			'keywords' => array('banner', 'cta'),
		)
	);
}
