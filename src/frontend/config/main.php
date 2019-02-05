<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/params.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
	'modules' => [
		'maps' => 'maniakalen\maps\Module',
        'workflow' => [
            'appendRoutes' => false,
            'routes' => [
                [
                    'pattern' => '<wf_url:(signup)>/<step_url>',
                    'route' => 'workflow/workflow/render',
                    'verb' => 'GET',
                    'defaults' => ['wf_url' => 'default']
                ],
                [
                    'pattern' => '<wf_url:(signup)>/<step_url>',
                    'route' => 'workflow/workflow/process',
                    'verb' => 'POST',
                    'defaults' => ['wf_url' => 'default']
                ]
            ]
        ]
	],
    'bootstrap' => ['log', 'maps', 'workflow'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
    	'location' => [
    		'class' => 'maniakalen\maps\components\Location',
		    'negotiator' => [
		        'class' => 'maniakalen\maps\negotiators\Here',
                'appId' => 'ifQGurbqKiRUiNpkW3B1',
                'appCode' => 'OxhEjE0cIuwtLk3fanpaaA',
                'supportsParams' => true
            ]
	    ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        ]

    ],
    'params' => $params,
];
