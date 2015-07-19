<?php
    use yii\helpers\ArrayHelper;

    $params = ArrayHelper::merge(
        require(__DIR__ . '/params.php'),
        require(__DIR__ . '/params-local.php')
    );

    return [
        'name' => 'KD-project',
        'language' => 'ru-RU',
        'basePath' => dirname(__DIR__),
        'bootstrap' => ['log'],
        'modules' => [
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
                ],
            ],
//            'admin2' =>[
//                'class' => 'mdm\admin\Module',
//                'layout' => 'left-menu',
//            ],
            'yii2images' => [
                'class' => 'rico\yii2images\Module',
                //be sure, that permissions ok
                //if you cant avoid permission errors you have to create "images" folder in web root manually and set 777 permissions
                'imagesStorePath' => 'upload/store', //path to origin images
                'imagesCachePath' => 'upload/cache', //path to resized copies
                'graphicsLibrary' => 'GD', //but really its better to use 'Imagick'
                //'placeHolderPath' => '@webroot/images/placeHolder.png', // if you want to get placeholder when image not exists, string will be processed by Yii::getAlias
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
            'dish' => [
                'class' => 'app\modules\dish\Module',
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

                  //  'blog/show/' => 'blog/default/show/',

                    '<_a:error>' => 'main/default/<_a>',
                    '<_a:(login|logout|signup|confirm-email|request-password-reset|reset-password)>' => 'user/default/<_a>',

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
//               // 'admin/*',
//                //'some-controller/some-action',
//                // The actions listed here will be allowed to everyone including guests.
//                // So, 'admin/*' should not appear here in the production, of course.
//                // But in the earlier stages of your development, you may probably want to
//                // add a lot of actions here until you finally completed setting up rbac,
//                // otherwise you may not even take a first step.
//            ]
//        ],


        'params' => $params,
    ];