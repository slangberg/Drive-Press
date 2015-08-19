<?php
/**
 * Plugin Name: Drive Press
 * Plugin URI: http://drivepress.net
 * Description: A brief description of the Plugin.
 * Version: 0.1
 * Author: Sam Langberg
 * Author URI: http://samlangberg.com
 * License: A "Slug" license name e.g. GPL2
 */
defined('ABSPATH') or die("No script kiddies please!");
include( plugin_dir_path( __FILE__ ) . 'dp_options_handler.php');
include( plugin_dir_path( __FILE__ ) . 'dp_Post_Edit.php');
include( plugin_dir_path( __FILE__ ) . 'dp_Setttings.php');
include( plugin_dir_path( __FILE__ ) . 'dp_Post_Api_Handler.php');


if ( is_admin() ) {
    add_action( 'load-post.php', 'post_edit_Init');
    add_action( 'load-post-new.php', 'post_edit_Init');
    add_action('init', 'plugin_Init');
}

function post_edit_Init(){
	$options = new dp_options_Handler();
	$post_edit = new dp_Post_Edit($options);
	$post_dataapi = new dp_Post_Api_Data($options);
}

function plugin_Init(){
	$settings = new dp_Setttings();
}

?>


   