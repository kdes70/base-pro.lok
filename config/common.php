<?php
    use yii\helpers\ArrayHelper;

    $params = ArrayHelper::merge(
        require(__DIR__ . '/params.php'),
        require(__DIR__ . '/params-local.php')
    );

    // получаем список директорий в /modules
    $dirs = scandir(dirname(__FILE__).'/../modules');

    // строим массив
    $modules = array();
    foreach ($dirs as $name){
        if ($name[0] != '.')
            $modules[$name] = array('class'=>'app\modules\\' . $name . '\\' . ucfirst($name) . 'Module');
    }

    // строка вида 'news|page|user|...|socials'
    // пригодится для подстановки в регулярные выражения общих правил маршрутизации
    define('MODULES_MATCHES', implode('|', array_keys($modules)));


    return [
    'name' => 'Finishing work',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Europe/Moscow',
    'modules' => array_replace($modules, [
            // если какой-либо модуль нуждается в переопределении для этого проекта, то пропишите его здесь
        'admin' => [
            'class' => 'app\modules\admin\AdminModule',
            //'class' => 'mdm\admin\Module',
            'layout' => 'main',
            // 'layout' => 'left-menu',
            //  'mainLayout' => '@app/views/layouts/main.php',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => 'app\modules\admin\models\User',  // fully qualified class name of your User model
                    // Usually you don't need to specify it explicitly, since the module will detect it automatically
                    'idField' => 'id',        // id field of your User model that corresponds to Yii::$app->user->id
                    'usernameField' => 'username', // username field of your User model
                    'searchClass' => 'app\modules\admin\models\UserSearch'    // fully qualified class name of your User model for searching
                ],
                'role' => [
                    'class' => 'mdm\admin\controllers\RoleController',
                ],
                'permission' => [
                    'class' => 'mdm\admin\controllers\PermissionController',
                ],
                'rule' => [
                    'class' => 'mdm\admin\controllers\RuleController',
                ],
                'route' => [
                    'class' => 'mdm\admin\controllers\RouteController',
                ],
                'tender' => [
                    'class' => 'app\modules\tender\controllers\DefaultController',
                ]
            ],
        ],
        'yii2images' => [
            'class' => 'rico\yii2images\Module',
            //be sure, that permissions ok
            //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
            'imagesStorePath' => 'upload/store', //path to origin images
            'imagesCachePath' => 'upload/cache', //path to resized copies
            'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
            //'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
        ],
    ]),
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

                // небольшая защита от дублирования адресов
                '<module:' . MODULES_MATCHES . '>/default/index'=>'main/error/error',
                '<module:' . MODULES_MATCHES . '>/default'=>'main/error/error',

                '' => 'main/default/index',

              'contact' => 'main/contact/index',




                '<_a:error>' => 'main/default/<_a>',
                '<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',

                'blog/<slug:[\w+_-]+>' => 'blog/default/view',


                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
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

        'geoIp' => [
            'class' => 'app\components\geo\GeoIp',
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


    'params' => $params,
];