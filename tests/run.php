<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

$config = [
    'id' => 'yii2-papertrail-log-target',
    'basePath' => __DIR__,
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'targets' => [
                [
                    'class' => Rekurzia\Log\PapertrailTarget::class,
                    'levels' => ['error', 'warning'],
                    'host' => '0.0.0.0',
                    'port' => '1234',
                ],
            ]
        ]
    ]
];

(new yii\web\Application($config))->run();
