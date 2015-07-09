<?php
    namespace app\modules\main\controllers;

    use app\modules\blog\models\Blog;
    use yii\web\Controller;

    class BlogController extends Controller
    {
        public function actions()
        {
            return [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                ],
            ];
        }


        public function actionIndex()
        {
            $model = new Blog();

           // var_dump($model->getPublishedPosts()); exit;
            return $this->render('index',
                                ['blog_post' => $model->getPublishedPosts()]);
        }

        public function actionShow($id)
        {
            $model = new Blog();
            return $this->render('show', [
                'model' => $model->find($id),
            ]);
        }
    }