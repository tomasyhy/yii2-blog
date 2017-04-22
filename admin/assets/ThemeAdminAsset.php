<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Login panel application asset bundle.
 */
class ThemeAdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '/themes';

    public $css = [
        'admin/assets/global/plugins/bootstrap-summernote/summernote.css',
    ];

    public $js = [
        'admin/assets/global/plugins/bootstrap-summernote/summernote.min.js',
    ];

}