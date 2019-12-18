<?php
if( have_rows('content_boxes') ):
    while ( have_rows('content_boxes') ) : the_row();
		if( get_row_layout() == 'text_field' ):
			if(get_sub_field('background_colour')) {
			echo '<column class="'.get_sub_field('background_colour').'-bg">';	
			} else {
			echo '<column>';	
			}
            
				echo get_sub_field('text_content');
            echo '</column>';
        elseif( get_row_layout() == 'workshop_steps_field' ): 
            echo '<column>';
				if( have_rows('workshop_step') ):
					$stepNum = 0;
					while ( have_rows('workshop_step') ) : the_row();
						echo '<h3>'.++$stepNum.'</h3>';
						echo get_sub_field('step_description');

					endwhile;
				endif;
			echo '</column>';
		elseif( get_row_layout() == 'youtube_embed_field' ): 
			echo '<column>';
				echo '<iframe src="https://www.youtube.com/embed/'.get_sub_field('youtube_id').'?modestbranding=1&controls=2&showinfo=0&rel=0&fs=1&VQ=HD720" frameborder="0" allowfullscreen></iframe>';
			echo '</column>';
		elseif( get_row_layout() == 'external_tool_list_field' ): 
			echo '<column>';
				if( have_rows('external_tool') ):
					while ( have_rows('external_tool') ) : the_row();
						echo '<p><a href="'.get_sub_field('link').'" target="_blank">'.get_sub_field('name_of_tool').'</a> <em>by '.get_sub_field('author').'</em></p>';
					endwhile;
				endif;
			echo '</column>';
        endif;

    // End loop.
    endwhile;
endif;
?>