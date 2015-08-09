<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\captcha\Captcha;

    /* @var $this yii\web\View */
    /* @var $model app\modules\tender\models\Tender */
    /* @var $user_model app\modules\user\models\User */
    /* @var $form yii\widgets\ActiveForm */

?>

<div class="tender_default_customer_form">



    <?php $form = ActiveForm::begin(['id' => 'form-customer'] /*'options' => ['class' => 'form-horizontal'],*/); ?>

    <?//= $form->field($model, 'customer_id')->textInput() ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tender_name')->textInput(['maxlength' => true])->hint('Please enter your name') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'profession_id')->dropDownList([1 => '1', 2 => '2']) ?>
        </div>

    </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        <label for="cost">Установите бюджет</label>
        <div class="row form-inline">

            <div class="form-group" id="cost">
                <?= $form->field($model, 'cost')->textInput(['placeholder' => '.руб'])->label('') ?>
                <?= $form->field($model, 'priceby')->dropDownList($model->getPriceByArray())->label('') ?>
                <?= $form->field($model, 'agreement')->checkbox() ?>
            </div>
        </div>
    <hr>

<!--    --><?//= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
//        'captchaAction' => '/user/default/captcha',
//        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
//    ]) ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
