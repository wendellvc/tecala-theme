<?php

	$blog_info    = get_bloginfo('name');
	$show_title   = ( true === get_theme_mod('display_title_and_tagline', true ));
	$header_class = $show_title ? 'site-title' : 'screen-reader-text';

?>



<div class="container">
	<?php if ( has_nav_menu( 'primary' ) ) : ?>
	<nav id="site-navigation" class="navbar navbar-expand-lg navbar-light bg-light primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'tecala' ); ?>">
	  <div class="container-fluid">
			<div class="site-branding navbar-brand">
				<h1 class="<?php echo esc_attr( $header_class ); ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $blog_info ); ?></a></h1>
			</div><!-- .site-branding -->
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'menu_class'      => 'menu-wrapper navbar-nav me-auto mb-2 mb-lg-0',
					'container_id' 		=> 'navbarSupportedContent',
					'container_class' => 'primary-menu-container collapse navbar-collapse',
					'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
					'fallback_cb'     => false,
				)
			);
			?>
	  </div>
	</nav><!-- #site-navigation -->
<?php endif; ?>
</div>
