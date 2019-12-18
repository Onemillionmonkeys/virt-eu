    
       
    
    </section>
	<footer id="colophon" class="site-footer">
		<div class="footer-thumb">
			<?php 
				
				$footerThumb = get_field('footer_image','options');
				echo wp_get_attachment_image($footerThumb['ID'], 'thumbnail');
			?>
		</div>
		<div class="footer-disclaimer">
			<p><?php the_field('footer_discalimer', 'options'); ?> <a href="<?php the_field('footer_privacy_link','options'); ?>"><?php the_field('footer_privacy_link_text','options'); ?></a></p>
		</div>
		<?php
		if( have_rows('social_media_links', 'options') ):
			echo '<div class="footer-socials">';
				while ( have_rows('social_media_links', 'options') ) : the_row();
					$socialThumb = get_sub_field('icon');
					echo '<a href="'.get_sub_field('link_to_social_media').'" target="_blank" rel="nofollow">';
						echo wp_get_attachment_image($socialThumb['ID'], 'thumbnail');
					echo '</a>';
					

				endwhile;
			echo '</div>';
		endif;
		?>
	</footer><!-- #colophon -->
	<div class="cookies">
		<div class="cookie-con">
			<div class="cookie-content">
				<h3><?php the_field('cookie_headline', 'options'); ?></h3>
				<?php the_field('cookie_text', 'options'); ?>
			</div>
			<div class="cookie-bar">
				<div class="cookie-links">
					<?php
					if( have_rows('cookie_links', 'options') ):
						while ( have_rows('cookie_links', 'options') ) : the_row();
							echo '<a href="'.get_sub_field('cookie_link').'">'.get_sub_field('link_text').'</a>';
						endwhile;
					endif;
					?>
				</div>
				<div class="cookie-btn">
					<p><?php the_field('cookie_accept_text', 'options'); ?></p>
				</div>
			</div>
		</div>
	</div>
		
		

</div><!-- #page -->

<script type="text/javascript">
		jQuery(document).ready(function($) {
			
			if(typeof(Storage)!=="undefined") {
			  if (localStorage.wookie != "n") {
				var cHeight = $('.cookies').innerHeight();
				$('.cookies').css('top','calc( 100% - '+cHeight+'px )');  
				  
			  } 
			}
			
			$('.footer-thumb').click(function() {
				localStorage.wookie = "o";
				var cHeight = $('.cookies').innerHeight();
				$('.cookies').css('top','calc( 100% - '+cHeight+'px )');  
			})
			
			$('.cookies .cookie-btn').click( function() {
				localStorage.wookie = "n";
				$('.cookies').css('top','100%'); 
			});
			
			$('.res-btn').click(function() {
				$('.menu-main-menu-container').toggleClass('res-open');
			});	
		});
</script>

<?php if($GLOBALS['galvar'] > 0) { ?>
	<lightbox lightboxnum="<?php echo $GLOBALS['galvar']; ?>">
		<div class="scrubber">
			<div class="scrubber-ikon"></div>
			<h4>Henter Billede</h4>
		</div>
		<div class="lightbox-img-con">
		</div>
		<div class="nav-btn lightbox-close">X</div>
		<?php if($GLOBALS['galvar'] > 1) { ?>
		<div class="nav-btn nav-btn-prev lightbox-prev">&lt;</div>
		<div class="nav-btn nav-btn-next lightbox-next">&gt;</div>
		<?php } ?>
		<p></p>
	</lightbox>



	<script type="text/javascript">
		jQuery(document).ready(function($) {
			
			var loadedimgurl = "";
				var loadedimgtext = "";
				var relnum = 0;
				var relmax = 0;
				var btn_act = 0;

				$('#main figure').click(function() {

					loadedimgurl = $(this).attr('galurl');
					loadedimgtext = $(this).find('figcaption').text();
					
					relnum = parseInt($(this).attr('galnum'));
					relmax = parseInt($('lightbox').attr('lightboxnum'));
					
					$('lightbox').fadeIn(1000, function() {
						imgloader(loadedimgurl);	
					});
				});


				$('.lightbox-close').click(function() {
					$('lightbox').fadeOut(1000, function() {
						$('.lightbox-img-con').css('display','none');
						$('lightbox p').css('display','none');
					});
				});


				$(document).keyup(function(e) {
					 if (e.keyCode == 27) { // escape key maps to keycode `27`
						$('lightbox').fadeOut(1000, function() {
							$('.lightbox-img-con').css('display','none');
							$('lightbox p').css('display','none');
						});
					}
				});

				$('.lightbox-next').click(function() {
					if(btn_act == 0) {
						btn_act = 1;
						$('lightbox p').fadeOut(500);
						$('.lightbox-img-con').fadeOut(1000, function() {
							relnum++;
							if(relnum>relmax) { relnum = 1; }
							loadedimgurl = $('figure[galnum="'+relnum+'"]').attr('galurl');
							loadedimgtext = $('figure[galnum="'+relnum+'"]').find('figcaption').text();
							
							imgloader(loadedimgurl);	
						});
					}
				});

				$('.lightbox-prev').click(function() {
					if(btn_act == 0) {
						btn_act = 1;
						$('lightbox p').fadeOut(500);
						$('.lightbox-img-con').fadeOut(1000, function() {
							relnum--;
							if(relnum < 1) { relnum = relmax; }
							loadedimgurl = $('figure[galnum="'+relnum+'"]').attr('galurl');
							loadedimgtext = $('figure[galnum="'+relnum+'"]').find('figcaption').text();
							
							imgloader(loadedimgurl);	
						});
					}
				});


				function imgloader(filename) {
					$.ajax({
						url: filename,
						type: 'GET',
						dataType: 'html',
						success: function(data, textStatus, xhr) {
							btn_act = 0;
							//$('lightbox img').attr('src',filename);
							$('.lightbox-img-con').css('background-image', 'url('+filename+')')
							$('lightbox p').text(loadedimgtext);
							$('.lightbox-img-con').fadeIn(500);
							//$('lightbox img').fadeIn(500);
							$('lightbox p').delay(500).fadeIn(500);
						}
					});

				}

		})
	</script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>