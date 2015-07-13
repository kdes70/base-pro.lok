<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Blog */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Blogs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'user_id',
            'title',
            'slug',
            'text:ntext',
            'image',
            'prev_img',
            [
                'attribute' => 'status',
                'value' => ($model->status == 1) ? 'Опубликован' : 'Черновик',
            ],
            'created_at:datetime',
//            [
//                'attribute' => 'created_at',
//                'value' => Yii::$app->formatter->asDatetime($model->created_at),
//            ],
            'updated_at',
        ],
    ]) ?>

</div>
