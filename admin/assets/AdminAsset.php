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
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
//        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $js = [
        ['js/main.js', 'position' => \yii\web\View::POS_END],
    ];

}
