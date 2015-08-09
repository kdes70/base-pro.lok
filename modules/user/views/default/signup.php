<?php
use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
    use app\modules\geo\models\Countries;
    use app\modules\geo\models\Regions;
    use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\SignupForm */
/* @var $model_countri app\modules\geo\models\Countries */
/* @var $model_region app\modules\geo\models\Regions */

$this->title = Yii::t('app', 'TITLE_SIGNUP');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('app', 'PLEASE_FILL_FOR_SIGNUP') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <?php echo $form->field($model, 'role', [
                'inline' => true,
                'enableLabel' => false
            ])->radioList([
                'performer' => Yii::t('app', 'USER_PERFORMER'),
                'customer' => Yii::t('app', 'USER_CUSTOMER'),
            ], [
                'id' => 'block_user_roles',
                'class' => 'btn-group',
                'data-toggle' => 'buttons',
                'unselect' => null, // remove hidden field
                'item' => function ($index, $label, $name, $checked, $value) {
                    return '<label class="btn btn-default' . ($checked ? ' active' : '') . '">' .
                    Html::radio($name, $checked, ['value' => $value, 'class' => 'project-status-btn']) . $label . '</label>';
                },
            ]);?>


            <hr>
            <?= $form->field($model_countri, 'country_id')->dropDownList(ArrayHelper::map(Countries::find()->all(), 'country_id', 'title_' . $model_countri->language_default),
                                                                        [
                                                                            'prompt' => Yii::t('app', 'Select country'),
//                                                                            'onchange' => '
//                                                                                $.post("index.php?r=countris-region/lists&id="+$(this).val(;'
                                                                        ]) ?>
            <?= $form->field($model_region, 'region_id')->dropDownList(ArrayHelper::map(Regions::find()->all(), 'region_id', 'title_' . $model_region->language_default)) ?>
<!--            --><?//= $form->field($model_city, 'city_id')->dropDownList(ArrayHelper::map(Regions::find()->all(), 'region_id', 'title_ru')) ?>

            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                'captchaAction' => '/user/default/captcha',
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'USER_BUTTON_SIGNUP'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

            <?php
//                $projectsUrl = Url::to('/admin/project/list');
//                $js = <<<JS
//                    /* form should not be submitted by button */
//                    //$('#filter_form').bind('submit', function(e) {
//                    //    e.preventDefault();
//                    //    e.stopPropagation();
//                    //});
//
//                    /* bind clicks on the labels */
//                    $('#projects_status').find('label').click(function(e) {
//                        e.preventDefault();
//                        /* uncheck all buttons */
//                        $('.project-status-btn').prop('checked', false);
//                        /* and check radiobutton under the current label */
//                        $(this).find('input').prop('checked', true);
//
//                        /* send request on the server */
//                        $.post('{$projectsUrl}', { filter: $('input[name="ProjectFilterForm[status]"]:checked').val() }, function(res) {
//                            console.log(res);
//                        });
//                    });
//            JS;
//
//                $this->registerJs($js, \yii\web\View::POS_READY, 'projects-filter-form-script');
            ?>
        </div>
    </div>
</div>