<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\db\KeyValue;
use common\models\User;
use frontend\widgets\ExchangeRates;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <meta name="yandex-verification" content="6102a93fabadb2cf"/>
    <?= \frontend\widgets\Metrika::widget() ?>
    <!--<meta property="og:title" content="DA info"/>-->
    <!--<meta property="og:url" content="--><?//= Url::home(true); ?><!--"/>-->
    <meta property="og:image" content="<?= 'http://' . $_SERVER['HTTP_HOST'] ?>/theme/portal-donbassa/img/logo_da.png"/>
    <!--<meta property="og:description" content="Информационный портал города Донецка"/>-->
</head>
<body>
<?php $this->beginBody() ?>

<?= \frontend\widgets\ShowHeader::widget(); ?>

<section class="cabinet">
    <div class="container">
        <?= \frontend\modules\personal_area\widgets\ShowPersonalAreaTollbar::widget(); ?>

        <div class="cabinet__main">

            <div class="cabinet__owner">

                <h3><?= \common\classes\UserFunction::getUserName()?></h3>

                <!--<p>
                    <span></span>
                    Донецк
                </p>-->

            </div>

            <?= \frontend\modules\personal_area\widgets\ShowStatistikUser::widget(); ?>

            <?= $content; ?>
        </div>
    </div>
</section>
<a href="" class="fix-button"><img src="/theme/portal-donbassa/img/home-content/fix-button.png" alt=""></a>

<?= \frontend\widgets\ShowFooter::widget(); ?>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
