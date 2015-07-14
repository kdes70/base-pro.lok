<?php
    namespace app\modules\admin\controllers;

    use yii\web\Controller;
    use yii\filters\VerbFilter;
    use yii\filters\AccessControl;

    class BaseController extends Controller
    {
        public function behaviors()
        {
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['post'],
                    ],
                ],

            ];
        }



        /**
         * Displays a single Blog model.
         * @param integer $id
         * @return mixed
         */
        public function actionView($id)
        {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }

        /**
         * Deletes an existing Blog model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         */
        public function actionDelete($id)
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }