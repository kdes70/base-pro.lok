<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\dish\models\DishsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Dishs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Dishs'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'menu_id',
            'name',
            'alias',
            'description:ntext',
            // 'weight',
            // 'value',
            // 'price',
            // 'img',
            // 'status',
            // 'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
