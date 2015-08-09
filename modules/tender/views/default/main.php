<?php
    /* @var $this yii\web\View */
    $this->title = Yii::$app->name;


?>
<div class="tender-default-main">
    <div class="jumbotron">
        <h1>Finishing work!</h1>
    </div>
    <div class="body-content">
        <div class="row">
            <div class="col-md-8">
                <?php if(isset($tenders)):?>
                    <?php  foreach ($tenders as $tender) {
                        echo $this->render('shortView', ['tender' => $tender]);
                    }; ?>

                <?php endif;?>
            </div>
        </div>

    </div>
</div>
