<?php

namespace app\modules\admin;

use Yii;
use yii\filters\AccessControl;

class AdminModule extends \mdm\admin\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';
    //public $layoutPath = '/rbac';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        //'roles' => ['@'],
                        'roles' => ['admin', 'moderator'],
                    ],
                ],
            ],
        ];
    }

    public function init()
    {
        parent::init();
        // custom initialization code goes here
    }


}
