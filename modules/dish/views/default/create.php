<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\dish\models\Dishs */

$this->title = Yii::t('app', 'Create Dishs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dishs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
