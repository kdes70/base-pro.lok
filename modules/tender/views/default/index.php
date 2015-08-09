<?php
/* @var $this yii\web\View */
$this->title = Yii::$app->name;
    $this->registerJsFile('@web/js/main-index.js',['position'=>$this::POS_END], 'main-index');
?>
<div class="tender-default-index">

       <div class="jumbotron">
        <h1>Finishing work!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

    </div>
    <?php if(Yii::$app->user->isGuest):?>
        <div class="row" id="block_start">
            <div class="col-md-6">
                <p><a class="btn btn-lg btn-success center-block button_flat_width_270" href="/tender/default/customer">Заказчик</a></p>
                <div class="lead text-centr">Лучшие исполнители с гарантией
                    выполнения работы в срок
                    через безопасную сделку</div>
            </div>
            <div class="col-md-6">
                <p><a class="btn btn-lg btn-warning center-block button_flat_width_270" href="/tender/default/performer">Исполнитель</a></p>
                <div class="lead text-centr">Получай заказы с гарантией оплаты
                    от лучших заказчиков рунета, и зарабатывай
                    на постоянном потоке заказов</div>
            </div>
        </div>
    <?php else:?>

    <?php endif;?>




    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
