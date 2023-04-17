jQuery(function ($) {
    var dateFormat = "mm/dd/yy";
    setUpDateField();
    $(document).on('click', '.add-collapse', function (e) {
        var id = $(this).data('id');
        var cms_collapse_ele = cms_collapse[id];
        var panel = $('#' + id).find('.panel');
        var last_panel = (panel.length > 0) ? panel[panel.length - 1] : '';
        var number = (last_panel !== '') ? (parseInt($(last_panel).data('number')) + 1) : 0;
        var new_collapse = cms_collapse_ele.template;
        new_collapse = new_collapse.replaceAll('{{number}}', number);
        new_collapse = new_collapse.replaceAll('{{id}}', cms_collapse_ele.field.id + number);
        new_collapse = new_collapse.replaceAll('{{title}}', cms_collapse_ele.field.title + ' ' +number);
        for (var i = 0; i < cms_collapse_ele.field.fields.length; i++) {
            if(cms_collapse_ele.field.fields[i].type == 'date_range'){
                new_collapse = new_collapse.replaceAll('{{' + cms_collapse_ele.field.fields[i].name + '_date_from' + '}}', cms_collapse_ele.field.name + '[' + number + ']' + '[' + cms_collapse_ele.field.fields[i].name + ']' + '[date_from]');
                new_collapse = new_collapse.replaceAll('{{' + cms_collapse_ele.field.fields[i].name + '_date_to' + '}}', cms_collapse_ele.field.name + '[' + number + ']' + '[' + cms_collapse_ele.field.fields[i].name + ']' + '[date_to]');
            }
            else{
                new_collapse = new_collapse.replaceAll('{{' + cms_collapse_ele.field.fields[i].name + '}}', cms_collapse_ele.field.name + '[' + number + ']' + '[' + cms_collapse_ele.field.fields[i].name + ']');
            }
        }
        $('#' + id).append(new_collapse);
        setUpDateField();
    });
    $(document).on('click', '.delete-collapse', function () {
        $(this).parents('.panel').remove();
    });

    function getDate( element ) {
        var date;
        try {
            date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
            date = null;
        }

        return date;
    }

    function setUpDateField(){
        if($(".panel-group .datepicker").length > 0){
            $(".panel-group .datepicker").datepicker("destroy");
            $(".panel-group .datepicker").datepicker({
                dateFormat: dateFormat,
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true
            });
            $( ".panel-group .datepicker.date_from" ).datepicker(
                "option", "defaultDate", "+1w"
            ).on( "change", function() {
                $(this).next().datepicker( "option", "minDate", getDate( this ) );
            });
            $( ".panel-group .datepicker.date_to" ).datepicker(
                "option", "defaultDate", "+1w"
            ).on( "change", function() {
                $(this).prev().datepicker( "option", "maxDate", getDate( this ) );
            });

            // load first time
            var date_from_s = $( ".panel-group .datepicker.date_from" );
            var date_to_s = $( ".panel-group .datepicker.date_to" );
            $.each(date_from_s, function(index, item){
                $(item).next().datepicker( "option", "minDate", getDate( item ) );
            });
            $.each(date_to_s, function(index, item){
                $(item).prev().datepicker( "option", "maxDate", getDate( item ) );
            });
        }
    }
});

String.prototype.replaceAll = function (search, replacement) {
    var target = this;
    return target.replace(new RegExp(search, 'g'), replacement);
};