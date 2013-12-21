<?php
	/* ----- Navigation Template ----- */
	$theme_dir_path = get_stylesheet_directory_uri();
?>
<header id="header-wrapper" class="header-wrapper transition-2">
	<div class="header-wrapper-container">
		<a href="#home-link">
			<section class="logo" title="Floral Exhibits Logo">Floral Exhibits</section>
		</a>
	
		<nav id="primary_nav" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'depth' => 1, 'container' => false, 'before' => '<div class="menu-item-hover"></div>', 'after' => '<span class="menu-link-divider">|</span>' ) ); ?>
	  	</nav>
	</div>
</header>