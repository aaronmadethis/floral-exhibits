<?php
get_header();
get_template_part( 'nav' );
?>
<section id="page-wrapper">
	<?php global $post; ?>

	<?php if( is_home() || is_front_page() ) : ?>
		<?php get_template_part( 'content', 'home-v3' ); ?>
	<?php endif; /*is_home*/ ?>
	
	<?php get_footer(); ?>
</section><!-- end of page-wrapper -->