;(function ($) {
    "use strict";

    var post_formats = typeof post_format !== 'undefined' ? post_format.post_formats : [];
    setTimeout(function () {
        $(".postbox[id*='post_format_']").css('display', 'none');
        if (typeof post_formats !== 'undefined' && post_formats.length !== '') {
            $("#post_format_" + post_formats).css('display', 'block');
        }
    }, 1000);
    $(document).on('click', '.post-format', function () {
        $(".postbox[id*='post_format_']").css('display', 'none');
        $("#post_format_" + $(this).val()).css('display', 'block');
    });
    $(document).on('change', '[id*="post-format-selector"]', function () {
        $(".postbox[id*='post_format_']").css('display', 'none');
        $("#post_format_" + $(this).val()).css('display', 'block');
    });
})(jQuery);

