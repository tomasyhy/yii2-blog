<?php

namespace admin\assets;

use yii\web\AssetBundle;

class HighlightAsset extends AssetBundle {

    public $sourcePath = '@vendor/components/highlightjs';

    public $css = [
        'styles/ocean.css',
    ];

    public $js = [
        'highlight.pack.min.js',
    ];
}