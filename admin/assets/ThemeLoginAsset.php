<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Login panel application asset bundle.
 */
class ThemeLoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/themes';

    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'admin/assets/global/css/components-md.css',
        'admin/assets/pages/css/login.css',
    ];
}