<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
if ($exception->statusCode == 404){
    ?>
    <img style="z-index: 0" class="error-404" src="/theme/portal-donbassa/img/404.png" alt="">
    <div class="buttons-left">
        <a class="nav-404" href="<?= Url::to(['/all-new']);?>">НОВОСТИ</a>
        <a class="nav-404" href="<?= Url::to(['/all-company']);?>">ПРЕДПРИЯТИ</a>
    </div>
    <div class="buttons-right">
        <a class="nav-404" href="<?= Url::to(['design']);?>">ОБЪЯВЛЕНИЯ</a>
        <a class="nav-404" href="<?= Url::to(['/consulting']);?>">КОНСУЛЬТАЦИЯ</a></div>
    <?php
}else{
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        The above error occurred while the Web server was processing your request.
    </p>
    <p>
        Please contact us if you think this is a server error. Thank you.
    </p>

</div>
<?php }; ?>