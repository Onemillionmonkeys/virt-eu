<?php 
/*
* Template Name: Content Roll
*/

get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<section id="primary" class="content-area">
		<?php
			$thisURL = get_the_permalink();
			$secondaryColour = get_field('header_colour');
			if(get_field('header_image')) {
				$headerimage = get_field('header_image');
				$size = 'full';
				echo '<div class="header-image-box">';
					echo wp_get_attachment_image($headerimage['ID'], $size);
					echo '<div class="main-title-box '.$secondaryColour.'-bg">';
						echo '<h1>'.get_the_title().'</h1>';
					echo '</div>';
				echo '</div>';
			}
		?>
		<main id="main" class="site-main">
			<article>
				<?php
					if($_GET['filter'] && $_GET['filter'] != 'all') {
						$posttypes = array($_GET['filter']);
						$urlVar = $_GET['filter'];
						 
					} else {
						$posttypes = array('workshop','story','ethical-review');
						$urlVar = 'all';
					}
					
					$itemNumArgs = array(
						'post_type' => $posttypes,
						'posts_per_page' => -1,	
					);
				
					$itemNum = count(get_posts($itemNumArgs));
					
					if($_GET['pg']) {
						$pageNum = $_GET['pg'];
					} else {
						$pageNum = 0;
					}
					$postsPerPage = intval(get_field('number_of_posts_per_page_roll', 'options'));
					$offset = $pageNum * $postsPerPage;
				?>
				<?php 
					if(get_field('description')) { 
						echo '<column>';
							echo '<div class="content-box content-box-width-5">';
								echo get_field('description');
							echo '</div>';
						echo '</column>';
					} 
					
					echo '<column class="filter-column '.$secondaryColour.'-bg">';
						echo '<div class="filter-topic"><p>';
							echo '<strong>'.get_field('filter_methods','options').'</strong>';
							if($posttypes == 'story') {
								echo '<a class="selected" href="'.$thisURL.'?filter=story&pg=0">stories</a>';
							} else {
								echo '<a href="'.$thisURL.'?filter=story&pg=0">stories</a>';	
							}
							if($posttypes == 'workshop') {
								echo '<a class="selected" href="'.$thisURL.'?filter=workshop&pg=0">workshops</a>';
							} else {
								echo '<a href="'.$thisURL.'?filter=workshop&pg=0">workshops</a>';	
							}
							if($posttypes == 'ethical-review') {
								echo '<a class="selected" href="'.$thisURL.'?filter=ethical-review&pg=0">ethical reviews</a>';	
							} else {
								echo '<a href="'.$thisURL.'?filter=ethical-review&pg=0">ethical reviews</a>';	
							}
							if(count($posttypes) > 1) {
								echo '<a class="selected" href="'.$thisURL.'?filter=all&pg=0">'.get_field('all_posts','options').'</a>';
							} else {
								echo '<a href="'.$thisURL.'?filter=all&pg=0">'.get_field('all_posts','options').'</a>';	
							}
							
						echo '</p></div>';
						if($itemNum > $postsPerPage) {
							echo '<div class="pagination"><p>';
								$totalPages = ceil($itemNum/$postsPerPage);
								if($pageNum > 0) {
									echo '<a href="'.$thisURL.'?filter='.$urlVar.'&pg='.$x.'"><</a>';	
								}
								for($x = 0; $x < $totalPages; $x++) {
									if($x == $pageNum) {
										echo '<a class="selected" href="'.$thisURL.'?filter='.$urlVar.'&pg='.$x.'">'.($x+1).'</a>';	
									} else {
										echo '<a href="'.$thisURL.'?filter='.$urlVar.'&pg='.$x.'">'.($x+1).'</a>';	
									}
								}
								
								if($pageNum+1 < $totalPages) {
									echo '<a href="'.$thisURL.'?filter='.$urlVar.'&pg='.$x.'">></a>';	
								}
							
							echo '</p></div>';
						}
					echo '</column>';
				?>
				
				
				<?php
					
                    
					$itemargs = array (
                        'post_type' => $posttypes,
                        'posts_per_page' => $postsPerPage,
						'offset' => $offset
					);
                    $items = get_posts($itemargs);
                    if($items) :
                		$post = get_queried_object();

						echo '<column>';
							
								foreach($items as $item) :
									include('infocard.php');
								endforeach;
							
						echo '</column>';
                    endif;
				?>
			</article>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php endwhile; endif; ?>
<?php get_footer();
