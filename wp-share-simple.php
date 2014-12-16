<?php

/**
 * Plugin Name: WP Share Simple
 * Description: A simple plugin to show the social shared count
 * Version: 1.0
 * Author: Vamsi Mannem
 */

defined('ABSPATH') or exit;
 
include_once 'wp-share-admin.php';

add_filter( 'the_content', 'wp_share_simple_content_filter', 20 );
/**
 * Add content to the begining of the post
 */
function wp_share_simple_content_filter( $content ) {
    global $post;
    $url = get_permalink($post->ID);
    $title = get_the_title($post->ID);
    $str = '';
    $str .='<div class="wp-share-simple" data-url="'.$url.'" data-text="'.$title.'">';
    $str .= '</div>';
   
    if ( is_single() ){
        $options = get_option('wp_share_simple_options');
        if($options != null)
        {
             $val =  $options['display_option'];

           if('manual' == $val)
           {
              // Do nothing // Option for v1.1
           }
           else if ('top' == $val)
           {
              $content = $str.$content;
           }
           else if ('bottom' == $val)
           {
              $content = $content.$str;
           }
           else if ('both' == $val){
            $content = $str.$content.$str;    
           }
           else {
             // Default returns plain content
           }
        }
    }
    return $content;
}
// Adds required scripts and css to the plugin
function wp_share_simple_script() {
	wp_enqueue_script(
		'wp-share-core',
		plugins_url( '/js/jquery.sharrre.min.js' , __FILE__ ),
		array( 'jquery' )
	);
	wp_enqueue_script(
		'wp-share-script',
		plugins_url( '/js/wp-share-simple.js' , __FILE__ ),
		array( 'jquery' )
	);
	wp_register_style('wp-share-simple-style', plugins_url('/css/wp-share-simple.css', __FILE__));
wp_enqueue_style('wp-share-simple-style');
	
}

add_action( 'wp_enqueue_scripts', 'wp_share_simple_script' );

?>