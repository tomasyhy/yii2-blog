<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class HighlightAsset extends AssetBundle {

    public $sourcePath = '@vendor/components/highlightjs';

    public $css = [
        'styles/github.css',
    ];

    public $js = [
        'highlight.pack.min.js',
    ];
}