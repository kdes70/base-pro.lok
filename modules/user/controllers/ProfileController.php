<?php

    namespace app\modules\user\controllers;

    use app\modules\user\models\User;
    use app\modules\user\models\Profile;

    use yii\filters\AccessControl;
    use yii\web\Controller;
    use Yii;
    use app\modules\user\models\ChangePasswordForm;

    class ProfileController extends Controller
    {
        public function behaviors()
        {
            return [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ];
        }

        public function actionIndex()
        {
            return $this->render('index', [
                'model' => $this->findModel(),
            ]);
        }

        public function actionProfile()
        {
           // $model = new Profile(['scenario' => 'SCENARIO_PROFILE']);
//            $model = new Profile();
//
//            if ($model->load(Yii::$app->request->post())) {
//                if ($model->validate()) {
//                    // form inputs are valid, do something here
//                    return $this->redirect(['index']);
//                }
//            }

            $model = ($model = Profile::findOne(Yii::$app->user->id)) ? $model : new Profile();
            if($model->load(Yii::$app->request->post()) && $model->validate()):
                if($model->updateProfile()):
                    Yii::$app->session->setFlash('success', Yii::t('app', 'SUCCESS_EDIT_PROFILE'));
                else:
                    Yii::$app->session->setFlash('error', Yii::t('app', 'ERROR_EDIT_PROFILE'));
                    Yii::error('Ошибка записи - '. Yii::t('app', 'ERROR_EDIT_PROFILE'));
                    return $this->refresh();
                endif;

            endif;

            return $this->render('profile', [
                'model' => $model,
            ]);
        }


        public function actionUpdate()
        {
            $model = $this->findModel();
            $model->scenario = User::SCENARIO_PROFILE;

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if($model->save())
                {
                    Yii::$app->session->setFlash('success', Yii::t('app', 'SUCCESS_EDIT_PROFILE'));
                    return $this->redirect(['index']);
                }else{
                    Yii::$app->session->setFlash('error', Yii::t('app', 'ERROR_EDIT_PROFILE'));
                    Yii::error('Ошибка записи - '. Yii::t('app', 'ERROR_EDIT_PROFILE'));
                    return $this->redirect(['index']);
                }

            } else {
                return $this->renderAjax('update', [
                    'model' => $model,
                ]);
            }

        }

        public function actionChangePassword()
        {
            $user = $this->findModel();
            $model = new ChangePasswordForm($user);

            if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
                return $this->redirect(['index']);
            } else {
                return $this->render('changePassword', [
                    'model' => $model,
                ]);
            }
        }


        /**
         * @return User the loaded model
         */
        private function findModel()
        {
            return User::findOne(Yii::$app->user->identity->getId());
        }
    }
