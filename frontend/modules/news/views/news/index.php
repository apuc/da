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

$this->title = Yii::t('news', 'News');
$this->params['breadcrumbs'][] = $this->title;

$md = new \common\classes\Mobile_Detect();
?>
<div class="main-news" style="margin-top: 30px">
    <div class="container">
        <div class="news-gallery-container">
            <?php $i = 0; ?>
            <?php foreach ($news_5 as $new): ?>
                <?php if ($i == 0): ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $new->slug]) ?>"
                       class="big-news-gallery-item">
                        <img src="<?= $new->photo ?>" alt="">
                        <span class="news-text">
                            <h4 class="gallery-news-text-header"><?= $new->title ?></h4>
                            <p>
                                <?= WordFunctions::crop_str_word(strip_tags($new->content), 20); ?>
                            </p>
                        </span>
                    </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/news/default/view', 'slug' => $new->slug]) ?>" class="news-gallery-item">
                        <img src="<?= $new->photo ?>" alt="">
                        <span class="news-text">
                            <p>
                                <?= $new->title ?>
                            </p>
                        </span>
                    </a>
                <?php endif; ?>
                <?php $i++; ?>
            <?php endforeach; ?>
            <div class="shape">
                <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
            </div>
        </div>

        <div class="all-news-to-day">
            <h4>Все новости</h4>

            <ul class="news">
                <?php Pjax::begin(); ?>
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list',
                    'layout' => "{items}\n<div class='paginator'>{pager}</div>",
                    'pager' => [
                        'options' => [
                            'class' => 'paginator',
                            'tag' => 'div',
                        ],
                        'maxButtonCount' => ($md->isMobile() or $md->isTablet()) ? 5 : 15,
                        'nextPageCssClass' => 'next',
                        'nextPageLabel' => '<img src="/theme/portal-donbassa/img/paginator-right.png" alt="">',
                        'prevPageCssClass' => 'prev',
                        'prevPageLabel' => '<img src="/theme/portal-donbassa/img/paginator-left.png" alt="">',
                    ]
                ]) ?>
                <?php Pjax::end(); ?>
            </ul>
        </div>

        <div class="news-posts">
            <?php foreach ($cat as $item): ?>
                <?php $news_item = \common\models\db\News::find()->leftJoin('category_news_relations', '`new_id` = `news`.`id`')->where(['cat_id' => $item->id])->limit(4)->orderBy('id DESC')->all(); ?>
                <div class="news-posts__item">
                    <?php $dt = ($news_item[0]->dt_public != $news_item[0]->dt_add) ? $news_item[0]->dt_public : $news_item[0]->dt_add; ?>
                    <!--<span class="date-news__post"><? /*= date('d', $dt) */ ?> <? /*= DateFunctions::getMonthShortName(date('m', $dt)) */ ?> <? /*= date('H:i', $dt) */ ?></span>-->
                    <h4 class="category">
                        <a href="<?= Url::to(['/news/news/category/', 'slug' => $item->slug]) ?>">
                            <?= $item->title ?>
                        </a>
                    </h4>
                    <a href="/news/<?= $news_item[0]->slug ?>">
                        <div class="post-overflow">
                            <div class="post-image">
                                <img src="<?= $news_item[0]->photo ?>" alt="">
                            </div>
                            <h5 class="post-header"><?= $news_item[0]->title ?></h5>
                        </div>
                    </a>
                    <!--<a href="/news/<? /*= $news_item[0]->slug */ ?>">
                        <div class="post-overflow">
                            <div class="post-image">
                                <img src="<? /*= $news_item[0]->photo */ ?>" alt="">
                            </div>
                            <h5 class="post-header"><? /*= $news_item[0]->title */ ?></h5>
                        </div>
                    </a>-->
                    <a href="#" class="read-more more-news-link">Читать дальше <img
                            src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                    <ul class="more-news">
                        <li>
                            <a class="more-news-link"
                               href="<?= Url::to(['/news/default/view', 'slug' => $news_item[1]->slug]) ?>">
                                <?= $news_item[1]->title ?>
                            </a>
                        </li>
                        <li>
                            <a class="more-news-link"
                               href="<?= Url::to(['/news/default/view', 'slug' => $news_item[2]->slug]) ?>">
                                <?= $news_item[2]->title ?>
                            </a>
                        </li>
                        <li>
                            <a class="more-news-link"
                               href="<?= Url::to(['/news/default/view', 'slug' => $news_item[3]->slug]) ?>">
                                <?= $news_item[3]->title ?>
                            </a>
                        </li>
                    </ul>
                    <div class="line"></div>
                    <a href="<?= Url::to(['/news/news/category/', 'slug' => $item->slug]) ?>"
                       class="more-news-link watch-all">Смотреть все <img
                            src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="main-news-prefooter">
            <div class="social">
                <h4 class="social-header">МЫ В КОНТАКТЕ</h4>
                <div id="vk_groups_news"></div>

            </div>
            <div class="social">
                <h4 class="social-header">МЫ В ФЕЙСБУКЕ</h4>
                <div class="fb-page" data-href="https://www.facebook.com/da.info.pro/" data-heigh = "180" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/da.info.pro/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/da.info.pro/">DA</a></blockquote></div>

            </div>
<!--            <div class="weather-forecast">-->
<!--                <h4 class="weather-header">Погода</h4>-->
<!--                <img src="/theme/portal-donbassa/img/prefooter-weather.jpg" alt="">-->
<!--            </div>-->
<!--            <div class="banner-bottom">-->
<!--                <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">-->
<!--            </div>-->
        </div>
    </div>
</div>
