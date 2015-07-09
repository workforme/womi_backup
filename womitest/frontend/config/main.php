<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
	    'flushInterval' => 1,
            'traceLevel' => YII_DEBUG ? 7 : 0,
            //'traceLevel' =>  0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info','error', 'warning'],
		    'exportInterval' => 1,
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'view' => [
	        'class' => 'frontend\base\BaseFrontView',
        ],
    ],
    'params' => $params,
];
