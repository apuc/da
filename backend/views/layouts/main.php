<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php $this->beginBody() ?>

    <?php
    if (Yii::$app->user->isGuest): ?>
        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Url::to(['/']) ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">Админпанель</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Админпанель</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">

            </nav>
        </header>
        <div class="content-wrapper contentLoginAdmin">
            <!-- Main content -->
            <section class="content">
                <?= Alert::widget() ?>
                <?/*= $content */?>
                <?= \backend\widgets\Login::widget(); ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer contentLoginAdmin">
            <div class="pull-right hidden-xs">
            </div>
            <strong>&copy; My Company <?= date('Y') ?></strong>
        </footer>
    <?php else: ?>

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Url::to(['/']) ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">Админпанель</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">Админпанель</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->

            <nav class="navbar navbar-static-top" role="navigation">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a data-method="post" href="<?= Url::to(['/site/logout']); ?>"><i class="fa fa-sign-out"></i></a>
                            <?/*= Html::endForm(); */?>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <?= \backend\widgets\MainMenuAdmin::widget(); ?>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <!--<ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>-->
            </section>

            <!-- Main content -->
            <section class="content">
                <?= Alert::widget() ?>
                <?= $content ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        <footer class="main-footer contentLoginAdmin">
            <div class="pull-right hidden-xs">
            </div>
            <strong>&copy; My Company <?= date('Y') ?></strong>
        </footer>

        <?php
        //Yii::$app->getResponse()->redirect(Yii::$app->urlManagerFrontend->createUrl(Url::base()));

        //   \common\classes\Debug::prn(Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/index']));
        //Yii::$app->getResponse()->redirect(Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/index']), 200);
        //Yii::$app->response->redirect(Yii::$app->urlManagerFrontend->createAbsoluteUrl(['site/index']));
        /*return $this->redirect(Yii::$app->urlManagerFrontend->createUrl(Url::base())); */?>
    <?php endif ?>



    <!--<div class="wrap">
    <?php
    /*    NavBar::begin([
            'brandLabel' => 'My Company',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
        ];
        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
        } else {
            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        */ ?>

    <div class="container">
        <? /*= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) */ ?>
        <? /*= Alert::widget() */ ?>
        <? /*= $content */ ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <? /*= date('Y') */ ?></p>

        <p class="pull-right"><? /*= Yii::powered() */ ?></p>
    </div>
</footer>-->
</div><!-- ./wrapper -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
