<?php
/*
    Frontend code
    Created on : 13 December, 2016, 11:53:40 AM
    Author     : Shahaji Deshmukh
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

//Insert buttons into the footer before </body> tag
function sdfbtw_custom_function() {
    
    global $fb_tw_options;
    
    if( isset($fb_tw_options['section_general_settings_hide_from_homepage']) ){
        if( !is_home() && !is_front_page() ){
            show_fbtw_feeds();
        }
    } else {
        show_fbtw_feeds();
    }
}

add_action('wp_footer', 'sdfbtw_custom_function');


function show_fbtw_feeds() {
	
	global $fb_tw_options, $fbtw_timeline_width, $fbtw_timeline_height; ?>
	
	<div id="fb-tw-feeds">
        <?php if(isset($fb_tw_options['section_facebook_page_url']) && $fb_tw_options['section_facebook_page_url'] != ''){ ?>
            <div id="facebook" class="facebook_feeds facebook_twitter_common">
                <div id="facebook_icon" class="fb-tw-icons"></div>
                <div class="facebook_box">
                    <div id="fb-root"></div>
                    <div class="fb-page" data-href="<?php echo $fb_tw_options['section_facebook_page_url']; ?>" data-tabs="<?php echo ($fb_tw_options['section_facebook_tabs']) ? $fb_tw_options['section_facebook_tabs'] : 'timeline'; ?>" data-width="<?php echo $fbtw_timeline_width; ?>" data-height="<?php echo $fbtw_timeline_height; ?>" data-small-header="<?php echo ($fb_tw_options['section_facebook_small_header']) ? 'true' : 'false'; ?>" data-adapt-container-width="false" data-hide-cover="<?php echo ($fb_tw_options['section_facebook_hide_cover_photo']) ? 'true' : 'false'; ?>" data-show-facepile="<?php echo ($fb_tw_options['section_facebook_hide_friends_faces']) ? 'flase' : 'true'; ?>"> </div>
                </div>
            </div>
        <?php }
        
        $username = ($fb_tw_options['section_twitter_username']) ? $fb_tw_options['section_twitter_username'] : '';
        if(isset($username) && $username != ''){ ?>
            <div id="twitter" class="twitter_feeds facebook_twitter_common">
                <div id="twitter_icon" class="fb-tw-icons"></div>
                <div class="twitter_box">
                    <?php                
                    if(isset($fb_tw_options['section_twitter_follow_button']) && $fb_tw_options['section_twitter_follow_button'] == '1'){ ?>
                        <div class="twitter-follow-box">
                            <a class="twitter-follow-button" data-show-count="<?php echo ($fb_tw_options['section_twitter_follow_button_count_hide']) ? 'false' : 'true'; ?>" data-show-screen-name="<?php echo ($fb_tw_options['section_twitter_follow_button_username_hide']) ? 'false' : 'true'; ?>" data-size="<?php echo ($fb_tw_options['section_twitter_follow_button_large']) ? 'large' : ''; ?>" href="https://twitter.com/<?php echo $username; ?>">Follow @<?php echo $username; ?></a>
                        </div>
                    <?php } ?>                
                    <a class="twitter-timeline" data-width="<?php echo $fbtw_timeline_width; ?>" data-height="<?php echo $fbtw_timeline_height; ?>" href="https://twitter.com/<?php echo $username; ?>">Tweets by <?php echo $username; ?></a>
                    <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        <?php } ?>
    </div>
<?php
}
