<?php
use yii\bootstrap\Carousel;
?>
<!-- First Blog Post -->
    <h2>
        <a href="/main/blog/show/<?=$model->id?>"><?=$model->title?></a>
    </h2>
    <p class="lead">by <a href="index.php"><?=$model->user_id?></a></p>

    <p><span class="glyphicon glyphicon-time"></span> Posted on August 28, 2013 at 10:00 PM</p>
    <hr>
<?php foreach ($model->getImages() as $image): ?>
    <?php  $items[] = '<img class="img-responsive" src="' . $image->getUrl('900x400') . '" alt="">'; ?>
<?php endforeach; ?>

<?echo Carousel::widget([
    'items' => $items
    // the item contains only the image
    // $items,
    // equivalent to the above
    //  ['content' => ' <img class="img-responsive" src="http://placehold.it/900x300" alt="">'],
    // the item contains both the image and the caption
//        [
//            'content' => ' <img class="img-responsive" src="http://placehold.it/900x300" alt="">',
//            'caption' => '<h4>This is title</h4><p>This is the caption text</p>',
//            'options' => [],
//        ],

]);?>
<!--    <img class="img-responsive" src="http://placehold.it/900x300" alt="">-->
    <hr>
    <p><?=  \yii\helpers\StringHelper::truncate($model->text,200,'...'); ?></p>
    <a class="btn btn-primary" href="/main/blog/show/<?=$model->id?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
<hr/>
<div class="row">
    <p>Теги:</p>
    <ul class="tags blue">
        <? if ($model->tags):?>
            <? foreach($model->tags as $tag):?>
                <li><a href="index.html"><?= $tag['name'];?> <span>31</span></a></li>
            <? endforeach;?>
        <? endif;?>

    </ul>
</div>

<p></p>

<hr>
<!-- End Blog Post -->
