<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Login panel application asset bundle.
 */
class ErrorAsset extends AssetBundle
{
    public $basePath = '@webroot';

    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}