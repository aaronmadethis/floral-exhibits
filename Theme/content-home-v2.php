<?php
	/* ----- Home Template ----- */
	$args_carousel = array(
		'numberposts'     => 3,
		'orderby'         => 'post_date',
		'post_type'       => 'fe_carousel',
		'post_status'     => 'publish',
		'suppress_filters' => true );
	$carousel_posts = get_posts( $args_carousel );

	$args_pages = array(
		'sort_order' => 'ASC',
		'sort_column' => 'menu_order',
		'exclude' => '36' );
	$all_pages = get_pages( $args_pages );
?>
<section id="home-wrapper">
	<section id="hero-wrapper" class="clear">
		<a class="anchor-link" name="home-link"></a>
		<ul>
			<?php
				foreach ($carousel_posts as $key => $value) {
					$background_id = get_field( "carousel_image", $value->ID );
					$background_obj = wp_get_attachment_image_src( $background_id, 'full');
					$headline = get_field( "carousel_headline", $value->ID ); 
					$subhead = get_field( "carousel_sub_head", $value->ID );
					$anchor_obj = get_field( "carousel_anchor_link", $value->ID );
					$anchor_name = $anchor_obj->post_name;

					echo '<li class="hero-list-item transition-5">';
					echo '<img class="hero-list-image" src="' . $background_obj[0] . '" org_w=' . $background_obj[1] . ' org_h=' . $background_obj[2] . '>';
					echo '<section class="hero-header-container"><h1 class="hero-main-head">' . $headline . '</h1><h2 class="hero-sub-head">' . $subhead . '</h2><a class="hero-link transition-2" href="#' . $anchor_name . '" >Learn More</a></section>';
					echo '</li>';
				}
			?>
		</ul>
		<button class="hero-wrapper-left-arrow transition-2 hidden-element" type="button" title="Move the carousel to the left"></button>
		<button class="hero-wrapper-right-arrow transition-2" type="button" title="Move the carousel to the right"></button>
		<div class="hero-wrapper-breadcrumbs">
			<div class="hero-wrapper-first-crumb"></div>
			<div class="hero-wrapper-crumb"></div>
			<div class="hero-wrapper-last-crumb"></div>
			<div class="hero-wrapper-arrow transition-5"></div>
		</div>
	</section>
	
	<main id="services-wrapper" role="main">
		<a class="anchor-link" name="<?php echo $all_pages[0]->post_name; ?>"></a>
		<h2 class="services-header"><?php echo $all_pages[0]->post_title; ?></h2>
		<div class="services-header-box"></div>
		<?php
			while( has_sub_field('services', $all_pages[0]->ID) ) {
				$headline = get_sub_field('item_headline');
				$body_copy = get_sub_field('item_body_copy');
				$icon_id = get_sub_field('item_icon');
				$icon_obj = wp_get_attachment_image_src( $icon_id, $size='full' );

				echo '<article class="services-article">';
				echo '<img class="services-icon" src="' . $icon_obj[0] . '" org_w=' . $icon_obj[1] . ' org_h=' . $icon_obj[2] . '>';
				echo '<div class="services-info-container">';
				echo '<h3 class="services-article-header">' . $headline . '</h3><p class="services-text">' . $body_copy . '</p>';
				echo '</div>';
				echo '</article>';
			}
		?>
	</main>

	<section id="plant_floral-wrapper">
		<div class="plant_floral-wrapper-wrapper">
			<article id="plant-wrapper">
				<div class="plant_floral-wrapper-cover"></div>
				<?php
					$img_id = get_post_thumbnail_id( $all_pages[1]->ID );
					$img_obj = wp_get_attachment_image_src( $img_id, 'full');
				?>
				<a class="anchor-link" name="<?php echo $all_pages[1]->post_name; ?>"></a>
				<img class="plant_floral-image" src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> />
				<h2 class="plant_floral-header-left"><?php echo $all_pages[1]->post_title; ?></h2>
				<p class="plant_floral-tout-left">READ MORE</p>
				<article class="plant_floral-reveal-wrapper-left transition-2" data-touched="false">
					<h3 class="plant_floral-wrapper-header">Plant Rentals</h3>
					<p class="plant_floral-text"><?php echo $all_pages[1]->post_content; ?></p>
				</article>
			</article>
			<article id="floral-wrapper">
				<div class="plant_floral-wrapper-cover"></div>
				<?php
					$img_id = get_post_thumbnail_id( $all_pages[2]->ID );
					$img_obj = wp_get_attachment_image_src( $img_id, 'full');
				?>
				<a class="anchor-link" name="<?php echo $all_pages[2]->post_name; ?>"></a>
				<img class="plant_floral-image" src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> />
				<h2 class="plant_floral-header-right"><?php echo $all_pages[2]->post_title; ?></h2>
				<p class="plant_floral-tout-right">READ MORE</p>
				<article class="plant_floral-reveal-wrapper-right transition-2" data-touched="false">
					<h3 class="plant_floral-wrapper-header">Floral</h3>
					<p class="plant_floral-text"><?php echo $all_pages[2]->post_content; ?></p>
				</article>
			</article>
			<div class="plant_floral-ampersand"></div>
		</div>
	</section>

	<section id="tradeshow-wrapper">
		<?php
			$img_id = get_post_thumbnail_id( $all_pages[3]->ID );
			$img_obj = wp_get_attachment_image_src( $img_id, 'full');
		?>
		<a class="anchor-link" name="<?php echo $all_pages[3]->post_name; ?>"></a>
		<div class="tradeshow-wrapper-container">
			<article class="tradeshow-wrapper-wrapper">
				<h2 class="tradeshow-header"><?php echo $all_pages[3]->post_title; ?></h2>
				<p class="tradeshow-text"><?php echo $all_pages[3]->post_content; ?></p>
			</article>
			<img class="tradeshow-image" src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> />
		</div>
	</section>

	<section id="event-wrapper">
		<?php
			$img_id = get_post_thumbnail_id( $all_pages[4]->ID );
			$img_obj = wp_get_attachment_image_src( $img_id, 'full');
		?>
		<a class="anchor-link" name="<?php echo $all_pages[4]->post_name; ?>"></a>
		<div class="event-wrapper-container">
			<article class="event-wrapper-wrapper">
				<h2 class="event-header"><?php echo $all_pages[4]->post_title; ?></h2>
				<p class="event-text"><?php echo $all_pages[4]->post_content; ?></p>
			</article>
			<img class="event-image" src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> />
		</div>
	</section>

	<section id="about-wrapper">
		<a class="anchor-link" name="<?php echo $all_pages[5]->post_name; ?>"></a>
		<ul class="about-image-wrapper">
			<?php
				$i = 1;
				while( has_sub_field('about_images', $all_pages[5]->ID) ) {
					if ($i == 9 || $i == 13) {
						$image_id = get_sub_field('grid_image');
						$image_obj = wp_get_attachment_image_src( $image_id, $size='about-grid' );
						echo '<li class="about-image-container"><div class="about-blank-image"></div></li><li class="about-image-container"><div class="about-blank-image"></div></li><li class="about-image-container"><img class="about-image" src="' . $image_obj[0] . '" org_w=' . $image_obj[1] . ' org_h=' . $image_obj[2] . ' /></li>';
					}
					else {
						$image_id = get_sub_field('grid_image');
						$image_obj = wp_get_attachment_image_src( $image_id, $size='about-grid' );
						echo '<li class="about-image-container"><img class="about-image" src="' . $image_obj[0] . '" org_w=' . $image_obj[1] . ' org_h=' . $image_obj[2] . ' /></li>';
					}
					++$i;
				}
			?>
		</ul>
		<article class="about-text-wrapper">
			<h2 class="about-header"><?php echo $all_pages[5]->post_title; ?></h2>
			<p class="about-text"><?php echo $all_pages[5]->post_content; ?></p>
		</article>
	</section>

</section>