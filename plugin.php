<?php
/*
Plugin Name:	Site Custom Options
Plugin URI:		https://dmsdesignz.com
Description:	My Custom Site Options.
Version:		1.0.0
Author:			Mike Saalwaechter
Author URI:		https://dmsdesignz.com.com
License:		GPL-2.0+
License URI:	http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}
function child_plugin_init() {
	
	// If Parent Plugin is NOT active
	if ( current_user_can( 'activate_plugins' ) && !class_exists( 'ACF' ) ) {
		
		add_action( 'admin_init', 'my_plugin_deactivate' );
		add_action( 'admin_notices', 'my_plugin_admin_notice' );
		
		// Deactivate the Child Plugin
		function my_plugin_deactivate() {
		  deactivate_plugins( plugin_basename( __FILE__ ) );
		}
		
		// Throw an Alert to tell the Admin why it didn't activate
		function my_plugin_admin_notice() {
			$dpa_child_plugin = __( 'Custom Site Options', 'textdomain' );
            		$dpa_parent_plugin = __( 'Advanced Custom Fields Pro', 'textdomain' );
            		
            		echo '<div class="error"><p>'
                		. sprintf( __( '%1$s requires %2$s to function correctly. Please activate %2$s before activating %1$s. For now, the plugin has been deactivated.', 'textdomain' ), '<strong>' . esc_html( $dpa_child_plugin ) . '</strong>', '<strong>' . esc_html( $dpa_parent_plugin ) . '</strong>' )
                		. '</p></div>';
                
		   if ( isset( $_GET['activate'] ) )
			unset( $_GET['activate'] );
		}
    	} else {

        require plugin_dir_path( __FILE__ ) . 'includes/functions.php';
        require plugin_dir_path( __FILE__ ) . 'includes/fields.php';

        add_action( 'wp_enqueue_scripts', 'custom_enqueue_files' );

        
    }
}
add_action( 'plugins_loaded', 'child_plugin_init' );