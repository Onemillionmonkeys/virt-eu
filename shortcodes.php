<?php

function footnote_function($atts = array()) {
	extract(shortcode_atts(array(
     'ref' => '0'
    ), $atts));
	return '<a href="#_fn'.$ref.'" name="_fnr'.$ref.'" class="footnote">'.$ref.'</a>';
}

add_shortcode('footnote', 'footnote_function');


?>
