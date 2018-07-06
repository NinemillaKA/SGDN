<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=>'SGD NAUTICOS',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /*'view' => [
          'theme' => [
            'pathMap' => [
              '@app/views' => '@vendor/p2made/yii2-flat-theme/example-views/flat'
            ],
          ],
        ],*/

        // 'assetManager' => [
    		// 	'bundles' => [
    		// 		'yii\web\JqueryAsset' => [
    		// 			'sourcePath' => null, 'js' => [],
    		// 		],
    		// 		'yii\bootstrap\BootstrapAsset' => [
    		// 			'sourcePath' => null, 'css' => [],
    		// 		],
    		// 		'yii\bootstrap\BootstrapPluginAsset' => [
    		// 			'sourcePath' => null, 'js' => [],
    		// 		],
    		// 		'yii\jui\JuiAsset' => [
    		// 			'sourcePath' => null, 'css' => [], 'js' => [],
    		// 		],
    		// 		'\rmrevin\yii\fontawesome\AssetBundle' => [
    		// 			'sourcePath' => null, 'css' => [],
    		// 		],
    		// 	],
    		// ],

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
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
