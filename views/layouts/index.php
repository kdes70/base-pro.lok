<?php
    use yii\helpers\Html;
    use yii\widgets\Breadcrumbs;
    use app\assets\AppAsset;
    use app\components\widgets\Alert;

    /* @var $this \yii\web\View */
    /* @var $content string */

    AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div class="wrap top-image">

    <?= $this->render('top-nav.php'); ?>


    <div class="container">
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
<!--        --><?//= Alert::widget() ?>
<!---->

        <?= $content ?>

    </div>

</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?></p>
        <p class="pull-right"><?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
<?php $this->endPage() ?>
