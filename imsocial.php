<?php
   /*
   Plugin Name: I'm Social
   Plugin URI: http://laszlo.gazsi.net
   Description: a plugin to easily display your pages on various social networks
   Version: 1.0
   Author: Laszlo Gazsi
   Author URI: http://laszlo.gazsi.net
   License: GPL2
   */

   /******************** USAGE *********************
   <?php 
		if (function_exists("imsocial_get_links")) {
	   		echo imsocial_get_links();
		}
	?>
   */
	
	function imsocial_add_stylesheet(){
		wp_register_style( 'imsocial-style', plugins_url('style.css', __FILE__) );
		wp_enqueue_style( 'imsocial-style' );
	}

	/******************** HOOK *********************/
	add_action( 'wp_enqueue_scripts', 'imsocial_add_stylesheet' );

	function imsocial_get_links(){

		$list_json = imsocial_get_data();

		$entries = json_decode($list_json);

		$result = '';

		foreach($entries as $entry_key => $entry_value) {
			$result .= imsocial_create_button($entry_key, $entry_value);
		}

		return '<section id="imsocial">' . $result . '</section>';
	}

	function imsocial_get_data(){
		return '{"github": {
			"icon": "http://laszlo.gazsi.net/assets/images/githubf8fb.png",
			"alt": "GitHub",
			"url": "https://github.com/laszlo-gazsi"
		},
		"linkedin": {
			"icon": "http://laszlo.gazsi.net/assets/images/linkedinf8fb.png",
			"alt": "LinkedIn",
			"url": "http://www.linkedin.com/in/lacyg"
		},
		"instagram": {
			"icon": "http://laszlo.gazsi.net/assets/images/instagramf8fb.png",
			"alt": "Instagram",
			"url": "http://instagram.com/laszlo_gazsi"
		},
		"twitter": {
			"icon": "http://laszlo.gazsi.net/assets/images/twitterf8fb.png",
			"alt": "Twitter",
			"url": "https://twitter.com/laszlo_gazsi"
		},
		"google": {
			"icon": "http://laszlo.gazsi.net/assets/images/googlef8fb.png",
			"alt": "Google+",
			"url": "https://plus.google.com/108598979373525736839"
		},
		"facebook": {
			"icon": "http://laszlo.gazsi.net/assets/images/facebookf8fb.png",
			"alt": "Facebook",
			"url": "http://www.facebook.com/laszlo.gazsi"
		},
		"youtube": {
			"icon": "http://laszlo.gazsi.net/assets/images/youtubef8fb.png",
			"alt": "YouTube",
			"url": "http://www.youtube.com/user/lacyg88"
		}
	}';
}

function imsocial_create_icon($title, $properties){
	$result = '<img ';
	$result .= 'src="' . $properties->icon . '" ';
	$result .= 'alt="' . $properties->alt . '"';
	$result .= '/>';

	return $result;
}

function imsocial_create_button($title, $properties){
	$result = '<a class="imsocial" id="' . $title . '" ';
	$result .= 'href="' . $properties->url . '" ';
	$result .= 'title="' . $properties->alt . '"> ';
	$result .= imsocial_create_icon($title, $properties);
	$result .= '</a>';

	return $result;
}

?>