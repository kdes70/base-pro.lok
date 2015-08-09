<?php
    /* @var $tender  */

?>
<!--Tender View-->
<div class="text-right float_right tender_price"><?=$tender->cost?></div>
<h2 class="text-left post_inlint">
    <a href="/blog/view/<?=$tender->id?>/<?=$tender->slug?>"><?=$tender->tender_name?></a>
</h2>
<p>
    <?= $tender->description ?>
</p>
<div class="tender_footer">
    <p>
        <span class="glyphicon glyphicon-time"></span>
        <?php echo Yii::$app->formatter->asDate($tender->created_at, 'd MMMM yyyy');?>
    </p>
<p class="float_right"><i class="fa fa-eye"></i>v: 66</p>
</div>
<hr>
<!--Tender End-->