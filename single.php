<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<section id="primary" class="content-area">
		<?php
			$postObject = get_post_type_object(get_post_type());
			$galNum = 0;
			if ($postObject) {
				$postTypeTitle = esc_html($postObject->name);
				$postTypeSingularName = esc_html($postObject->labels->singular_name);
				$postTypePluralName = esc_html($postObject->labels->plural_name);
			}
		
			$headerimage = get_field($postTypeTitle.'_placeholder_thumb', 'options');
			$size = 'full';
			echo '<figure class="header-image-box">';
				echo wp_get_attachment_image($headerimage['ID'], $size);
				echo '<div class="main-title-box '.get_field($postTypeTitle.'_colour', 'options').'-bg">';
					
					echo '<h1>'.$postTypeSingularName.'</h1>';
				echo '</div>';
			echo '</figure>';
		?>
		<main id="main" class="single-site-main">
			<article>
				<?php 
					if(get_field('header_image')) {
						echo '<column>';
							$size = 'singleheaderimage';
							$headerimage = get_field('header_image');
							echo '<figure class="content-box content-box-img content-box-width-6" galnum="'.++$galnum.'" galurl="'.$headerimage['url'].'">';
							
							echo wp_get_attachment_image($headerimage['ID'], $size);
							if($headerimage['description'] != '') {
								echo '<figcaption>'.$headerimage['caption'].'</figcaption>';
							}
							echo '</figure>';
						echo '</column>';
					} 
				?>
				<div class="article-con">
					<aside>
						<?php echo '<a href="'.get_field('content_roll_page','options').'/?filter='.$postTypeTitle.'">'.get_field('see_more', 'options').' '.$postTypePluralName.'</a>'; ?>
						<?php
							if(get_field('suggested_time')) {
								echo '<h4>'.get_field('suggested_time_string','options').'</h4>';
								echo '<p>'.get_field('suggested_time').'</p>';
							}
							if(get_field('level_of_difficultu')) {
								echo '<h4>'.get_field('level_of_difficulty_string','options').'</h4>';
								echo '<p>'.get_field('level_of_difficultu').'</p>';
							}
							if(get_field('materials_needed')) {
								echo '<h4>'.get_field('materials_needed_string','options').'</h4>';
								echo '<p>'.get_field('materials_needed').'</p>';
							}
							if(get_field('participants')) {
								echo '<h4>'.get_field('participants_string','options').'</h4>';
								echo '<p>'.get_field('participants').'</p>';
							}
						?>
					</aside>
					<div class="article-content-con">
						<?php /*?><?php echo '<h4 class="posttype">'.$postTypeSingularName.'</h4>'; ?><?php */?>
						<h1 class="column-title"><?php the_title(); ?></h1>
						<?php 
							echo '<h3 class="byline">';
							if(get_field('logged_in_user_as_author') == 1) {
								if(get_field('user')) {
									$user = get_field('user');
									echo $user['display_name'];
								} else {
									echo get_author_name();	
								}
							} else {
								echo get_field('authors');
							}
							if($postTypeTitle != "workshop") {
								echo ' | '.get_the_date('F j, Y').'</h3>'; 
							}
                            echo '</h3>';
						?>
						<?php 
							include('single-content.php'); 
						?>
					</div>
				</div>
				<?php 
					$rposts = get_field('related_content');
					if( $rposts ):
						echo '<column><h3 class="column-title blue-text">'.get_field('related_content_title','options').'</h3>';
							foreach( $rposts as $item ): 
								include('infocard.php'); 
							endforeach;
						echo '</column>';
					endif;
				?>
			</article>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php endwhile; endif; ?>
<?php 
$GLOBALS['galvar'] = $galnum;
get_footer();
