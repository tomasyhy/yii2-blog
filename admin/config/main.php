<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-admin',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
//    'layout' => '@app/views/layouts/main',
    'aliases' => [
        '@admin' => '@common/../admin'
    ],
    'name' => 'Blog',
    'defaultRoute' => 'post',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'enablePasswordRecovery' => false,
            'enableRegistration' => false,
            'admins' => ['admin'],
            'urlPrefix' => '',
            'controllerMap' => [
                'security' => [
                    'class' => 'dektrium\user\controllers\SecurityController',
                    'layout' => '@admin/views/layouts/login.php',
                ],
            ],
        ],
        'noty' => [
            'class' => 'lo\modules\noty\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/admin',
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views/security' => '@admin/views/site',
                ],
            ],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'scriptUrl' => '/admin/index.php',
            'rules' => [
                '<controller>' => '<controller>/index',
                '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
            ]
        ],
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],

    ],
    'params' => $params,
];
