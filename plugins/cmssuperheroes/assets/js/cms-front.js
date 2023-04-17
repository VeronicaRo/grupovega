(function ($) {
    var _inline_css = "<style>";
    $(document).find('div.cms-inline-css').each(function () {
        var _this = $(this);
        _inline_css += _this.attr("data-css") + " ";
        _this.remove();
    });
    _inline_css += "</style>";
    $('head').append(_inline_css);

    var _ct = "";
    $(document).find('div.cms-ct-to-head').each(function () {
        var _this = $(this);
        _ct += _this.attr("data-ct") + " ";
        _this.remove();
    });
    $('head').append(_ct);

    var subMegamenu = $('.sub-megamenu');
    $.each(subMegamenu, function (index, megamenu) {
        megamenu = $(megamenu);
        if (megamenu.find('.menu .current-menu-item').length > 0) {
            megamenu.parents('.megamenu').addClass('current-menu-ancestor current-menu-parent');
        }
    });
})(jQuery);