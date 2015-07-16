<?php

namespace app\modules\admin\controllers;


use Yii;
use app\modules\blog\models\Blog;
use app\modules\blog\models\BlogSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\blog\models\Tags;
use yii\web\UploadedFile;


/**
 * DefaultController implements the CRUD actions for Blog model.
 */
class BlogController extends BaseController
{
    public $layout = '@app/modules/admin/views/layouts/main';


    /**
     * Lists all Blog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }




    /**
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        if(\Yii::$app->user->can('createPost'))
//        {
//            //выполняем какое то действие
//            var_dump(\Yii::$app->user);
//        }
//        else throw new ForbiddenHttpException('У вас недостаточно прав для выполнения указанного действия');
        $model = new Blog();
        // create post

        // var_dump(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {



            return $this->redirect(['view', 'id' => $model->id]);
        } else {

            return $this->render('create', [
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Blog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $model->user_id = \Yii::$app->user->identity->getId();

        $items = $model->getTags()->all();
        $tags = [];
        foreach ($items as $item)
        {
            $tags[] = $item->name;
        };
        $model->tagNames = Tags::array2string($tags);




        //  var_dump(Yii::$app->request->post());

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // var_dump(Yii::$app->request->post());exit;

            $model->image = UploadedFile::getInstance($model, 'image');
            if($model->image)
            {
                $path = Yii::getAlias('@webroot/upload/images/').$model->image->baseName.'.'.$model->image->extension;
                $model->image->saveAs($path);
                $model->attachImage($path);
            }

            // var_dump($model->attachImage($path)); exit;


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }





    /**
     * Finds the Blog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Blog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Blog::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
