<?php

	$blog_info    = get_bloginfo('name');
	$show_title   = ( true === get_theme_mod('display_title_and_tagline', true ));
	$header_class = $show_title ? 'site-title' : 'screen-reader-text';

?>

<div class="site-footer-wrapper">
	<h1 class="<?php echo esc_attr( $header_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $blog_info ); ?></a></h1>
	<div class="copyright">
		&copy; <?php echo esc_html( $blog_info ); ?> 2019
	</div>
</div>
