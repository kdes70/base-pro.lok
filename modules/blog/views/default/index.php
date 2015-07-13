<?php

use yii\helpers\Html;
use yii\grid\GridView;
    use app\components\grid\ActionColumn;
    use app\modules\blog\models\Blog;

    use toxor88\switchery\Switchery;
    use yii\web\JsExpression;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\blog\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blogs');
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
                'attribute' => 'category_id',
                'value' => 'category.title'
            ],
            [
              'attribute' => 'user_id',
                'value' =>'user.username',
            ],
            'title',
            'slug',
            [
                'attribute' => 'status',
                'value' => function ($data) {
                    return ($data->status == 1) ? 'Опубликован' : 'Черновик';
                }
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
                'format' =>  ['date', 'HH:mm dd.MM.YYYY'],
              //  'options' => ['width' => '200']
            ],

            // 'created_at',
            // 'updated_at',


            ['class' => ActionColumn::className()],
        ],
    ]); ?>

</div>
