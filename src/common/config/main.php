<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
	        'class' => 'yii\rbac\DbManager',
	        'defaultRoles' => ['guest'],
        ],
        'urlManager' => [
	        'class' => 'yii\web\UrlManager',
	        'enablePrettyUrl' => true,
	        'showScriptName' => false,
	        'suffix' => '.html',
	        'rules' => [
                '<controller>/<action>' => '<controller>/<action>'
	        ],
        ],
        'geounits' => [
            'class' => 'common\components\GeoUnitsManager'
        ]
    ],
	'modules' => [
		'workflow' => [
			'class' => 'maniakalen\workflow\Module'
		]
	]
];
