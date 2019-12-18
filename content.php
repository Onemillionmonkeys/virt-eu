<?php
	$segmentColour = get_sub_field('segment_colour');
	$secondaryColour = get_sub_field('secondary_colour');
	echo '<column class="'.$segmentColour.'-bg">';
		if(get_sub_field('segment_title')) {
			if(get_sub_field('h1_title')) {
				echo '<h1 class="column-title '.$secondaryColour.'-text">'.get_sub_field('segment_title').'</h1>';
			} else {
				echo '<h3 class="column-title '.$secondaryColour.'-text">'.get_sub_field('segment_title').'</h3>';
			}
		}
		if( have_rows('segment_content') ):
			while ( have_rows('segment_content') ) : the_row();
				if( get_row_layout() == 'text_field' ):
					echo '<div class="content-box content-box-width-'.get_sub_field('width').'">';
						echo get_sub_field('text');
					echo '</div>';
				elseif( get_row_layout() == 'video_embed_field' ): 
					echo '<div class="content-box content-box-video content-box-width-'.get_sub_field('width').'">';
						if(get_sub_field('youtube_id')) {
							/*echo '<iframe src="https://www.youtube.com/embed/'.get_sub_field('youtube_id').'?modestbranding=1&controls=2&showinfo=1&rel=0&fs=1&VQ=HD1080" frameborder="0"></iframe>';*/
							echo '<iframe src="https://www.youtube.com/embed/'.get_sub_field('youtube_id').'?modestbranding=1&showinfo=0&rel=0&fs=1&VQ=HD1080" frameborder="0"></iframe>';
						}
						if(get_sub_field('vimeo_id')) {
							echo '<iframe src="https://player.vimeo.com/video/'.get_sub_field('vimeo_id').'" frameborder="0" allowfullscreen></iframe>';

						}
					echo '</div>';
				elseif( get_row_layout() == 'related_content_field' ):
					echo '<div class="content-box content-box-con content-box-width-'.get_sub_field('width').'">';
						$fposts = get_sub_field('related_content');
						if( $fposts ):
							foreach( $fposts as $item ): 
								include('infocard.php'); 
							endforeach;
						endif;
					echo '</div>';
				elseif( get_row_layout() == 'image_field' ): 
					$image = get_sub_field('image');
					echo '<div class="content-box content-box-img content-box-width-'.get_sub_field('width').'">';
						if(get_sub_field('rounded_corners')) {
							echo '<div class="rounded-box">';
								echo wp_get_attachment_image($image['ID'], 'full');
							echo '</div>';
						} else {
							echo wp_get_attachment_image($image['ID'], 'full');	
						}
						
					echo '</div>';
				elseif( get_row_layout() == 'image_text_&_link_field' ): 
					$image = get_sub_field('image');
					echo '<div class="content-box content-box-img content-box-width-'.get_sub_field('width').'">';
						if(get_sub_field('external_link')) {						
							echo '<div class="rounded-box">';
								echo '<a href="'.get_sub_field('link_url').'" target="_blank">';
									echo wp_get_attachment_image($image['ID'], 'full');
								echo '</a>';
							echo '</div>';
							echo get_sub_field('text');
							echo '<a class="link-btn '.get_sub_field('tertiary_colour').'-text" href="'.get_sub_field('link_url').'" target="_blank">'.get_sub_field('link_text').'</a>';
						} else {
							echo '<div class="rounded-box">';
								echo '<a href="'.get_sub_field('link').''.get_sub_field('link_parameters').'">';
									echo wp_get_attachment_image($image['ID'], 'full');
								echo '</a>';
							echo '</div>';
							echo get_sub_field('text');
							echo '<a class="link-btn '.get_sub_field('tertiary_colour').'-text" href="'.get_sub_field('link').''.get_sub_field('link_parameters').'">'.get_sub_field('link_text').'</a>';
						}
					echo '</div>';
				elseif( get_row_layout() == 'text_links_andor_files_field' ): 
					
					echo '<div class="content-box content-box-img content-box-width-'.get_sub_field('width').'">';
						echo get_sub_field('text');

						if(get_sub_field('external_link')) {
							if(get_sub_field('link_url')) {
								echo '<a class="link-btn '.get_sub_field('tertiary_colour').'-text" href="'.get_sub_field('link_url').'" target="_blank">'.get_sub_field('link_text').'</a>';
							}
						} else {
							if(get_sub_field('link')) {
								echo '<a class="link-btn '.get_sub_field('tertiary_colour').'-text" href="'.get_sub_field('link').'">'.get_sub_field('link_text').'</a>';
							}
						}

						if(get_sub_field('download_file')) {
							echo '<a class="file-btn '.get_sub_field('download_button_colour').'-bg" href="'.get_sub_field('download_file').'" download>'.get_sub_field('download_button_text').'</a>';
						}
						
					echo '</div>';	
				elseif( get_row_layout() == 'profile_field' ): 
					echo '<div class="content-box content-box-profiles content-box-width-'.get_sub_field('width').'">';	
						if( have_rows('profiles') ):
							while ( have_rows('profiles') ) : the_row();
								echo '<div class="profile">';
									echo '<div class="profile-img">';
										$image = get_sub_field('profile_image');
										echo '<a href="'.get_sub_field('link').'">';
											echo wp_get_attachment_image($image['ID'], 'profileimage');
										echo '</a>';
									echo '</div>';
									echo '<div class="profile-detail">';
										echo '<a href="'.get_sub_field('link').'"><span class="name">'.get_sub_field('name').'</span><span>'.get_sub_field('title').'</span></a>';
										
									echo '</div>';
								echo '</div>';
							endwhile;
						endif;
					echo '</div>';
				elseif( get_row_layout() == 'logo_wall_field' ):
					echo '<div class="content-box content-box-logowall content-box-width-'.get_sub_field('width').'">';	
						if( have_rows('logos') ):
							while ( have_rows('logos') ) : the_row();
								echo '<div class="logowall-img">';
									$image = get_sub_field('image');
									echo '<a href="'.get_sub_field('image_link').'">';
										echo wp_get_attachment_image($image['ID'], 'medium');
									echo '</a>';
								echo '</div>';
							endwhile;
						endif;
					echo '</div>';
				endif; // END FLEX
			endwhile;
		endif;
	echo '</column>';
?>