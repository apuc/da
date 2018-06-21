<?php

use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/**
 * @var $cat \common\models\db\CategoryNews
 * @var $news_5 \common\models\db\News
 * @var $meta_title string
 * @var $meta_descr string
 * @var $hotNews \common\models\db\News
 * @var $currHotNew \common\models\db\News
 * @var $currNew \common\models\db\News
 */
//$this->title                   = Yii::t( 'news', 'News' );
$this->title = $meta_title;
$this->params['breadcrumbs'][] = 'Всё чтиво';

$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
$this->registerLinkTag([
        'rel' => 'amphtml',
        'href' => 'https://da-info.pro/amp'
]);

$this->registerLinkTag([
    'href' => Url::home(true) . 'all-news',
    'rel' => 'canonical',
]);
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$md = new \common\classes\Mobile_Detect();
?>


<section class="news">
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>


        <div class="news-slider-index-panel">
            <h3>Горячие темы</h3>
            <div class="buttons-wrap">
                <a href="#subscribe" class="subscribe-scroll">подписаться</a>
            </div>
        </div>
        <div class="news__wrap">

            <?php
            $simpleNewId = 0;
            $hotNewId = 0;
            for ($i = 0; $i <= 38; $i++):
                if (!in_array($i, $hotNewsIndexes)):
                    $currNew = $news[$simpleNewId];

                    if (in_array($i, $bigNewsIndexes)):
                        ?>
                        <a href="<?= Url::to([
                            '/news/default/view',
                            'slug' => $currNew->slug,
                        ]); ?>" class="news__wrap_item-lg" title="<?= $currNew->title; ?>">
                            <div class="thumb">
                                <?php if (stristr($currNew->photo, 'http')): ?>
                                    <img class="thumbnail" src="<?= $currNew->photo ?>"
                                         alt="<?= !empty($currNew->alt) ? $currNew->alt : $currNew->title ?>"">
                                <?php else: ?>
                                    <img class="thumbnail"
                                         src="<?= \common\models\UploadPhoto::getImageOrNoImage($currNew->photo); ?>"
                                         alt="<?= !empty($currNew->alt) ? $currNew->alt : $currNew->title ?>"">
                                <?php endif; ?>
                                <div class="content-row">
                                    <span><?= WordFunctions::dateWithMonts($currNew->dt_public); ?></span>
                                    <span><?= $currNew['categoryNewsRelations'][0]['cat']->title; ?></span>
                                    <span><small class="view-icon"></small> <?= $currNew->views; ?></span>
                                    <span><small
                                                class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($currNew->id) ?></span>
                                    <h2><?= $currNew->title; ?></h2>
                                </div>

                            </div>
                        </a>
                    <?php else: ?>
                        <div class="news__wrap_item-sm">
                            <!-- thumb -->
                            <a href="<?= Url::to([
                                '/news/default/view',
                                'slug' => $currNew->slug,
                            ]); ?>" class="thumb" title="<?= $currNew->title; ?>">
                                <?php if (stristr($currNew->photo, 'http')): ?>
                                    <img class="thumbnail" src="<?= $currNew->photo ?>"
                                         alt="<?= !empty($currNew->alt) ? $currNew->alt : $currNew->title ?>">
                                <?php else: ?>
                                    <img class="thumbnail"
                                         src="<?= \common\models\UploadPhoto::getImageOrNoImage($currNew->photo); ?>"
                                         alt="<?= !empty($currNew->alt) ? $currNew->alt : $currNew->title ?>">
                                <?php endif; ?>
                                <div class="content-row">
                                    <span><small class="view-icon"></small> <?= $currNew->views; ?></span>
                                    <span><small
                                                class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($currNew->id) ?></span>
                                    <span><?= $currNew['categoryNewsRelations'][0]['cat']->title; ?></span>
                                </div>
                            </a>
                            <!-- thumb -->
                            <div class="content-item">
                                <p><a href="<?= Url::to([
                                        '/news/default/view',
                                        'slug' => $currNew->slug,
                                    ]); ?>" title="<?= $currNew->title; ?>"><?= $currNew->title; ?></a></p>
                                <span><?= WordFunctions::dateWithMonts($currNew->dt_public); ?></span>
                            </div>
                        </div>
                    <?php
                    endif;
                    $simpleNewId++;
                else:

                    $currHotNew = $hotNews[$hotNewId];

                    ?>
                    <a href="<?= Url::to([
                        '/news/default/view',
                        'slug' => $currHotNew->slug,
                    ]); ?>" class=" news__wrap_item-sm-hot" title="<?= $currHotNew->title; ?>">
                        <!-- thumb -->
                        <div class="thumb">

                            <?php if (stristr($currHotNew->photo, 'http')): ?>
                                <img class="thumbnail" src="<?= $currHotNew->photo ?>"
                                     alt="<?= !empty($currHotNew->alt) ? $currHotNew->alt : $currHotNew->title ?>">
                            <?php else: ?>
                                <img class="thumbnail"
                                     src="<?= \common\models\UploadPhoto::getImageOrNoImage($currHotNew->photo); ?>"
                                     alt="<?= !empty($currHotNew->alt) ? $currHotNew->alt : $currHotNew->title ?>">
                            <?php endif; ?>

                            <div class="content-row">
                                <span><small class="view-icon"></small><?= $currHotNew->views; ?></span>
                                <span><small
                                            class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($currHotNew->id) ?></span>
                                <span><?= $currHotNew['categoryNewsRelations'][0]['cat']->title; ?></span>
                            </div>
                        </div>
                        <!-- thumb -->
                        <div class="hover-wrap">
                              <span class="category">
                                <span class="category-star"></span>
                                ГОРЯЧЕЕ
                              </span>
                            <h2><?= $currHotNew->title; ?></h2>
                        </div>
                    </a>


                    <?php
                    $hotNewId = $hotNewId + 1 == count($hotNews) ? 0 : $hotNewId + 1;
                endif;
            endfor; ?>
            <?= \frontend\widgets\Subscribe::widget() ?>
        </div>
        <div class="news__wrap_buttons">
            <a href="#go_rubricator" class="businessScroll">рубрикатор</a>
            <a
                    href=""
                    data-offset="34"
                    csrf-token="<?= Yii::$app->getRequest()->getCsrfToken(); ?>"
                    class="show-more show-more-news-js">загрузить
                БОЛЬШЕ</a>
            <span href="#" class="archive-news datepicker-here datepicker-wrap">архив чтива </span>

        </div>
    </div>
</section>

<?= \frontend\widgets\StreamMain::widget(); ?>
<?= \frontend\modules\news\widgets\RubricSlider::widget(); ?>
<? //= \frontend\modules\news\widgets\PeopleTalk::widget(); ?>





