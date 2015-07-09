<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dish\models\Dishs */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Dishs',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dishs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="dishs-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
