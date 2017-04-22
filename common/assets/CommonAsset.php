<?php

namespace common\assets;

use yii\web\AssetBundle;

    /**
     * Main application asset bundle.
     */
class CommonAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/themes';

    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'admin/assets/global//plugins/simple-line-icons/simple-line-icons.min.css',
        'admin/assets/global/plugins/font-awesome/css/font-awesome.min.css',
        'admin/assets/global/plugins/bootstrap/css/bootstrap.min.css',
        'admin/assets/global/css/components-md.min.css',
        'admin/assets/layouts/layout4/css/layout.min.css',
        'admin/assets/layouts/layout4/css/themes/default.min.css',
        'admin/assets/layouts/layout4/css/custom.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}