/*
    Admin Side Javascript
    Created on : 13 December, 2016, 11:53:40 AM
    Author     : Shahaji Deshmukh
*/
(function ($) {
    $(document).ready(function () {
        
        if($('#section_twitter_follow_button').is(':checked')){
            $('.follow-btn-show-hide').show();
        }
        
        $(document).on('click', '#section_twitter_follow_button', function () {
            $('.follow-btn-show-hide').toggle(this.checked);
        });        
    });
})(jQuery);