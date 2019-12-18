<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php if(is_front_page()) { ?>
    	<title><?php bloginfo('name'); ?></title>
	<?php } else { ?>
		<title><?php bloginfo('name'); ?> <?php the_title(); ?></title>
	<?php } ?>
    <link href="<?php echo get_the_permalink(); ?>" rel="canonical" />
    <link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <script src="<?php echo bloginfo('url'); ?>/wp-includes/js/jquery/jquery.js" type="text/javascript"></script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="site">
	<div id="header-bar">
		<?php
			if(is_front_page()) {
				$dot = 'blue-dot';
			} else {
				if(get_post_type() == 'page') { 
					$dot = get_field('header_colour').'-dot'; 
				} else { 
					$dot = 'purple-dot'; 
				}
			}
		?>
		<header id="masthead" class="<?php echo $dot; ?>">
			<?php /*?><a href="<?php bloginfo('url'); ?>"><img src="<?php $logo = get_field('logo', 'options'); echo $logo[url]; ?>" alt="<?php echo bloginfo('name'); ?>" ></a><?php */?>
			<a href="<?php bloginfo('url'); ?>"><?php the_field('logo_inline_svg','options'); ?></a>
		</header>
		<nav id="main-nav">
			
			<div class="res-btn"><?php $resbtn = get_field('responsive_menu_icon','options'); echo '<img src="'.$resbtn['url'].'" alt="res btn">'; ?></div>
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>
	</div>

	<div id="content" class="site-content">