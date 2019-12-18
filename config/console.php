<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'log',
        'queue',
    ],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
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
        'db' => $db,
        'queue' => [
            'class' => \yii\queue\file\Queue::class,
            'as log' => \yii\queue\LogBehavior::class,
            'path' => '@runtime/queue',
            'on afterExec' => function (yii\queue\ExecEvent $event) {
                // if ($event->job instanceof ParserJob) {
                    Yii::$app->mailer->compose()
                        ->setFrom('semyon4e9@yandex.ru')
                        ->setTo('semenowav@gmail.com')
                        ->setSubject('New posts!')
                        ->setTextBody('Добавлены новые посты.')
                        ->send();
                    // }
            },
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
    ],
    'params' => $params,
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
