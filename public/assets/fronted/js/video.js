jQuery(document).ready(function() {
    "use strict";

    if (!device.tablet() && !device.mobile()) {

        (function($) {
            "use strict";
            // initialize BigVideo
            var BV = new $.BigVideo(),
                video = $('#bgimg').attr('data-video');
            BV.init();
            BV.show(video, { ambient: true });
            jQuery("#play_video").click(function() {
                BV.getPlayer().play();
            });
            jQuery("#pause_video").click(function() {
                BV.getPlayer().pause();
            });
            jQuery("#mute_video").click(function() {
                BV.getPlayer().volume(0);
                jQuery("#mute_video").addClass('d-none');
                setTimeout(function() {
                    jQuery("#unmute_video").removeClass('d-none');
                }, 500);
            });

            jQuery("#unmute_video").click(function() {
                BV.getPlayer().volume(1);
                jQuery("#unmute_video").addClass('d-none');
                setTimeout(function() {
                    jQuery("#mute_video").removeClass('d-none');
                }, 500);
            });
        })(jQuery);

    } else {

        $('#bgimg').addClass('poster-image');
        var poster_image = $('#bgimg').attr('data-poster');
        $('#bgimg').css('background-image', 'url(' + poster_image + ')');
        $('.video-controls').fadeOut();

    }

});