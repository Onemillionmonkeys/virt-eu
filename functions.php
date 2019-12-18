<?php

function post_remove ()      //creating functions post_remove for removing menu item
{ 
   remove_menu_page('edit.php');
}



add_action('admin_menu', 'post_remove'); 

add_action( 'init', 'create_story' );
add_action( 'init', 'create_workshop' );
add_action( 'init', 'create_ethical_review');

add_action( 'init', 'create_specific_tax' );

function create_story() {
  $labels = array(
    'name' => _x('Story', 'post type general name'),
    'singular_name' => _x('Story', 'post type singular name'),
    'plural_name' => _x('Stories', 'post type plural name'),
	'add_new' => _x('Add new Story', 'Event'),
    'add_new_item' => __('Add new Story'),
    'edit_item' => __('Edit Story'),
    'new_item' => __('New Story'),
    'view_item' => __('View Story'),
    'search_items' => __('Search Stories'),
    'not_found' =>  __('No Story found'),
    'not_found_in_trash' => __('No Stories in Trash'),
    'parent_item_colon' => ''
  );

  $supports = array('title', 'author');

  register_post_type( 'story',
    array(
      'labels' => $labels,
      'public' => true,
      'supports' => $supports,
	  'menu_position' => 5
    )
  );
}

function create_workshop() {
  $labels = array(
    'name' => _x('Workshop', 'post type general name'),
    'singular_name' => _x('Workshop', 'post type singular name'),
    'plural_name' => _x('Workshops', 'post type plural name'),
	'add_new' => _x('Add new Workshop', 'Event'),
    'add_new_item' => __('Add new Workshop'),
    'edit_item' => __('Edit Workshop'),
    'new_item' => __('New Workshop'),
    'view_item' => __('View Workshop'),
    'search_items' => __('Search Workshops'),
    'not_found' =>  __('No Workshop found'),
    'not_found_in_trash' => __('No Workshops in Trash'),
    'parent_item_colon' => ''
  );

  $supports = array('title', 'author');

  register_post_type( 'workshop',
    array(
      'labels' => $labels,
      'public' => true,
      'supports' => $supports,
	  'menu_position' => 5
    )
  );
}

function create_ethical_review() {
  $labels = array(
    'name' => _x('Ethical Review', 'post type general name'),
	'singular_name' => _x('Ethical Review', 'post type singular name'),
    'plural_name' => _x('Ethical Reviews', 'post type plural name'),
	'add_new' => _x('Add new Ethical Review', 'Event'),
    'add_new_item' => __('Add new Ethical Review'),
    'edit_item' => __('Edit Ethical Review'),
    'new_item' => __('New Ethical Review'),
    'view_item' => __('View Ethical Review'),
    'search_items' => __('Search Ethical Reviews'),
    'not_found' =>  __('No Ethical Review found'),
    'not_found_in_trash' => __('No Ethical Reviews in Trash'),
    'parent_item_colon' => ''
  );

  $supports = array('title', 'author');

  register_post_type( 'ethical-review',
    array(
      'labels' => $labels,
      'public' => true,
      'supports' => $supports,
	  'menu_position' => 5
    )
  );
}

function create_specific_tax() {
 $labels = array(
    'name' => _x( 'Specific', 'taxonomy general name' ),
    'singular_name' => _x( 'Selected Specific', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Specifics' ),
    'all_items' => __( 'All Specifics' ),
    'parent_item' => __( 'Parent Specific' ),
    'parent_item_colon' => __( 'Parent Specific:' ),
    'edit_item' => __( 'Edit Specific' ),
    'update_item' => __( 'Update Specific' ),
    'add_new_item' => __( 'Add Specific' ),
    'new_item_name' => __( 'New Specific name' ),
  ); 	

  register_taxonomy('specifics',array('story','workshop','ethical-unboxing'),array(
    'hierarchical' => true,
    'labels' => $labels
  ));
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'VIRT-EU Settings',
		'menu_title'	=> 'VIRT-EU Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'VIRT-EU Frontpage',
		'menu_title'	=> 'VIRT-EU Frontpage',
		'parent_slug'	=> 'theme-general-settings',
	));
}

add_theme_support( 'menus' );
function register_my_menu() {
    register_nav_menu( 'main-menu', __( 'Main Menu' ) );
	register_nav_menu( 'footer-menu', __( 'Footer Menu' ) );
}
add_action( 'init', 'register_my_menu' );

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	$mimes['zip'] = 'application/zip';
	return $mimes;
}

add_filter( 'upload_mimes', 'cc_mime_types' );

add_image_size( 'singleheaderimage', 1600, 640, true );
add_image_size( 'profileimage', 300, 300, true );

function my_acf_admin_head() {
	?>
	<style type="text/css">
		.acf-repeater > table > tbody > tr.acf-row > td.acf-fields, .acf-repeater > table > tbody > tr.acf-row > td.acf-row-handle {		
			border-top: 2vw #751157 solid;
		}
		
        .acf-flexible-content > .acf-actions > .acf-button {
            background-color: #f9b303;
            border: none;
            box-shadow: 0 0 0;
            border-radius: 0;
            text-shadow: 0 0 0;
			color: #000;
        }
		
		
		
		.acf-flexible-content .acf-fc-layout-handle {
			border-top: .5vw solid #f9b303;
		}
        
        .widefat {
            background: red;
        }
		
	</style>

	
	<?php
}

add_action('acf/input/admin_head', 'my_acf_admin_head');

include('shortcodes.php');

?>