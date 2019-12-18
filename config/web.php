<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'queue',
        // ParserBootstrapper::class,
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'container' => [
        'definitions' => [
            \yii\widgets\LinkPager::class => \yii\bootstrap4\LinkPager::class,
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'HgARCQ6vTKm7cVrY4rhlklsEHJl3ivbK',
            'baseUrl'=> '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
            // 'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.yandex.ru',
                'username' => 'semyon4e9@yandex.ru',
                'password' => '@yRBc_Wg7ygUiM-',
                'port' => '465',
                'encryption' => 'ssl',
                'streamOptions' => [
                   'ssl' => [
                       'allow_self_signed' => true,
                       'verify_peer' => false,
                       'verify_peer_name' => false,
                   ],
                ],
            ],
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
        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'path' => '@runtime/queue',
            'on afterExec' => function (yii\queue\ExecEvent $event) {
                if ($event->job instanceof ParserJob) {
                    Yii::$app->mailer->compose()
                        ->setFrom('semyon4e9@yandex.ru')
                        ->setTo('semenowav@gmail.com')
                        ->setSubject('New posts!')
                        ->setTextBody('Добавлены новые посты.')
                        ->send();
                    }
            },
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // 'enableStrictParsing' => true,
            'rules' => [
                
                '<controller:\w+>/<id:\d+>-<slug:[A-Za-z0-9 -_.]+>' => '<controller>/view',
                ['class' => 'yii\rest\UrlRule', 'controller' => 'postrest'],
            ],
        ],

        // 'ParserBootstrapper' => [
        //          'class' => 'app\queue\ParserBootstrapper'],

    ],
    'params' => $params,
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
