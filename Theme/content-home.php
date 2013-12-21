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
<div id="home-wrapper">
	<div id="hero-wrapper">
		<ul>
			<?php
				foreach ($carousel_posts as $key => $value) {
					$background_id = get_field( "carousel_image", $value->ID );
					$background_obj = wp_get_attachment_image_src( $background_id, 'full');
					$headline = get_field( "carousel_headline", $value->ID ); 
					$subhead = get_field( "carousel_sub_head", $value->ID );
					$anchor_obj = get_field( "carousel_anchor_link", $value->ID );
					$anchor_name = $anchor_obj->post_name;

					echo '<li>';
					echo '<div><img src="' . $background_obj[0] . '" org_w=' . $background_obj[1] . ' org_h=' . $background_obj[2] . '></div>';
					echo '<div><h1>' . $headline . '</h1><h2>' . $subhead . '</h2><a href="#' . $anchor_name . '" >Learn More</a></div>';
					echo '</li>';
				}
			?>
		<ul>
	</div>
	
	<div id="services-wrapper">
		<a name="<?php echo $all_pages[0]->post_name; ?>"></a>
		<div class="title"><?php echo $all_pages[0]->post_title; ?></div>
		<?php
			while( has_sub_field('services', $all_pages[0]->ID) ) {
				$headline = get_sub_field('item_headline');
				$body_copy = get_sub_field('item_body_copy');
				$icon_id = get_sub_field('item_icon');
				$icon_obj = wp_get_attachment_image_src( $icon_id, $size='full' );

				echo '<div>';
				echo '<img src="' . $icon_obj[0] . '" org_w=' . $icon_obj[1] . ' org_h=' . $icon_obj[2] . '>';
				echo '<h3>' . $headline . '</h3><p>' . $body_copy . '</p>';
				echo '</div>';
			}
		?>
	</div>

	<div id="plant_floral-wrapper">
		<div id="plant-wrapper">
			<?php
				$img_id = get_post_thumbnail_id( $all_pages[1]->ID );
				$img_obj = wp_get_attachment_image_src( $img_id, 'full');
			?>
			<a name="<?php echo $all_pages[1]->post_name; ?>"></a>
			<div class="title"><?php echo $all_pages[1]->post_title; ?></div>
			<p><?php echo $all_pages[1]->post_content; ?></p>
			<img src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> >
		</div>
		<div id="floral-wrapper">
			<?php
				$img_id = get_post_thumbnail_id( $all_pages[2]->ID );
				$img_obj = wp_get_attachment_image_src( $img_id, 'full');
			?>
			<a name="<?php echo $all_pages[2]->post_name; ?>"></a>
			<div class="title"><?php echo $all_pages[2]->post_title; ?></div>
			<p><?php echo $all_pages[2]->post_content; ?></p>
			<img src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> >
		</div>
	</div>

	<div id="tradeshow-wrapper">
		<?php
			$img_id = get_post_thumbnail_id( $all_pages[3]->ID );
			$img_obj = wp_get_attachment_image_src( $img_id, 'full');
		?>
		<a name="<?php echo $all_pages[3]->post_name; ?>"></a>
		<div class="title"><?php echo $all_pages[3]->post_title; ?></div>
		<p><?php echo $all_pages[3]->post_content; ?></p>
		<img src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> >
	</div>

	<div id="event-wrapper">
		<?php
			$img_id = get_post_thumbnail_id( $all_pages[4]->ID );
			$img_obj = wp_get_attachment_image_src( $img_id, 'full');
		?>
		<a name="<?php echo $all_pages[4]->post_name; ?>"></a>
		<div class="title"><?php echo $all_pages[4]->post_title; ?></div>
		<p><?php echo $all_pages[4]->post_content; ?></p>
		<img src="<?php echo $img_obj[0]; ?>" org_w=<?php echo $img_obj[1]; ?> org_h=<?php echo $img_obj[2]; ?> >
	</div>

	<div id="about-wrapper">
		<a name="<?php echo $all_pages[5]->post_name; ?>"></a>
		<div class="title"><?php echo $all_pages[5]->post_title; ?></div>
		<p><?php echo $all_pages[5]->post_content; ?></p>
		<ul id="about-images">
			<?php
				while( has_sub_field('about_images', $all_pages[5]->ID) ) {
					$image_id = get_sub_field('grid_image');
					$image_obj = wp_get_attachment_image_src( $image_id, $size='about-grid' );
					echo '<li><img src="' . $icon_obj[0] . '" org_w=' . $icon_obj[1] . ' org_h=' . $icon_obj[2] . '></li>';
				}
			?>
		</ul>
	</div>

</div>