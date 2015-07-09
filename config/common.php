<?php
    use yii\helpers\ArrayHelper;

    $params = ArrayHelper::merge(
        require(__DIR__ . '/params.php'),
        require(__DIR__ . '/params-local.php')
    );

    return [
        'name' => 'KD-project',
        'language' => 'ru',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'modules' => [
//            'admin' => [
//                'class' => 'mdm\admin\Module',
//                'controllerMap' => [
//                    'assignment' => [
//                        'class' => 'mdm\admin\controllers\AssignmentController',
//                        'userClassName' => 'app\modules\user\models\User',
//                        'idField' => 'id', // id field of model User
//                    ]
//                ],
//                'layout' => 'top-menu', // default null. other avaliable value 'right-menu' and 'top-menu'
//                'menus' => [
//                    'assignment' => [
//                        'label' => 'Grand Access' // change label
//                    ],
//                    'route' => null, // disable menu
//                ],
//            ],
            'admin' => [
                'class' => 'app\modules\admin\AdminModule',
                'layout' => 'main',
            ],
            'main' => [
                'class' => 'app\modules\main\Module',
            ],
            'user' => [
                'class' => 'app\modules\user\Module',
            ],
            'blog' => [
                'class' => 'app\modules\blog\Module',
            ],
        ],
        'components' => [

            'authManager' => [
                'class' => 'yii\rbac\DbManager',
            ],
            'db' => [
                'class' => 'yii\db\Connection',
                'charset' => 'utf8',
            ],
            'urlManager' => [
                'class' => 'yii\web\UrlManager',
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                    '' => 'main/default/index',
                    'contact' => 'main/contact/index',
                    'admin/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'admin/<controller>/<action>',
                    'admin/<module:\w+>/<controller:\w+>/<action:[\w-]+>/<id:\d+>' => 'admin/<module>/<controller>/<action>',
                    'tags/list/<query:\w+>'=>'/blog/tags/list/<_a>',
                    '<_a:error>' => 'main/default/<_a>',
                    '<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',
                    '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/<_a>',
                    '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                    '<_m:[\w\-]+>' => '<_m>/default/index',
                    '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
                ],
            ],
            'i18n' => [
                'translations' => [
                    'app*' => [
                        'class' => 'yii\i18n\PhpMessageSource',
                        'fileMap' => [
                            'app' => 'app.php',
                        ],
                    ],
                ],
            ],
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
            ],
            'cache' => [
                'class' => 'yii\caching\DummyCache',
            ],
            'log' => [
                'class' => 'yii\log\Dispatcher',
            ],
        ],
//        'as access' => [
//            'class' => 'mdm\admin\components\AccessControl',
//            'allowActions' => [
//                'admin/*', // add or remove allowed actions to this list
//            ]
//        ],
        'params' => $params,
    ];