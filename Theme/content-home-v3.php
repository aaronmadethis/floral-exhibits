<?php
	/* ----- Home Template ----- */
	$args_carousel = array(
		'numberposts'     => 3,
		'orderby'         => 'menu_order',
		'order'           => 'ASC',
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
					$background_obj = wp_get_attachment_image_src( $background_id, 'hero-home');
					$headline = get_field( "carousel_headline", $value->ID ); 
					$subhead = get_field( "carousel_sub_head", $value->ID );
					$anchor_obj = get_field( "carousel_anchor_link", $value->ID );
					$anchor_name = $anchor_obj->post_name;

					echo '<li class="hero-list-item transition-10">';
					echo '<img class="hero-list-image" src="' . $background_obj[0] . '" org_w=' . $background_obj[1] . ' org_h=' . $background_obj[2] . '>';
					echo '<section class="hero-header-container"><h1 class="hero-main-head">' . $headline . '</h1><h2 class="hero-sub-head">' . $subhead . '</h2><a class="hero-link transition-2" href="#' . $anchor_name . '" >Learn More</a></section>';
					echo '</li>';
				}
			?>
		</ul>
		<aside class="kehoe-hero-logo" title="Kehoe Designs"></aside>
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

	<a name="plant-rentals"></a>
	<section id="plant_floral-wrapper">
		<div class="plant_floral-wrapper-wrapper">
		<?php
			// ---------------------------------------------------------------------------------------------
			// I COMBINED ALL THE INFOMATION FOR PLANTS, FLORAL AND DECOR INTO A SINGLE WORDPRESS PAGE.
			// HERE IS THE PHP CODE TO PULL THE INFOMATION FROM WORDPRESS. I HAVE TO RUN A LOOP SO LET ME
			// KNOW IF THERE IS A DIFFERENT WAY YOU NEED THIS.
			$tempCount = 0;
			while( has_sub_field('image_and_text', $all_pages[6]->ID) ) {
				//E CHO THESE INSIDE THIS LOOP TO GET THE CONTENT YOU WANT
				$title = get_sub_field('title');

				// THIS IS JUST A URL. WILL NEED TO BE PUT INTO <a> TAG
				// TEXT FOR <a> SHOULD BE "View Products" SEE DESIGN FOR EXAMPLE
				$url = get_sub_field('link'); 

				// ECHO $img_obj[0] TO GET THE IMAGE URL
				// IF YOU NEED IT USE  $img_obj[1] FOR THE WIDTH AND $img_obj[2] FOR THE HEIGHT
				$icon_id = get_sub_field('image');
				$icon_obj = wp_get_attachment_image_src( $icon_id, 'plans-floral-home' );
				
				if ($tempCount == 0) {
					echo '<article id="plant-wrapper">';
				} else if ($tempCount == 1) {
					echo '<article id="floral-wrapper">';
				} else if ($tempCount == 2) {
					echo '<article id="decor-wrapper">';
				}
				++$tempCount;
				echo '<div class="plant_floral-wrapper-cover"></div>';
				echo '<img class="plant_floral-image" src="' . $icon_obj[0] . '" />';
				echo '<a class="hero-link transition-2" href="' . $url . '" title="' . $all_pages[6]->post_name . ' page">VIEW PRODUCTS</a>';
				echo '<h2 class="plant_floral-header">' . $title . '</h2>';
				echo '</article>';
				
			}

			// THE ANCHOR LINK TITLE WOULD BE $all_pages[6]->post_name

		?>
		</div>
	</section>

	<section id="tradeshow-wrapper">
		<?php
			$img_id = get_post_thumbnail_id( $all_pages[3]->ID );
			$img_obj = wp_get_attachment_image_src( $img_id, 'solutions-home');
		?>
		<a class="anchor-link" name="<?php echo $all_pages[3]->post_name; ?>"></a>
		<div class="tradeshow-wrapper-container">
			<article class="tradeshow-wrapper-wrapper">
				<h2 class="tradeshow-header"><?php echo $all_pages[3]->post_title; ?></h2>
				<ul class="tradeshow-list">
					<li class="trade-1 transition-2 trade-active">Overview</li>
					<li class="trade-2 transition-2">Associations</li>
					<li class="trade-3 transition-2">Exhibits</li>
				</ul>
				<article class="tradeshow-text trade-text-active"><?php the_field("overview_text", $all_pages[3]->ID); ?></article>
				<article class="tradeshow-text"><?php the_field("associations_text", $all_pages[3]->ID); ?></article>
				<article class="tradeshow-text"><?php the_field("exhibits_text", $all_pages[3]->ID); ?></article>
				<?php
					/*
					// ---------------------------------------------------------------------------------------------
					// THIS IS THE PHP CODE TO PULL EACH SECTION (OVERVIEW, EXHIBITS, ASSOCIATIONS) OUT OF WORDPRESS
					// THE SECTION TITLES ARE NOT INCLUDED. NO NEED TO ECHO THESE JUST ENCLOSE THEM IN PHP TAGS WHERE
					// YOU NEED THEM.
					
					//OVERVIEW
					the_field( "overview", $all_pages[3]->ID; );

					//EXHIBITS
					the_field( "exhibits", $all_pages[3]->ID; );

					//ASSOCIATIONS
					the_field( "associations", $all_pages[3]->ID; );
					*/
				?>
			</article>
			<img class="tradeshow-image" src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> />
		</div>
	</section>

	<section id="event-wrapper">
		<?php
			$img_id = get_post_thumbnail_id( $all_pages[4]->ID );
			$img_obj = wp_get_attachment_image_src( $img_id, 'solutions-home');
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
						echo '<li class="about-image-container transition-2"><img class="about-image" src="' . $image_obj[0] . '" org_w=' . $image_obj[1] . ' org_h=' . $image_obj[2] . ' /></li>';
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