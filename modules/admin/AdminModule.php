<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;
use iutbay\yii2kcfinder\KCFinderInputWidget;

class AdminModule extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        //'roles' => ['@'],
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();

//        $KCFinder = new KCFinderInputWidget;
//        $kcfOptions = array_merge($KCFinder->$kcfDefaultOptions, [
//            'uploadURL' => Yii::getAlias('@web').'/upload',
//            'access' => [
//                'files' => [
//                    'upload' => true,
//                    'delete' => false,
//                    'copy' => false,
//                    'move' => false,
//                    'rename' => false,
//                ],
//                'dirs' => [
//                    'create' => true,
//                    'delete' => false,
//                    'rename' => false,
//                ],
//            ],
//        ]);
//
//// Set kcfinder session options
//        Yii::$app->session->set('KCFINDER', $kcfOptions);

        // custom initialization code goes here
    }
}
