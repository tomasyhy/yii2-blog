$(document).ready(function () {
    hljs.initHighlightingOnLoad();

    $('#summernote').summernote({
        height: 500,
        prettifyHtml:false,
        callbacks: {
            onChange: function (contents, $editable) {
                hljs.initHighlighting.called = false;
                hljs.initHighlighting();
            },
        },
    });

});
