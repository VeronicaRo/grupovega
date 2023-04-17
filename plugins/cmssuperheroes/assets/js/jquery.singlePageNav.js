/**
 * One page new version
 * @author KP
 * @version 1.0.0
 */
(function ($, window, document, undefined) {
    "use strict";
    if (typeof(one_page_options) != "undefined") {
        one_page_options.speed = parseInt(one_page_options.speed);
        $('.is-one-page').on('click', function (e) {
            var _this = $(this);
            var _link = $(this).attr('href');
            var _id_data = e.currentTarget.hash;
            var _offset;
            var _data_offset = $(this).attr('data-onepage-offset');
            if(_data_offset) {
                _offset = _data_offset;
            } else {
                _offset = 0;
            }
            if ($(_id_data).length === 1) {
                var _target = $(_id_data);
                $('.cms-onepage-active').removeClass('cms-onepage-active');
                _this.addClass('cms-onepage-active');
                $('html, body').stop().animate({ scrollTop: _target.offset().top - _offset }, one_page_options.speed);   
                return false;
            } else {
                window.location.href = _link;
            }
            return false;
        });
    }

})(jQuery, window, document);
