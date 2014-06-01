$(document).ready(function() {
    $("#click_video").click(function() {
        $('#video_choose').fadeIn('slow');
        $('#container_buttons').fadeOut('slow');
    });
    $("#click_image").click(function() {
        $('#image_choose').fadeIn('slow');
        $('#container_buttons').fadeOut('slow');
    });
    $("#button_vimeo").click(function() {
        $('#button_youtube').fadeOut('slow');
        $('#button_vimeo').fadeOut('slow');
        $('#video_choose > h2').fadeOut('slow');
        $('#vimeo').fadeIn('slow');
    });
    $("#button_youtube").click(function() {
        $('#button_youtube').fadeOut('slow');
        $('#button_vimeo').fadeOut('slow');
        $('#video_choose > h2').fadeOut('slow');
        $('#youtube').fadeIn('slow');
    });
    $("#submit_image").click(function() {
        if ($("#image_title").val().replace(/ /g, "") && $("#image_description").val().replace(/ /g, "") && $("input:radio[name=radio-input]").val()) {
            $.get('helper/image_upload.php', {title: $("#image_title").val(), description: $("#image_description").val(), article: $("#folder").val(), thumbnail: $("input:radio[name=radio-input]:checked").val()}, function(data) {
                $('content').empty();
                $('content').append(data);
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        }
    });
    $("#submit_vimeo").click(function() {
        if ($("#vimeo_title").val().replace(/ /g, "") && $("#vimeo_description").val().replace(/ /g, "") && $("#vimeo_uri").val().replace(/ /g, "")) {
            $.get('helper/video_handler.php', {title: $("#vimeo_title").val(), description: $("#vimeo_description").val(), article: $("#folder").val(), video_id: $("#vimeo_uri").val().replace(/ /g, ""), video_type: 'vimeo'}, function(data) {
                $('content').empty();
                $('content').append(data);
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        }
    });
    $("#submit_youtube").click(function() {
        if ($("#youtube_title").val().replace(/ /g, "") && $("#youtube_description").val().replace(/ /g, "") && $("#youtube_uri").val().replace(/ /g, "")) {
            $.get('helper/video_handler.php', {title: $("#youtube_title").val(), description: $("#youtube_description").val(), article: $("#folder").val(), video_id: $("#youtube_uri").val().replace(/ /g, ""), video_type: 'youtube'}, function(data) {
                $('content').empty();
                $('content').append(data);
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        }
    });
     $("#update_image").click(function() {
        if ($("#image_title").val().replace(/ /g, "") && $("#image_description").val().replace(/ /g, "") && $("input:radio[name=radio-input]").val()) {
            $.get('helper/update_article.php', {title: $("#image_title").val(), description: $("#image_description").val(), article: $("#folder").val(), thumbnail: $("input:radio[name=radio-input]:checked").val()}, function(data) {
                $('content').empty();
                $('content').append(data);
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        }
    });
    $("#update_vimeo").click(function() {
        if ($("#vimeo_title").val().replace(/ /g, "") && $("#vimeo_description").val().replace(/ /g, "") && $("#vimeo_uri").val().replace(/ /g, "")) {
            $.get('helper/update_article.php', {title: $("#vimeo_title").val(), description: $("#vimeo_description").val(), article: $("#folder").val(), video_id: $("#vimeo_uri").val().replace(/ /g, ""), video_type: 'vimeo'}, function(data) {
                $('content').empty();
                $('content').append(data);
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        }
    });
    $("#update_youtube").click(function() {
        if ($("#youtube_title").val().replace(/ /g, "") && $("#youtube_description").val().replace(/ /g, "") && $("#youtube_uri").val().replace(/ /g, "")) {
            $.get('helper/update_article.php', {title: $("#youtube_title").val(), description: $("#youtube_description").val(), article: $("#folder").val(), video_id: $("#youtube_uri").val().replace(/ /g, ""), video_type: 'youtube'}, function(data) {
                $('content').empty();
                $('content').append(data);
                $("html, body").animate({scrollTop: 0}, "slow");
            });
        }
    });
});