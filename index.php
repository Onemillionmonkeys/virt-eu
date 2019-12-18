<?php get_header(); ?>
	<section id="primary" class="content-area">
		<?php
			if(get_field('header_image', 'options')) {
				$headerimage = get_field('header_image', 'options');
				$size = 'full';
				echo '<div class="header-image-box header-image-box-frontpage">';
					echo wp_get_attachment_image($headerimage['ID'], $size);
					echo '<div class="main-title-box main-bg">';
						echo get_field('headline','options');
					echo '</div>';
				echo '</div>';
				
				
			}
		?>
		<main id="main" class="site-main">
            <article>
				<?php 
				if( have_rows('segments', 'options') ):
					while ( have_rows('segments', 'options') ) : the_row();
						include('content.php'); 
				    endwhile;
				endif;
				?>
			</article>
		   
		</main><!-- .site-main -->
	</section><!-- .content-area -->



<?php
get_footer(); ?>
