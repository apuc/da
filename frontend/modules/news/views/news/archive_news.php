<?php

use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $cat \common\models\db\CategoryNews
 * @var $news_5 \common\models\db\News
 */

//$this->title                   = Yii::t( 'news', 'News' );
$this->params['breadcrumbs'][] = $this->title;
$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
$md = new \common\classes\Mobile_Detect();
?>

<section class="news">
    <div class="container">
        <div class="news-slider-index-panel">
            <h3>Горяичие темы</h3>
            <div class="buttons-wrap">
                <a href="">подписаться</a>

            </div>
            <!--<div class="hot-tag">-->
            <!--    <a href="">Криптовалюты </a>-->
            <!--    <a href="">Дональд Трамп</a>-->
            <!--    <a href="">ОПЕК</a>-->
            <!--    <a href="">Китай Tesla </a>-->
            <!--</div>-->
        </div>
        <div class="news__wrap">

            <?php foreach ($news as $new): ?>
                <div class="news__wrap_item-sm">
                    <div class="thumb">
                        <img src="<?= $new->photo; ?>" alt="">
                        <div class="content-row">
                            <span><small class="view-icon"></small> <?= $new->views; ?></span>
                            <a>Новости</a>
                        </div>
                    </div>
                    <div class="content-item">
                        <p><a href="<?= Url::to([
                                '/news/default/view',
                                'slug' => $new->slug,
                            ]); ?>"><?= $new->title; ?></a></p>
                        <span><?= WordFunctions::dateWithMonts($new->dt_public); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="home-content__wrap_subscribe">
                <div class="subscribe__wrap">
                    <h3>ПОДПИСАТЬСЯ НА НОВОСТИ</h3>
                    <form action="">
                        <input type="text" placeholder="Выслать на email">
                        <button>подписаться</button>
                    </form>
                    <div class="social-wrap">
                        <h4>мы в социальных сетях</h4>
                        <a href="" class="social-wrap__item vk">
                            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item fb">
                            <img src="/theme/portal-donbassa/img/soc/fb.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item ok">
                            <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item insta">
                            <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item twitter">
                            <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item google">
                            <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item pinterest">
                            <img src="/theme/portal-donbassa/img/soc/pinter-icon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= \frontend\modules\news\widgets\PeopleTalk::widget(); ?>

<?= \frontend\modules\news\widgets\RubricSlider::widget(); ?>


