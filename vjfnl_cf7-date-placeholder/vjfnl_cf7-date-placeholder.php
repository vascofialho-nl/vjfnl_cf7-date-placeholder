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

// Enqueue JavaScript only if CF7 is active
function vjfnl_cf7_date_placeholder_enqueue_script() {
    if (class_exists('WPCF7') && (is_page() || is_single())) {
        wp_enqueue_script(
            'vjfnl_cf7-date-placeholder',
            plugin_dir_url(__FILE__) . 'assets/js/vjfnl_cf7-date-placeholder.js',
            array('jquery'),
            '1.0.3',
            true
        );
    }
}


// without this code the plugin will not update. 
if (class_exists('VJFNL_CF7_Date_Placeholder_Updater')) {
    new VJFNL_CF7_Date_Placeholder_Updater(__FILE__, 'https://api.github.com/repos/vascofialho-nl/cf7-date-placeholder/releases/latest');
}
add_action('wp_enqueue_scripts', 'vjfnl_cf7_date_placeholder_enqueue_script');require_once plugin_dir_path(__FILE__) . 'includes/updater.php';
