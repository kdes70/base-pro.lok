<?php

use yii\helpers\Html;
use yii\grid\GridView;
    use app\components\grid\ActionColumn;
    use app\modules\blog\models\Blog;

    use yii\helpers\ArrayHelper;

    use app\modules\user\models\User;
    use app\components\grid\LinkColumn;

    use app\modules\blog\models\Category;
    use app\components\grid\SetColumn;
  //  use toxor88\switchery\Switchery;
  //  use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blogs');
    $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ADMIN'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Blog'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       // 'layout'=>"{sorter}\n{pager}\n{summary}\n{items}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'filter' => ArrayHelper::map(Category::find()->all(), 'id', 'title'),
                'attribute' => 'category_id',
                'value' => 'category.title'
            ],
            [
                'filter' => ArrayHelper::map(User::find()->all(), 'id', 'username'),
                'attribute' => 'user_id',
                'value' =>'user.username',
            ],
            [
                'class' => LinkColumn::className(),
                'attribute' => 'title',
                'value' => function($data)
                {
                    return  \yii\helpers\StringHelper::truncate($data->title,30,'...');
                },
                'options' => [
                    'width' => '250',
                    'title' => 'title'
                ]

            ],
            [
                'attribute' => 'slug',
                'options' => ['width' => '100']
            ],


            [
                'class' => SetColumn::className(),
                'filter' => Blog::getStatusesArray(),
                'attribute' => 'status',
                'name' => 'statusName',
                'cssCLasses' => [
                    Blog::STATUS_PUBLISH => 'success',
                    Blog::STATUS_DONT_PUBLISH => 'default',
                ],
            ],
            // 'text:ntext',
            // 'prev_img',
            /*[
                'attribute'=>'status',
                'contentOptions' =>['class' => 'table_class','style'=>'display:block;'],
                'content'=>function($data){
                    return  Switchery::widget([
                        'name' => 'status',
                        'clientOptions' => [
                            'color'              => '#64bd63',
                            'secondaryColor'     => '#dfdfdf',
                            'jackColor'          => '#fff',
                            'jackSecondaryColor' => null,
                            'className'          => 'switchery js-switch',
                            'disabled'           => false,
                            'disabledOpacity'    => 0.5,
                            'speed'              => '0.3s',
                            'size'               => 'small',
                        ],
                        //'clientChangeEvent' => new JsExpression('function() {   }'),
                    ]);
                }
            ],*/

            [
                'attribute' =>  'publication_at',
                'format' =>  ['date', 'd MMMM yyyy HH:mm'],
              //  'options' => ['width' => '200']
            ],

            // 'created_at',
            // 'updated_at',


            ['class' => ActionColumn::className()],
        ],
    ]); ?>

</div>
