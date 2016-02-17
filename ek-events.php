<?php
/**
 * Plugin Name: Comins Coch Events Manager
 * Plugin URI: http://hatrackmedia.com
 * Description: This plugin allows to publish events. 
 * Author: Eliza Kaniewska
 * Author URI: http://hatrackmedia.com
 * Version: 0.0.1
 * License: GPLv2
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once ( plugin_dir_path(__FILE__) . 'ek-events-fields.php' );

require_once ( plugin_dir_path(__FILE__) . 'ek-custom-post-types.php' );


function dwwp_admin_enqueue_scripts() {
	global $pagenow, $typenow;


	if ( ($pagenow == 'post.php' || $pagenow == 'post-new.php') && $typenow == 'event' ) {
		
		wp_enqueue_script( 'dwwwp-job-js', plugins_url( 'js/admin-jobs.js', __FILE__ ), array( 'jquery', 'jquery-ui-datepicker' ), '20150204', true );
		wp_enqueue_script( 'dwwp-custom-quicktags', plugins_url( 'js/dwwp-quicktags.js', __FILE__ ), array( 'quicktags' ), '20150206', true );
		wp_enqueue_style( 'jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css' );

	}


}
add_action( 'admin_enqueue_scripts', 'dwwp_admin_enqueue_scripts' );






