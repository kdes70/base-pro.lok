<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('app', 'TITLE_PROFILE');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-profile">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?//= Html::a(Yii::t('app', 'BUTTON_UPDATE'), ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::button(Yii::t('app', 'BUTTON_UPDATE'),  ['value' => Url::to('profile/update'), 'class' => 'btn btn-primary', 'id' => 'modelButton']) ?>


        <?= Html::a(Yii::t('app', 'LINK_CHANGE_PASSWORD'), ['change-password'], ['class' => 'btn btn-primary']) ?>
    </p>


<!--    <p>Role:</p> --><?php //foreach ( ArrayHelper::map(Yii::$app->authManager->roles,'name','description') as $role ) {
//
//    echo $role->description;
//    }?>

    <?php
        Modal::begin([
            'header' => '<h1>'. Html::encode($this->title).'</h1>',
            'id' => 'modal',
            'size' => 'model-lg',
        ]);
        echo '<div id="modelContent"></div>';
        Modal::end();
    ?>


    <?php var_dump(ArrayHelper::map(Yii::$app->authManager->roles,'name','description'))?>

    <?php if(Yii::$app->user->can('customer')){
        echo 'customer';
    } elseif(Yii::$app->user->can('performer')){
        echo 'performer';
    } elseif(Yii::$app->user->can('author')){
        echo 'author';
    } elseif(Yii::$app->user->can('admin')){
        echo 'admin';
    }
        ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
            'first_name',
        ],
    ]) ?>

</div>
