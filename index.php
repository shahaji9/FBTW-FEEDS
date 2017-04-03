<?php
/*
  Plugin Name: Facebook Twitter Feeds
  Description: A powerful Facebook and Twitter integration that allows you to display facebook (timeline, events and messages), twitter follow button and twitter timeline for your wordpress website.
  Version: 1.1
  Author: Shahaji Deshmukh
  Author URI: https://profiles.wordpress.org/shahaji9
  Plugin URI: https://wordpress.org/plugins/fbtw-feeds
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sdfbtw_activate() {
    
}
register_activation_hook(__FILE__, 'sdfbtw_activate');

function sdfbtw_deactivate() {
    //delete_option('facebook_twitter_feeds_options');
}
register_deactivation_hook(__FILE__, 'sdfbtw_deactivate');

if (!defined('FBTW_FEEDS_PLUGIN_URL'))
    define('FBTW_FEEDS_PLUGIN_URL', plugin_dir_url(__FILE__));

if (!defined('FBTW_FEEDS_PLUGIN_BASE_URL'))
    define('FBTW_FEEDS_PLUGIN_BASE_URL', dirname(__FILE__));


/* * *********************************************
 * Frontend scripts and styles 
 * ******************************************** */
function sdfbtw_frontend_scripts() {
    
    global $wpdb, $app_id, $fb_tw_options, $fbtw_timeline_width, $fbtw_timeline_height;
    
    $fb_tw_options = get_option('facebook_twitter_feeds_options');
    
    if (!is_admin()) {
        wp_enqueue_style('sdft-front', plugins_url('css/sdft-front.css', __FILE__));
        wp_enqueue_script('sdft-main', plugins_url('js/sdft-main.js', __FILE__), array('jquery'), '', true);
        
        $app_id = $fb_tw_options['section_facebook_app_id'];
        $btns_position = $fb_tw_options['section_button_position'];
        $visible_on_device = $fb_tw_options['section_visible_on_minimum_device_width'];
        $fbtw_timeline_width = ($fb_tw_options['section_fbtw_timeline_width']) ? $fb_tw_options['section_fbtw_timeline_width'] : '340';
        $fbtw_timeline_height = ($fb_tw_options['section_fbtw_timeline_height']) ? $fb_tw_options['section_fbtw_timeline_height'] : '500';

        $fbtw_wrapper_width = ($fbtw_timeline_width + 8);
        $fbtw_wrapper_height = ($fbtw_timeline_height + 8);
        
        $local_vars = array('app_id' => $app_id, 'btn_position' => $btns_position, 'visible_on_device' => $visible_on_device, 'fbtw_wrapper_width' => $fbtw_wrapper_width, 'fbtw_wrapper_height' => $fbtw_wrapper_height);
        wp_localize_script('sdft-main', 'sdftvars', $local_vars);
    }
}

add_action('wp_enqueue_scripts', 'sdfbtw_frontend_scripts');

//For admin side scripts
function sdfbtw_admin_scripts() {
    wp_register_style('sdft-admin', plugins_url('css/sdft-admin.css', __FILE__));
    wp_enqueue_style('sdft-admin');
    wp_enqueue_script('sdft-admin', plugins_url('js/sdft-admin.js', __FILE__), array('jquery'), '', true);    
}

add_action('admin_enqueue_scripts', 'sdfbtw_admin_scripts');

// Place in Option List on Settings > Plugins page 
function sdfbtw_settings_actlinks($links, $file) {
    // Static so we don't call plugin_basename on every plugin row.
    static $my_plugin;

    if (!$my_plugin) {
        $my_plugin = plugin_basename(__FILE__);
    }

    if ($file == $my_plugin) {
        $settings_link = '<a href="options-general.php?page=facebook_twitter_feeds_options">' . __('Settings') . '</a>';
        array_unshift($links, $settings_link); // before other links
    }

    return $links;
}

add_filter('plugin_action_links', 'sdfbtw_settings_actlinks', 10, 2);

//Include files
require_once(FBTW_FEEDS_PLUGIN_BASE_URL . '/admin-settings.php');
require_once(FBTW_FEEDS_PLUGIN_BASE_URL . '/frontend.php');
