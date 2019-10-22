<?php

use app\behavior\UserRestBehavior;
use yii\console\controllers\MigrateController;
use yii\di\Container;
use yii\rbac\DbManager;
use yii\web\User;

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'auth'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'modules' => [
        'auth' => [
            'class' => \maniakalen\auth\Module::class
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'authManager' => [
            'class' => DbManager::class,
            'defaultRoles' => ['guest'], // here define your roles
        ],
        'db' => $db,
    ],
    'params' => $params,
    'controllerMap' => [
        'migrate' => [
            'class' => MigrateController::class,
            'migrationPath' => null,
            'migrationNamespaces' => [
                'app\migrations',
            ],
        ],
    ],
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
