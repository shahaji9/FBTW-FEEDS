/*
    Frontend Javascript
    Created on : 13 December, 2016, 11:53:40 AM
    Author     : Shahaji Deshmukh
*/
(function ($) {
    
    //Get dynamic data using sdftvars object
    var appID = sdftvars.app_id;
    var btnPosition = sdftvars.btn_position;
    var visibleDeviceWidth = sdftvars.visible_on_device;
    var fbtw_wrapper_width = sdftvars.fbtw_wrapper_width;
    var fbtw_wrapper_height = sdftvars.fbtw_wrapper_height;

    var onResizing = function(e) {
        if ((window.innerWidth > visibleDeviceWidth))  {
            $('#fb-tw-feeds').css({display: 'block'});
        } else {
            $('#fb-tw-feeds').css({display: 'none'});
        }
    };

    window.onresize = onResizing;
    window.onload = onResizing;
    
    $(document).ready(function () {
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=" + appID;
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        
        $('#fb-tw-feeds .facebook_twitter_common').css({width: fbtw_wrapper_width, height: fbtw_wrapper_height});
        
        if(btnPosition === 'left'){
            $('#fb-tw-feeds').css('left', '0px');
            $('#fb-tw-feeds .facebook_twitter_common').css({left: '-' + fbtw_wrapper_width + 'px'});
            $('#fb-tw-feeds .facebook_twitter_common .fb-tw-icons').css({float: 'right', right: '-34px'});
            $('#fb-tw-feeds .facebook_feeds .facebook_box, #fb-tw-feeds .twitter_feeds .twitter_box').css('float', 'left');            
        } else {
            $('#fb-tw-feeds').css('right', '0px');
            $('#fb-tw-feeds .facebook_twitter_common').css({right: '-' + fbtw_wrapper_width + 'px'});
            $('#fb-tw-feeds .facebook_twitter_common .fb-tw-icons').css({float: 'left', left: '-34px'});
            $('#fb-tw-feeds .facebook_feeds .facebook_box, #fb-tw-feeds .twitter_feeds .twitter_box').css('float', 'right');            
        }
    });

    // Facebook twitter feeds functionality works after page load
    $(window).load(function () {
        
        $('#fb-tw-feeds .facebook_twitter_common').mouseenter(function () {
            if(btnPosition === 'left'){
                $(this).stop(true, false).animate({left: "0"}, 800);
            } else {
                $(this).stop(true, false).animate({right: "0"}, 800);
            }
        }).mouseleave(function () {
            if(btnPosition === 'left'){
                $("#fb-tw-feeds .facebook_twitter_common").stop(true, false).animate({left: '-' + fbtw_wrapper_width}, 800);
            } else {
                $("#fb-tw-feeds .facebook_twitter_common").stop(true, false).animate({right: '-' + fbtw_wrapper_width}, 800);
            }
        });
    });
})(jQuery);