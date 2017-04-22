$(document).ready(function () {
    $('.page-content').on('click', 'a.ajax-action', function (event) {
        event.preventDefault();
        var button = $(this);
        var element = $(this).data('element');
        var confirmation = $(this).data('confirmation');
        krajeeDialog.confirm(confirmation, function (output) {
            if (output) {
                $.ajax(
                    {
                        type: 'POST',
                        url: button.attr('href'),
                        dataType: "json"
                    }
                ).success(function (response) {
                    if (response == 'success') {
                        $.pjax.reload({container: '#' + element + '-pjax'});
                    }
                });
            }
        });
        return false;
    });
});
