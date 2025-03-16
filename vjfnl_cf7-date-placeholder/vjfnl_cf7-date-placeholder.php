<?php
/**
 * Plugin Name: CF7 Date Placeholder Add-on
 * Plugin URI: https://www.vascofialho.nl/wordpress/plugins/date-placeholder-field-for-contact-form-7/
 * Description: Adds proper placeholder support for date fields in Contact Form 7.
 * Version: 1.0.5
 * Author: vascofmdc 
 * Author URI: https://www.vascofialho.nl
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: vjfnl_cf7-date-placeholder
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Include updater system (connected with github)
require_once plugin_dir_path( __FILE__ ) . 'includes/updater.php';
define( 'PLUGIN_VERSION', '1.0.5' ); // Adjust this when you release a new version.
new Plugin_Updater( __FILE__, PLUGIN_VERSION );

// Check if Contact Form 7 is active, and deactivate if not
function vjfnl_cf7_check_and_deactivate() {
    if (!class_exists('WPCF7')) {
        deactivate_plugins(plugin_basename(__FILE__)); // Deactivate this plugin
        add_action('admin_notices', 'vjfnl_cf7_missing_plugin_notice'); // Show admin notice
    }
}
add_action('admin_init', 'vjfnl_cf7_check_and_deactivate');

// Display admin notice if CF7 is missing
function vjfnl_cf7_missing_plugin_notice() {
    echo '<div class="notice notice-error"><p><strong>CF7 Date Placeholder Add-on</strong> has been deactivated because Contact Form 7 is not installed or active. Please install and activate <a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">Contact Form 7</a> first.</p></div>';
}



function vjfnl_cf7_enqueue_date_placeholder_script() {
    wp_enqueue_script(
        'vjfnl-cf7-date-placeholder',
        plugins_url('assets/js/vjfnl_cf7-date-placeholder.js', __FILE__), 
        array('jquery'),
        '1.0.5',
        true
    );
}
add_action('wp_enqueue_scripts', 'vjfnl_cf7_enqueue_date_placeholder_script');
