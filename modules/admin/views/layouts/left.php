<?php
use yii\bootstrap\Nav;
use app\components\widgets\KCFinder;
    use yii\helpers\Html;
    /* @var $this \yii\web\View */
    /* @var $content string */

?>


<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Nav::widget(
            [
                'encodeLabels' => false,
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    '<li class="header">NAVIGATION</li>',
                    ['label' => '<i class="fa fa-dashboard"></i><span>dashboard</span>', 'url' => ['/admin']],
                    KCFinder::widget(['name' => 'image', 'multiple' => true,]),
                    '<li class="header">Menu Yii2</li>',
                    ['label' => '<i class="fa fa-file-code-o"></i><span>Gii</span>', 'url' => ['/gii']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Debug</span>', 'url' => ['/debug']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>tender</span>', 'url' => ['/admin/tenders/index/']],


                    '<li class="header">SETING USER</li>',
                    ['label' => '<i class="fa fa-users"></i><span>Users</span>
                                    <i class="fa fa-angle-left pull-right"></i>','url' => ['/admin/users/index/']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Role</span>', 'url' => ['/admin/role']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Assignment</span>', 'url' => ['/admin/assignment']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Permission</span>', 'url' => ['/admin/permission']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Rule</span>', 'url' => ['/admin/rule']],
                    ['label' => '<i class="fa fa-dashboard"></i><span>Route</span>', 'url' => ['/admin/route']],


                    '<li class="header">SETING</li>',
                    ['label' => '<i class="fa fa-book"></i><span>Blog</span>', 'url' => ['/admin/blog/index/']],
                    ['label' => '<i class="fa fa-folder"></i><span>Category</span>', 'url' => ['/admin/category/index/']],
                    [
                        'label' => '<i class="glyphicon glyphicon-lock"></i><span>Sing in</span>', //for basic
                        'url' => ['/login'],
                        'visible' =>Yii::$app->user->isGuest
                    ],
                ],
            ]
        );
        ?>

        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>Same tools</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= \yii\helpers\Url::to(['/gii']) ?>"><span class="fa fa-file-code-o"></span> Gii</a>
                    </li>
                    <li><a href="<?= \yii\helpers\Url::to(['/debug']) ?>"><span class="fa fa-dashboard"></span> Debug</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-circle-o"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-circle-o"></i> Level Two <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

    </section>

</aside>
