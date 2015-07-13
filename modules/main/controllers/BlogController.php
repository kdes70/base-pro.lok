<?php
    namespace app\modules\main\controllers;

    use app\modules\blog\models\Blog;
    use app\modules\blog\models\Category;
    use yii\web\Controller;
    use yii\data\Pagination;

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

            $query = Blog::getPublishedPosts();
            $countQuery = clone $query;
            $pages = new Pagination(['defaultPageSize' => 3,'totalCount' => $countQuery->count()]);

            $models = $query->offset($pages->offset)
                ->limit($pages->limit)
                ->all();

           // var_dump($models);exit;

            return $this->render('index', [
                'blog_post' => $models,
                'pages' => $pages,
                'category' => Category::find()->where(['status' => Category::STATUS_PUBLISH])->all(),
            ]);
        }

        public function actionShow($slug)
        {
            $model = new Blog();
            return $this->render('show', [
                'model' => $model->find()
                    ->where(['slug' => $slug])
                    ->one()
            ]);
        }
    }