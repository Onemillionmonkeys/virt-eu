<?php
if( have_rows('content_fields') ):
	while ( have_rows('content_fields') ) : the_row();
		if( get_row_layout() == 'text_field' ):
            echo '<div class="content-box">';
				if(get_sub_field('inline_image')) {
					$image = get_sub_field('inline_image');
					echo '<figure class="inline-img-box '.get_sub_field('inline_image_position').' inline-img-width-'.get_sub_field('inline_image_size').'" galnum="'.++$galnum.'" galurl="'.$image['url'].'">';
						echo wp_get_attachment_image($image['ID'], 'full');
						if($image['description'] != '' || $image['caption'] != '') {
							echo '<figcaption>';
								if($image['description'] != '') { echo $image['description']; }
								if($image['caption'] != '') { echo ' <em>'.$image['caption'].'</em>'; }
							echo '</figcaption>';
						}
					echo '</figure>';
				}
				echo get_sub_field('text');
				if(get_sub_field('link_url') || get_sub_field('page_link') || get_sub_field('download_file')) {
					echo '<div class="content-links">';
						if(get_sub_field('link_url') || get_sub_field('page_link')) {
							if(get_sub_field('external_link') && get_sub_field('link_url')) {
								
								echo '<a class="link-btn '.get_sub_field('tertiary_colour').'-text" href="'.get_sub_field('link_url').'" target="_blank">'.get_sub_field('link_text').'</a>';
							} elseif(get_sub_field('link')) {
								echo '<a class="link-btn '.get_sub_field('tertiary_colour').'-text" href="'.get_sub_field('link').''.get_sub_field('link_parameters').'">'.get_sub_field('link_text').'</a>';
							}
						}
						if(get_sub_field('download_file')) {
							echo '<a class="file-btn '.get_sub_field('download_colour').'-bg" href="'.get_sub_field('download_file').'" download>'.get_sub_field('download_button_text').'</a>';
						}
					echo '</div>';
				}
			echo '</div>';
        elseif( get_row_layout() == 'quote_field' ):
			echo '<div class="content-box content-quote-box">';
				echo '<blockquote>'.get_sub_field('quote').'</blockquote><p><span>'.get_sub_field('quotee').'</span></p>';
			echo '</div>';
		elseif( get_row_layout() == 'video_embed_field' ): 
			echo '<div class="content-box content-box-video">';
				if(get_sub_field('youtube_id')) {
					echo '<iframe src="https://www.youtube.com/embed/'.get_sub_field('youtube_id').'?modestbranding=1&showinfo=0&rel=0&fs=1&VQ=HD1080" frameborder="0"></iframe>';
				}
				if(get_sub_field('vimeo_id')) {
					echo '<iframe src="https://player.vimeo.com/video/'.get_sub_field('vimeo_id').'" frameborder="0" allowfullscreen></iframe>';
					
				}
			echo '</div>';
		elseif( get_row_layout() == 'image_field' ): 
			$image = get_sub_field('image');
			echo '<figure class="content-box content-box-img" galnum="'.++$galnum.'" galurl="'.$image['url'].'">';
				echo wp_get_attachment_image($image['ID'], 'full');
				if($image['description'] != '' || $image['caption'] != '') {
					echo '<figcaption>';
					if($image['description'] != '') { echo $image['description']; }
					if($image['caption'] != '') { echo ' <em>'.$image['caption'].'</em>'; }
					echo '</figcaption>';
				}
			echo '</figure>';
		elseif( get_row_layout() == 'workshop_steps_field' ):
			echo '<div class="content-box content-box-workshop">';
				if( have_rows('workshop_step') ):
					$stepNum = 0;
					while ( have_rows('workshop_step') ) : the_row();
						echo '<div class="workshop-step">';
							echo '<div class="step-num">';
								$stepNum++;
								if($stepnum < 10) {
									echo '0'.$stepNum;	
								} else {
									echo $stepNum;
								}
							echo '</div>';
							echo '<div class="step-content">';
								echo get_sub_field('workshop_step');
							echo '</div>';
						echo '</div>';
					endwhile;
				endif;
			echo '</div>';
		elseif( get_row_layout() == 'reference_field' ):
			echo '<div class="content-box content-box-reference">';
				if(get_sub_field('reference_title')) {
					echo '<h3>'.get_sub_field('reference_title').'</h3>';
				}
				if( have_rows('reference') ):
					while ( have_rows('reference') ) : the_row();
						echo '<div class="reference-step">';
							echo '<div class="reference-num">';
								echo '<a href="#_fnr'.get_sub_field('reference_id').'" name="_fn'.get_sub_field('reference_id').'">('.get_sub_field('reference_id').')</a>';
							echo '</div>';
							echo '<div class="reference-content">';
								echo get_sub_field('reference_text');
							echo '</div>';
						echo '</div>';
					endwhile;
				endif;
			echo '</div>';
        endif;

	endwhile;
endif;
?>