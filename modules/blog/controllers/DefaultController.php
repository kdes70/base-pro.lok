<?php

namespace app\modules\blog\controllers;


use Yii;
use app\modules\blog\models\Blog;
use app\modules\blog\models\BlogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\blog\models\Tags;
use yii\web\UploadedFile;


/**
 * DefaultController implements the CRUD actions for Blog model.
 */
class DefaultController extends Controller
{
    public $layout = '@app/modules/admin/views/layouts/main';

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
     * Creates a new Blog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
//        if(\Yii::$app->user->can('createPost'))
//        {
//            //��������� ����� �� ��������
//            var_dump(\Yii::$app->user);
//        }
//        else throw new ForbiddenHttpException('� ��� ������������ ���� ��� ���������� ���������� ��������');
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
                    $path = Yii::getAlias('@webroot/upload/files/').$model->image->baseName.'.'.$model->image->extension;
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
