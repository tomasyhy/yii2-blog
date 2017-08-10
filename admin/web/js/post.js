$(document).ready(function () {
    hljs.initHighlightingOnLoad();

    $('#summernote').summernote({
        height: 500,
        prettifyHtml: false,
        tabsize: 2,
        codemirror: {
            "mode": "text/html",
            "htmlMode": true,
            "lineNumbers": true,
            "theme": "monokai",
            "width": "100px",
            "textWrapping": true
        },
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr']],
            ['view', ['fullscreen', 'codeview']],
            ['help', ['help']],
            ['highlight', ['highlight']],
            ['insert', ['gxcode']],
        ]
    });

});
