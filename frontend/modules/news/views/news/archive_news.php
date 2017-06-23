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
$this->title = 'Архив новостей за ' . date('d-m-Y', strtotime($date));
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Архив новостей за ' . date('d-m-Y', strtotime($date)),
]);
$md = new \common\classes\Mobile_Detect();
?>

<section class="news">
    <div class="container">
        <div class="news-slider-index-panel">
            <h3>Горячие темы</h3>
            <div class="buttons-wrap">
                <a href="">подписаться</a>

            </div>
            <!--<div class="hot-tag">
                <a href="">Криптовалюты </a>
                <a href="">Дональд Трамп</a>
                <a href="">ОПЕК</a>
                <a href="">Китай Tesla </a>
            </div>-->
        </div>
        <div class="news__wrap">

            <?php foreach ($news as $new): ?>
                <!--<div class="news__wrap_item-sm">
                    <div class="thumb">
                        <img src="<?/*= $new->photo; */?>" alt="">
                        <div class="content-row">
                            <span><small class="view-icon"></small> <?/*= $new->views; */?></span>
                            <a>Новости</a>
                        </div>
                    </div>
                    <div class="content-item">
                        <p><a href="<?/*= Url::to([
                                '/news/default/view',
                                'slug' => $new->slug,
                            ]); */?>"><?/*= $new->title; */?></a></p>
                        <span><?/*= WordFunctions::dateWithMonts($new->dt_public); */?></span>
                    </div>
                </div>-->
                <div class="news__wrap_item-sm">
                    <!-- thumb -->
                    <a href="<?= Url::to([
                        '/news/default/view',
                        'slug' => $new->slug,
                    ]); ?>" class="thumb">
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($new->photo); ?>"
                             alt="">
                        <div class="content-row">
                            <span><small class="view-icon"></small> <?= $new->views; ?></span>
                            <span><small
                                    class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new->id) ?></span>
                            <span><?= $new['categoryNewsRelations'][0]['cat']->title; ?></span>
                        </div>
                    </a>
                    <!-- thumb -->
                    <div class="content-item">
                        <p><a href="<?= Url::to([
                                '/news/default/view',
                                'slug' => $new->slug,
                            ]); ?>"><?= $new->title; ?></a></p>
                        <span><?= WordFunctions::dateWithMonts($new->dt_public); ?></span>
                    </div>
                </div>

            <?php endforeach; ?>

            <?= \frontend\widgets\Subscribe::widget() ?>
        </div>

        <div class="news__wrap_buttons">
            <a href="#go_rubricator" class="businessScroll" style="line-height: 37px;"><span class="rotate-arrow"></span>рубрикатор</a>
            <!--<a
                href=""
                data-offset="34"
                csrf-token="<?/*= Yii::$app->getRequest()->getCsrfToken(); */?>"
                class="show-more show-more-news-js">загрузить
                БОЛЬШЕ</a>-->
            <span href="#" class="archive-news datepicker-here datepicker-wrap" >архив новостей <span class="rotate-arrow"></span></span>

        </div>

    </div>
</section>

<?= \frontend\modules\news\widgets\PeopleTalk::widget(); ?>

<?= \frontend\modules\news\widgets\RubricSlider::widget(); ?>


