<?php
/*
    admin settings code
    Created on : 13 December, 2016, 11:53:40 AM
    Author     : Shahaji Deshmukh
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * FBTW Feeds Settings
 * 
 */
class sdfbtwPageSettings {

    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_sdfbtw_settings_page'));
        add_action('admin_init', array($this, 'page_init'));
    }

    /**
     * Add options page
     */
    public function add_sdfbtw_settings_page() {
        // This page will be under "Settings"
        add_options_page(
                'Settings Admin', 'FBTW Feeds', 'manage_options', 'facebook_twitter_feeds_options', array($this, 'create_admin_page')
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option('facebook_twitter_feeds_options');
        ?>
        <div class="wrap">
        <?php screen_icon(); ?>
            <h2>Facebook Twitter Feeds Settings</h2>
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields('facebook_twitter_feeds_option_group');
                do_settings_sections('facebook_twitter_feeds_options');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and Add settings
     */
    public function page_init() {
        register_setting(
                'facebook_twitter_feeds_option_group', // Option group
                'facebook_twitter_feeds_options', // Option name
                array($this, 'sanitize') // Sanitize
        );

        /*********************************************************************************************
         * 
         *  Facebook feeds 
         * 
         * *******************************************************************************************/
        add_settings_section(
                'setting_section_facebook', // ID
                'Facebook Feeds Section', // Title
                array($this, 'print_section_facebook_feeds'), // Callback
                'facebook_twitter_feeds_options' // Page
        );

        add_settings_field(
                'section_facebook_app_id', // ID
                'Facebook Application ID: ', // Title 
                array($this, 'section_facebook_app_id_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_facebook' // Section ID           
        );
        
        add_settings_field(
                'section_facebook_page_url', // ID
                'Facebook Page URL: ', // Title 
                array($this, 'section_facebook_page_url_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_facebook' // Section ID           
        );
        
        add_settings_field(
                'section_facebook_tabs', // ID
                'Tabs: ', // Title 
                array($this, 'section_facebook_tabs_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_facebook' // Section ID           
        );
                
        add_settings_field(
                'section_facebook_small_header', // ID
                'Use Small Header: ', // Title 
                array($this, 'section_facebook_small_header_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_facebook' // Section ID           
        );
        
        add_settings_field(
                'section_facebook_hide_cover_photo', // ID
                'Hide Cover Photo: ', // Title 
                array($this, 'section_facebook_hide_cover_photo_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_facebook' // Section ID           
        );
        
//        add_settings_field(
//                'section_facebook_adapt_to_plugin_container_width', // ID
//                'Adapt to Plugin Container Width: ', // Title 
//                array($this, 'section_facebook_adapt_to_plugin_container_width_callback'), // Callback
//                'facebook_twitter_feeds_options', // Page
//                'setting_section_facebook' // Section ID           
//        );
        
        add_settings_field(
                'section_facebook_hide_friends_faces', // ID
                'Hide Friends Faces: ', // Title 
                array($this, 'section_facebook_hide_friends_faces_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_facebook' // Section ID           
        );

        /*********************************************************************************************
         * 
         *  Twitter Feeds
         * 
         * *******************************************************************************************/
        add_settings_section(
                'setting_section_twitter', // ID
                'Twitter Feeds Section', // Title
                array($this, 'print_section_twitter_feeds'), // Callback
                'facebook_twitter_feeds_options' // Page
        );

        add_settings_field(
                'section_twitter_username', // ID
                'Twitter Username:', // Title 
                array($this, 'section_twitter_username_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_twitter' // Section ID           
        );

        add_settings_field(
                'section_twitter_follow_button', // ID
                'Follow Button:', // Title 
                array($this, 'section_twitter_follow_button_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_twitter', // Section ID
                array( 'class' => 'my-class-test' )
        );

        add_settings_field(
                'section_twitter_follow_button_count_hide', // ID
                'Follow Button Count Hide:', // Title 
                array($this, 'section_twitter_follow_button_count_hide_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_twitter', // Section ID           
                array( 'class' => 'follow-btn-show-hide' )
        );

        add_settings_field(
                'section_twitter_follow_button_username_hide', // ID
                'Follow Button Username Hide:', // Title 
                array($this, 'section_twitter_follow_button_username_hide_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_twitter', // Section ID
                array( 'class' => 'follow-btn-show-hide' )
        );

        add_settings_field(
                'section_twitter_follow_button_large', // ID
                'Display Large Button:', // Title 
                array($this, 'section_twitter_follow_button_large_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_twitter', // Section ID           
                array( 'class' => 'follow-btn-show-hide' )
        );
        
        
        /*********************************************************************************************
         * 
         *  CSS Settings
         * 
         * *******************************************************************************************/
        add_settings_section(
                'setting_section_styles', // ID
                'Styles Settings', // Title
                array($this, 'print_setting_section_styles'), // Callback
                'facebook_twitter_feeds_options' // Page
        );
        
        add_settings_field(
                'section_fbtw_timeline_width', // ID
                'Timeline Width:', // Title 
                array($this, 'section_fbtw_timeline_width_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_styles' // Section ID           
        );

        add_settings_field(
                'section_fbtw_timeline_height', // ID
                'Timeline Height:', // Title 
                array($this, 'section_fbtw_timeline_height_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_styles' // Section ID           
        );

        add_settings_field(
                'section_button_position', // ID
                'Position:', // Title 
                array($this, 'section_button_position_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_styles' // Section ID           
        );

        add_settings_field(
                'section_visible_on_minimum_device_width', // ID
                'Visible Buttons for Minimum Device Width:', // Title 
                array($this, 'section_visible_on_minimum_device_width_callback'), // Callback
                'facebook_twitter_feeds_options', // Page
                'setting_section_styles' // Section ID           
        );
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize($input) {

        $new_input = array();

        //section facebook feeds settings
        if (isset($input['section_facebook_app_id']))
            $new_input['section_facebook_app_id'] = sanitize_text_field($input['section_facebook_app_id']);
        
        if (isset($input['section_facebook_page_url']))
            $new_input['section_facebook_page_url'] = sanitize_text_field($input['section_facebook_page_url']);
        
        if (isset($input['section_facebook_tabs']))
            $new_input['section_facebook_tabs'] = sanitize_text_field($input['section_facebook_tabs']);
        
        if (isset($input['section_facebook_small_header']))
            $new_input['section_facebook_small_header'] = $input['section_facebook_small_header'];
        
        if (isset($input['section_facebook_hide_cover_photo']))
            $new_input['section_facebook_hide_cover_photo'] = $input['section_facebook_hide_cover_photo'];
        
//        if (isset($input['section_facebook_adapt_to_plugin_container_width']))
//            $new_input['section_facebook_adapt_to_plugin_container_width'] = $input['section_facebook_adapt_to_plugin_container_width'];
        
        if (isset($input['section_facebook_hide_friends_faces']))
            $new_input['section_facebook_hide_friends_faces'] = $input['section_facebook_hide_friends_faces'];

        //section twitter feeds
        if (isset($input['section_twitter_username']))
            $new_input['section_twitter_username'] = $input['section_twitter_username'];

        if (isset($input['section_twitter_follow_button']))
            $new_input['section_twitter_follow_button'] = $input['section_twitter_follow_button'];

        if (isset($input['section_twitter_follow_button_count_hide']))
            $new_input['section_twitter_follow_button_count_hide'] = $input['section_twitter_follow_button_count_hide'];

        if (isset($input['section_twitter_follow_button_username_hide']))
            $new_input['section_twitter_follow_button_username_hide'] = $input['section_twitter_follow_button_username_hide'];

        if (isset($input['section_twitter_follow_button_large']))
            $new_input['section_twitter_follow_button_large'] = $input['section_twitter_follow_button_large'];

        //section stylesheets
        if (isset($input['section_fbtw_timeline_width']))
            $new_input['section_fbtw_timeline_width'] = $input['section_fbtw_timeline_width'];

        if (isset($input['section_fbtw_timeline_height']))
            $new_input['section_fbtw_timeline_height'] = $input['section_fbtw_timeline_height'];
        
        if (isset($input['section_button_position']))
            $new_input['section_button_position'] = $input['section_button_position'];
        
        if (isset($input['section_visible_on_minimum_device_width']))
            $new_input['section_visible_on_minimum_device_width'] = $input['section_visible_on_minimum_device_width'];

        return $new_input;
    }

    /**
     * Print the Section text
     */
    public function print_section_facebook_feeds() {
        print '<a href="https://developers.facebook.com/docs/plugins/page-plugin" target="_blank">Facebook page settings</a>';
    }

    public function print_section_twitter_feeds() {
        print '<a href="https://dev.twitter.com/web/embedded-timelines" target="_blank">Twitter timeline settings</a>';
    }

    public function print_setting_section_styles() {
        //print 'CSS settings';
    }

    /*     * **********************************************************************************
     *
     *  Get the settings option array and print one of its values description
     * 
     * *********************************************************************************** */

    // Section facebook app id  
    public function section_facebook_app_id_callback() {
        printf(
                '<input type="text" id="section_facebook_app_id" name="facebook_twitter_feeds_options[section_facebook_app_id]" value="%s" placeholder="Facebook app id" /><span class="description"> Add your facebook app id. This is optional.</span>', isset($this->options['section_facebook_app_id']) ? esc_attr($this->options['section_facebook_app_id']) : ''
        );
    }
    
    // Section facebook page url
    public function section_facebook_page_url_callback() {
        printf(
                '<input type="text" id="section_facebook_page_url" name="facebook_twitter_feeds_options[section_facebook_page_url]" value="%s" placeholder="Facebook page url" /><span class="description"> Add your facebook page url eg. https://www.facebook.com/facebook.</span>', isset($this->options['section_facebook_page_url']) ? esc_attr($this->options['section_facebook_page_url']) : ''
        );
    }

    // Section facebook tabs
    public function section_facebook_tabs_callback() {
        $selected = isset($this->options['section_facebook_tabs']) ? esc_attr($this->options['section_facebook_tabs']) : '';
        ?>
        <select id="section_button_position" name="facebook_twitter_feeds_options[section_facebook_tabs]"><option value="timeline" <?php echo selected($selected, 'timeline'); ?>>Timeline</option><option value="events" <?php echo selected($selected, 'events'); ?>>Events</option><option value="messages" <?php echo selected($selected, 'messages'); ?>>Messages</option></select>
        <span class="description">Please select tabs.</span>
        <?php        
    }

    // Section facebook small header
    public function section_facebook_small_header_callback() {
        printf(
                '<input type="checkbox" id="section_facebook_small_header" name="facebook_twitter_feeds_options[section_facebook_small_header]" value="1"' . checked( 1, $this->options['section_facebook_small_header'], false ) . '/>'
        );
    }

    // Section facebook hide cover photo
    public function section_facebook_hide_cover_photo_callback() {
        printf(
                '<input type="checkbox" id="section_facebook_hide_cover_photo" name="facebook_twitter_feeds_options[section_facebook_hide_cover_photo]" value="1"' . checked( 1, $this->options['section_facebook_hide_cover_photo'], false ) . '/>'
        );
    }

    // Section facebook adapt to plugin container width
//    public function section_facebook_adapt_to_plugin_container_width_callback() {
//        printf(
//                '<input type="checkbox" id="section_facebook_adapt_to_plugin_container_width" name="facebook_twitter_feeds_options[section_facebook_adapt_to_plugin_container_width]" value="1"' . checked( 1, $this->options['section_facebook_adapt_to_plugin_container_width'], false ) . '/>'
//        );
//    }

    // Section facebook show friends faces
    public function section_facebook_hide_friends_faces_callback() {
        printf(
                '<input type="checkbox" id="section_facebook_hide_friends_faces" name="facebook_twitter_feeds_options[section_facebook_hide_friends_faces]" value="1"' . checked( 1, $this->options['section_facebook_hide_friends_faces'], false ) . '/>'
        );
    }

    // Section Twitter Feeds
    public function section_twitter_username_callback() {
        printf(
                '<input type="text" id="section_twitter_username" name="facebook_twitter_feeds_options[section_twitter_username]" value="%s" placeholder="Twitter username" /><span class="description">Add your twitter account username eg. TwitterDev.</span>', isset($this->options['section_twitter_username']) ? esc_attr($this->options['section_twitter_username']) : ''
        );
    }
    
    // Section twitter follow button
    public function section_twitter_follow_button_callback() {
        printf(
                '<input type="checkbox" id="section_twitter_follow_button" name="facebook_twitter_feeds_options[section_twitter_follow_button]" value="1"' . checked( 1, $this->options['section_twitter_follow_button'], false ) . '/>'
        );
    }
    
    // Section twitter follow button
    public function section_twitter_follow_button_count_hide_callback() {
        printf(
                '<input type="checkbox" id="section_twitter_follow_button_count_hide" class="show-hide-tw-follow" name="facebook_twitter_feeds_options[section_twitter_follow_button_count_hide]" value="1"' . checked( 1, $this->options['section_twitter_follow_button_count_hide'], false ) . '/>'
        );
    }
    
    // Section twitter follow button
    public function section_twitter_follow_button_username_hide_callback() {
        printf(
                '<input type="checkbox" id="section_twitter_follow_button_username_hide" class="show-hide-tw-follow" name="facebook_twitter_feeds_options[section_twitter_follow_button_username_hide]" value="1"' . checked( 1, $this->options['section_twitter_follow_button_username_hide'], false ) . '/>'
        );
    }
    
    // Section twitter follow button
    public function section_twitter_follow_button_large_callback() {
        printf(
                '<input type="checkbox" id="section_twitter_follow_button_large" class="show-hide-tw-follow" name="facebook_twitter_feeds_options[section_twitter_follow_button_large]" value="1"' . checked( 1, $this->options['section_twitter_follow_button_large'], false ) . '/>'
        );
    }       
   
    // Section Facebook Twitter Timeline Width
    public function section_fbtw_timeline_width_callback() {
        printf(
                '<input type="text" id="section_fbtw_timeline_width" name="facebook_twitter_feeds_options[section_fbtw_timeline_width]" value="%s" placeholder="Facebook Twitter timeline width" /><span class="description">Please insert width eg. 240.</span>', isset($this->options['section_fbtw_timeline_width']) ? esc_attr($this->options['section_fbtw_timeline_width']) : ''
        );
    }
    
    // Section Facebook Twitter Timeline Height
    public function section_fbtw_timeline_height_callback() {
        printf(
                '<input type="text" id="section_fbtw_timeline_height" name="facebook_twitter_feeds_options[section_fbtw_timeline_height]" value="%s" placeholder="Facebook Twitter timeline height" /><span class="description">Please insert height eg. 214.</span>', isset($this->options['section_fbtw_timeline_height']) ? esc_attr($this->options['section_fbtw_timeline_height']) : ''
        );
    } 
    
    // Section Button Position
    public function section_button_position_callback() {
        $selected = isset($this->options['section_button_position']) ? esc_attr($this->options['section_button_position']) : '';
        ?>
        <select id="section_button_position" name="facebook_twitter_feeds_options[section_button_position]"><option value="left" <?php echo selected($selected, 'left'); ?>>Left</option><option value="right" <?php echo selected($selected, 'right'); ?>>Right</option></select>
        <?php
    }
    
    // Section Button Visible on Devices
    public function section_visible_on_minimum_device_width_callback() {
        printf(
                '<input type="text" id="section_visible_on_minimum_device_width" name="facebook_twitter_feeds_options[section_visible_on_minimum_device_width]" value="%s" placeholder="Minimum device width 768" /><span class="description">Please insert device minimum width eg. 768</span>', isset($this->options['section_visible_on_minimum_device_width']) ? esc_attr($this->options['section_visible_on_minimum_device_width']) : ''
        );
    }
}

/* * **Class End here**** */

if (is_admin())
    $sdfbtwPageSetting = new sdfbtwPageSettings();
