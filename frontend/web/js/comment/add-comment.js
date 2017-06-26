$(document).ready(function () {
    var commentFormClass = '.comment-form';
    $('.blog-main').on('beforeSubmit', commentFormClass, function (event) {
        event.preventDefault();
        var commentForm = $(this).closest(commentFormClass);
        $.ajax({
            method: 'POST',
            url: commentForm.attr('action'),
            data: commentForm.serialize(),
            dataType: 'json',
        }).done(function (response) {
            if (response['status'] == 'success') {
                commentForm.trigger('reset');
                $.pjax.reload({container: '#comments-pjax'});
            } else {
                alert('An error occurred');
            }
        }).fail(function() {
            alert('An error occurred');
        });
        return false;
    }).on('submit', function(e){
            e.preventDefault();
        });


});
