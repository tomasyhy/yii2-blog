<?php
return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=blog',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
    ],
];
