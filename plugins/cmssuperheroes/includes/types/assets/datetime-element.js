!function($) {
    $('.date-field').each(function() {
        "use strict";
        var data_type = jQuery(this).attr('data-type');
        var data_format = jQuery(this).attr('data-format');
        switch (data_type) {
            case 'date':
                jQuery(this).find('input').datetimepicker({
                    format: data_format,
                    timepicker:false
                });
                break;
            case 'time':
                jQuery(this).find('input').datetimepicker({
                    format: data_format,
                    datepicker:false
                });
                break;
            default:
                jQuery(this).find('input').datetimepicker({
                    format: data_format
                });
                break;
        }
    });

}(window.jQuery);