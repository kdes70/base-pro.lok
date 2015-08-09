<?php
    namespace app\modules\main\controllers;

    use yii\web\Controller;
    use Yii;

    class DefaultController extends Controller
    {


        public function actions()
        {
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }


        public function actionIndex($city = null)
        {
            $this->layout = '/index';
            if($city == null)
            {
                $city = mb_strtolower(Yii::$app->geoIp->geoCity);

                return $this->render('index', ['city' => $city]);

            }



           // var_dump(mb_strtolower(Yii::$app->geoIp->geoCity));exit;

            return $this->render('index');

        }
    }