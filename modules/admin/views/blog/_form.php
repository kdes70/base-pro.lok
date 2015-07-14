<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
//use yii\widgets\ActiveForm;
  use yii\bootstrap\ActiveForm;
use app\modules\blog\models\Category;
use dosamigos\selectize\SelectizeTextInput;
 use dosamigos\taggable\Taggable;
   // use mihaildev\ckeditor\CKEditor;

    use app\components\widgets\CKEditor;
    use iutbay\yii2kcfinder\KCFinderInputWidget ;

    use toxor88\switchery\Switchery;
    use yii\web\JsExpression;
    use kartik\switchinput\SwitchInput;
    use dosamigos\datetimepicker\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\blog\models\Blog */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="blog-form">

    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data',
        ]
    ] ); ?>



        <div class="col-lg-6">
            <?= $form->field($model, 'category_id')->dropDownList(ArrayHelper::map(Category::find()->all(), 'id', 'title')); ?>

        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'tagNames')->widget(SelectizeTextInput::className(), [
                // calls an action that returns a JSON object with matched
                // tags
                'loadUrl' => ['/blog/tags/list'],
                'options' => ['class' => 'form-control'],
                'clientOptions' => [
                    'plugins' => ['remove_button'],
                    'valueField' => 'name',
                    'labelField' => 'name',
                    'searchField' => ['name'],
                    'create' => true,
                ],
            ])->hint(Yii::t('app', 'HINT_TAGS')) ?>
        </div>
    <div class="col-lg-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true])->hint('заголовок') ?>
    </div>
    <div class="col-lg-6">
<!--        --><?//= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'publication_at')->widget(DateTimePicker::className(), [
            'language' => 'ru',
            'size' => 'ms',
            //'template' => '{input}',
            'pickButtonIcon' => 'glyphicon glyphicon-time',
            'inline' => false,
            'clientOptions' => [
//                'startView' => 1,
//                'minView' => 0,
//                'maxView' => 1,
                'autoclose' => true,
                // 'linkFormat' => 'HH:ii P', // if inline = true
                // 'format' => 'HH:ii P', // if inline = false
                'todayBtn' => true
            ]
        ]);?>
    </div>


    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <?php

//        $KCFinder = new KCFinderInputWidget;
//        $kcfOptions = array_merge($KCFinder->$kcfDefaultOptions, [
//            'uploadURL' => Yii::getAlias('@web').'/upload',
//            'access' => [
//                'files' => [
//                    'upload' => true,
//                    'delete' => false,
//                    'copy' => false,
//                    'move' => false,
//                    'rename' => false,
//                ],
//                'dirs' => [
//                    'create' => true,
//                    'delete' => false,
//                    'rename' => false,
//                ],
//            ],
//        ]);
//
//        // Set kcfinder session options
//        Yii::$app->session->set('KCFINDER', $kcfOptions);


    ?>

    <div class="form_group">
        <div class="col-md-offset-2 col-md-10">
            <? $images = $model->getImages();?>

            <div class="row">
                <? foreach($images as $image):?>
                    <? if($image):?>
                <div class="col-md-3 text-center">
                    <img src="<?= $image->getUrl('200x200')?>" alt=""/>
                </div>
                    <? endif; ?>
                <? endforeach;?>
            </div>

        </div>
    </div>

    <div class="row">

            <div class="img-responsive"><?Html::img(Yii::getAlias('@webroot/upload/files/').$model->prev_img);?></div>

    </div>


<!--    --><?//= $form->field($model, 'image')->fileInput()?>

    <?= $form->field($model, 'image')->widget(\dosamigos\fileinput\BootstrapFileInput::className(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'clientOptions' => [
            'previewFileType' => 'text',
            'browseClass' => 'btn btn-success',
            'uploadClass' => 'btn btn-info',
            'removeClass' => 'btn btn-danger',
            'removeIcon' => '<i class="glyphicon glyphicon-trash"></i> '
        ]
    ]);?>


            <?=$form->field($model, 'status')->widget(Switchery::classname(), [
                'clientOptions' => [
                    'color'              => '#64bd63',
                    'secondaryColor'     => '#dfdfdf',
                    'jackColor'          => '#fff',
                    'jackSecondaryColor' => null,
                    'className'          => 'switchery js-switch',
                    'disabled'           => false,
                    'disabledOpacity'    => 0.5,
                    'speed'              => '0.3s',
                    'size'               => 'default',

                ],

            ])->label(false);?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>