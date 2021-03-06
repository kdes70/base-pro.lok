<?php
    use yii\widgets\LinkPager;
    /* @var $this yii\web\View */
    $this->title = Yii::$app->name;
?>
<div class="main-default-index">

    <div class="jumbotron">
        <h1>Blog!</h1>
        <p class="lead">You have successfully created your Yii-powered application.</p>
    </div>

    <div class="body-content">

        <div class="row">

            <div class="col-md-8">
                <?php  foreach ($blog_post as $model) {
                    echo $this->render('shortView', ['model' => $model]);
                } ?>


                <!-- Pager -->
                <ul class="pager">
                    <?php // display pagination
                        echo LinkPager::widget([
                            'pagination' => $pages,
                        ]);?>
<!--                    <li class="previous">-->
<!--                        <a href="#">&larr; Older</a>-->
<!--                    </li>-->
<!--                    <li class="next">-->
<!--                        <a href="#">Newer &rarr;</a>-->
<!--                    </li>-->
                </ul>

            </div>
            <!-- Blog Sidebar Widgets Column -->


            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">

                        <?php if($category):?>
                            <ul class="nav nav-list">
                                <li class="nav-header">What we are?</li>
                                <li class="active"><a href="#">Home</a></li>
                                <?php foreach ($category as $item):?>
                                    <li><a href="#"><?= $item->title ?> <span class="badge badge-important">6</span></a></li>
                                <?php endforeach;?>
                                <li class="nav-header">Our Friend</li>
                                <li><a href="#">Yahoo!</a></li>
                                <li><a href="#">Bing</a></li>
                                <li><a href="#">Microsoft</a></li>
                                <li><a href="#">Gadgetic World</a></li>
                            </ul>




                        <?php endif;?>

                    </div>

                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>


        </div>

    </div>
</div>
