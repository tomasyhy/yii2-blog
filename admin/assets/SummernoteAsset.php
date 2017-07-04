<?php

namespace admin\assets;

use yii\web\AssetBundle;

class SummernoteAsset extends AssetBundle {

    public $sourcePath = '@vendor/summernote/summernote/dist';

    public $css = [
        'summernote.css',
    ];


    public $js = [
        'summernote.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}