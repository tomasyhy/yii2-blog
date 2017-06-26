$(document).ready(function () {

        $('.blog-main').on('click', ".hide-form", function (event) {
            makeAction($(this), event);
        });
        $('.blog-main').on('click', ".show-form", function (event) {
            makeAction($(this), event);

        });

        function makeAction(button, event) {
            event.preventDefault();
            var replayForm = button.closest('.media-body').find('.replay-form').eq(0);
            if (button.hasClass('hide-form')) {
                replayForm.addClass('hide');
                replayForm.find('form').trigger('reset');
            } else {
                replayForm.removeClass('hide');
            }
        }

    }
);
