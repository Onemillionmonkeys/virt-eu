<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<section id="primary" class="content-area">
		<?php 
			if(get_field('header_image')) {
				$headerimage = get_field('header_image');
				$size = 'full';
				echo '<div class="header-image-box">';
					echo wp_get_attachment_image($headerimage['ID'], $size);
					echo '<div class="main-title-box '.get_field('header_colour').'-bg">';
						echo '<h1>'.get_the_title().'</h1>';
					echo '</div>';
				echo '</div>';
				
				
			}
		?>
		<main id="main" class="site-main">
			<article>
				<?php 
				if( have_rows('segments') ):
					while ( have_rows('segments') ) : the_row();
						include('content.php'); 
				    endwhile;
				endif;
				?>
			</article>
		</main><!-- .site-main -->
	</section><!-- .content-area -->
<?php endwhile; endif; ?>
<?php get_footer();
