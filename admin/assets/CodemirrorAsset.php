<?php

namespace admin\assets;

use yii\web\AssetBundle;

class CodemirrorAsset extends AssetBundle {

    public $sourcePath = '@vendor/thebingservices/codemirror/CodeMirror';

    public $css = [
        'lib/codemirror.css',
        'theme/monokai.css',
    ];

    public $js = [
        'lib/codemirror.js',
        'mode/javascript/javascript.js',
        'mode/xml/xml.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}