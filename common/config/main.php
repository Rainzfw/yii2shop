<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        //基于角色的权限管理 必须创建在common的配置文件中
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],
    ],
];
