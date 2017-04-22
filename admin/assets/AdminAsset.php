<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Main admin application asset bundle.
 */
class AdminAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site.css',
        'libraries/highlight/styles/darcula.css'
    ];

    public $js = [
        'libraries/highlight/highlight.pack.js',
        ['js/main.js', 'position' => \yii\web\View::POS_BEGIN],
    ];

}
