<?php
	$postObject = get_post_type_object(get_post_type($item->ID));
	if ($postObject) {
		$postTypeTitle = esc_html($postObject->labels->singular_name);
		//$posttype = esc_html($postObject->name);
	}

	echo '<div class="content-box content-box-roll content-box-width-2">';
		if(get_field('use_header_as_thumbnail', $item->ID)) {
			$thumbimage = get_field('header_image', $item->ID);

		} else {
			$thumbimage = get_field('thumbnail_image', $item->ID);
		}
		if($thumbimage) {

		}
		echo '<div class="info-card-thumb">';

				echo '<a href="'.get_the_permalink($item->ID).'">'.wp_get_attachment_image($thumbimage['ID'], 'thumbnail').'</a>';

			
		echo '</div>';
		echo '<div class="info-card-details  purple-text"><p>';
			echo $postTypeTitle;
		echo '</p></div>';
		echo '<div class="info-card-title"><h3><a href="'.get_the_permalink($item->ID).'">'.get_the_title($item->ID).'</a></h3></div>';
		if(get_field('excerpt', $item->ID)) {
			echo '<p>'.get_field('excerpt', $item->ID).'</p>';	
		}
		echo '<a class="link-btn purple-text" href="'.get_the_permalink($item->ID).'">'.get_field('read_more', 'options').'</a>';
	echo '</div>';
?>