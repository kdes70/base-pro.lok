<?php

    use yii\bootstrap\Nav;
    use yii\bootstrap\NavBar;

    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'activateParents' => true,
        'items' => array_filter([
            ['label' => Yii::t('app', 'NAV_HOME'), 'url' => ['/main/default/index']],
            ['label' => Yii::t('app', 'NAW_CONTACT'), 'url' => ['/main/contact/index']],
            ['label' => Yii::t('app', 'NAW_BLOG'), 'url' => ['/blog/default/index']],
            ['label' => Yii::t('app', 'NAW_CONTRACTOR'), 'url' => ['/tender/default/index']],
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_SIGNUP'), 'url' => ['/user/default/signup']] :
                false,
            Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_LOGIN'), 'url' => ['/user/default/login']] :
                false,
            Yii::$app->user->can('admin') ?
                ['label' => Yii::t('app', 'NAV_ADMIN'), 'items' => [
                    ['label' => Yii::t('app', 'NAV_ADMIN'), 'url' => ['/admin/default/index']],
                    ['label' => Yii::t('app', 'ADMIN_USERS'), 'url' => ['/admin/users/index']],
                ]] :
                false,
            !Yii::$app->user->isGuest ?
                ['label' => Yii::t('app', 'NAV_PROFILE').' '. Yii::$app->user->identity->username, 'items' => [
                    ['label' => Yii::t('app', 'NAV_PROFILE'), 'url' => ['/user/profile/index']],
                    ['label' => Yii::t('app', 'NAV_LOGOUT'),
                     'url' => ['/user/default/logout'],
                     'linkOptions' => ['data-method' => 'post']]
                ]] :
                false,
        ]),
    ]);
    NavBar::end();
?>