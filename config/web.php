<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'language' => 'pt-BR',
    'name' => 'Cast Escola',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => false,
            'appendTimestamp' => true,
        ],
        'formatter' => [
            'class'			    => 'yii\i18n\Formatter',
            'dateFormat'		=> 'dd/MM/yyyy',
            'datetimeFormat'	=> 'php:d/m/Y H:i:s',
            'timeFormat'		=> 'php:H:i:s',
            'decimalSeparator'	=> ',',
            'thousandSeparator'	=> '.',
            'locale'		    => 'pt_br',
            'defaultTimeZone'	=> 'America/Recife',
            'nullDisplay'       => '-',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Suhotw65sH353WipCIKJRn3fXJAvSXfK',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'response' => [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if($response->statusCode == 422) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'message' => 'Por favor, corrija seus dados com os valores corretos.',
                        'details' => $response->data
                    ];
                }
            },
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
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
            'rules' => [
                'api/docs' => 'site/api-docs',
                [
                    'class' => 'yii\rest\UrlRule',
                    'pluralize' => false,
                    'controller' => ['api/categoria', 'api/curso', 'api/aluno']
                ],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module'],
        'api' => ['class' => 'app\modules\api\ApiModule'],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
