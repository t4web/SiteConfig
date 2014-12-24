$(function() {
    $('#config-values button').click(function() {
        var $input = $(this).parent().parent().find('input');

        $.ajax({
            url: '/admin/site-config/save',
            type: 'POST',
            data: {
                name: $input.attr('name'),
                value: $input.val()
            },
            success: function(response) {
            },
            error: function(response) {
                alert(response.message);
            }
        });
    });
});