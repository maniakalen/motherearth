<?php

use app\behavior\UserRestBehavior;
use app\controllers\LoginController;
use app\controllers\RestController;
use app\models\User;
use yii\di\Container;

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'auth'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'homeUrl' => ['/admin/index'],
    'defaultRoute' => 'admin',
    'modules' => [
        'auth' => [
            'class' => \maniakalen\auth\Module::class,
            'components' => [
                'controlManager' => [
                    'class' => \maniakalen\auth\models\AuthControlManager::class,
                    'userClass' => User::class
                ]
            ]
        ]
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '0qjW2FBBzWs7ijcue62Xd9PTcs-0bVn5',
            'enableCsrfValidation'   => false,
        ],
        'authManager' => [
            'class' => '\yii\rbac\DbManager',
            'defaultRoles' => ['guest'], // here define your roles
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/admin/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        '/bootstrap/css/bootstrap.css',
                        '/bootstrap/css/bootstrap-grid.css',
                        '/bootstrap/css/bootstrap-reboot.css'
                    ]
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        '/bootstrap/js/bootstrap.bundle.min.js',
                    ]
                ]
            ]
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['users' => 'rest_users'],
                    'prefix' => 'api',
                    'suffix' => '.json'
                ],
                'api/login' => 'login/login',
                'api/logout' => 'login/logout',
                [
                    'pattern' => 'auth/rbac/<action>',
                    'route' => 'auth/rbac/<action>',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'admin/<action(login|logout|index|dashboard)>',
                    'route' => 'admin/<action>',
                    'suffix' => '.html',
                ],
                [
                    'pattern' => 'admin/user/create',
                    'route' => 'user/details',
                    'suffix' => '.html',
                    'verb' => 'GET'
                ],
                [
                    'pattern' => 'admin/user/create',
                    'route' => 'user/create',
                    'suffix' => '.html',
                    'verb' => 'POST'
                ],
                [
                    'pattern' => 'admin/<controller>/<action>',
                    'route' => '<controller>/<action>',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => '/',
                    'route' => 'admin/index',
                    'suffix' => '.html',
                ],
            ],
        ],

    ],
    'container' => [
        'definitions' => [
            'yii\web\User' => [
                'class' => \yii\web\User::class,
                'as rest' => [
                    'class' => UserRestBehavior::class
                ]
            ],
            'maniakalen\widgets\Flash' => [
                'class' => 'app\widgets\Alert'
            ]
        ]
    ],
    'controllerMap' => [
        'rest_users' => [
            'class' => RestController::class,
            'modelClass' => User::class
        ],
        'login' => [
            'class' => LoginController::class,
        ],
        'user' => [
            'class' => 'maniakalen\admingui\controllers\AdminController',
            'actionsMap' => [
                'index' => [
                    'class' => 'maniakalen\admingui\actions\Grid',
                    'createActionRoute' => ['details'],
                    'title' => 'Users',
                    'manager' => [
                        'class' => 'maniakalen\admingui\components\ModelManager',
                        'model' => 'app\models\User'
                    ]
                ],
                'details' => [
                    'class' => 'maniakalen\admingui\actions\Details',
                    'title' => 'Details',
                    'params' => ['breadcrumbs' => [['url' => ['index'], 'title' => 'Users']]],
                    'manager' => [
                        'class' => 'maniakalen\admingui\components\ModelManager',
                        'model' => 'app\models\User'
                    ]
                ],
                'edit' => [
                    'class' => 'maniakalen\admingui\actions\Update',
                    'manager' => [
                        'class' => 'app\models\UserModelManager',
                        'model' => 'app\models\User'
                    ],
                    'redirect' => 'details',
                    'messages' => [
                        'success' =>  'Record updated successfully',
                        'danger' => 'There was an issue updating record'
                    ],
                ],
                'create' => [
                    'class' => 'maniakalen\admingui\actions\Create',
                    'manager' => [
                        'class' => 'app\models\UserModelManager',
                        'model' => 'app\models\User'
                    ],
                    'redirect' => 'index',
                    'messages' => [
                        'success' =>  'Record created successfully',
                        'danger' => 'There was an issue creating record'
                    ],
                ],
                'toggle' => [
                    'class' => 'maniakalen\admingui\actions\Toggle',
                    'manager' => [
                        'class' => 'app\models\UserModelManager',
                        'model' => 'app\models\User'
                    ],
                    'messages' => [
                        'success' =>  'Record status toggled successfully',
                        'danger' => 'There was an issue toggling status'
                    ],
                ],
                'delete' => [
                    'class' => 'maniakalen\admingui\actions\Delete',
                    'manager' => [
                        'class' => 'maniakalen\admingui\components\ModelManager',
                        'model' => 'app\models\User'
                    ],
                    'messages' => [
                        'success' =>  'Record deleted successfully',
                        'danger' => 'There was an issue deleting record'
                    ],
                ]
            ],
            'as access' => [
                'class' => 'yii\filters\AccessControl',
                'rules' => [
                    [
                        'actions' => [
                            'index'
                        ],
                        'allow' => true,
                        'permissions' => ['admin/users/full', 'admin/users/self'],
                    ],
                    [
                        'actions' => [
                            'update', 'create', 'delete', 'toggle', 'details', 'edit'
                        ],
                        'allow' => true,
                        'permissions' => ['admin/users/full'],
                    ],
                    [
                        'actions' => [
                            'update', 'create', 'delete', 'toggle', 'details', 'edit'
                        ],
                        'allow' => true,
                        'permissions' => ['admin/users/self'],
                        'matchCallback' => function ($rule, $action) {
                            $id = (int)\Yii::$app->request->get('id', null);
                            return !\Yii::$app->user->isGuest && $id === \Yii::$app->user->id;
                        }
                    ],
                ],
            ],
            'as verb' => [
                'class' => 'yii\filters\VerbFilter',
                'actions' => [
                    'edit' => ['post'],
                    'create' => ['post', 'get'],
                ]
            ]
        ]
    ],
    'params' => $params,
];
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '172.19.0.*', '172.*'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '172.*'],
    ];
}

return $config;
