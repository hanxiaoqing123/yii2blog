<?php

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'helper' => [
            'class' => 'common\components\Helper',
            'property' => '123',
        ],
        // 配置数据库
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii2blog',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 24 * 3600,
            'schemaCache' => 'cache',
        ],
        "authManager" => [
            "class" => 'yii\rbac\DbManager',
        ],
    ],
    // 配置语言
    'language' => 'zh-CN',
    // 配置时区
    'timeZone' => 'Asia/Chongqing',
];
