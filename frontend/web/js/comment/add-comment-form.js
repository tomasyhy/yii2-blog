$(document).ready(function () {

        $('.comments-content').on('click', ".hide-form", function (event) {
            makeAction($(this), event);
        });
        $('.comments-content').on('click', ".show-form", function (event) {
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
