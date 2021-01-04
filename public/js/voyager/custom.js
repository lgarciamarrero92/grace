$('select.select2-ajax').each(function() {
    $(this).select2({
        width: '100%',
        ajax: {
            url: $(this).data('get-items-route'),
            data: function (params) {
                var query = {
                    search: params.term,
                    type: $(this).data('get-items-field'),
                    method: $(this).data('method'),
                    id: $(this).data('id'),
                    page: params.page || 1
                }
                return query;
            }
        }
    });

    $(this).on('select2:select',function(e){
        var data = e.params.data;
        if (data.id == '') {
            // "None" was selected. Clear all selected options
            $(this).val([]).trigger('change');
        }else{
            var id = data.id;
            var option = $(e.target).children('[value='+id+']');
            option.detach();
            $(e.target).append(option).change();
        }
    });

    $(this).on('select2:unselect',function(e){
        var data = e.params.data;
        $(e.currentTarget).find("option[value='" + data.id + "']").attr('selected',false);
    });
});