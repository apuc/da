<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 13:57
 * @var $news \common\models\db\CategoryNewsRelations
 * @var $cat \common\models\db\CategoryNews
 * @var $pages \yii\data\Pagination
 */
use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\widgets\LinkPager;

$this->title = (empty($cat->meta_title))? $cat->title : $cat->meta_title;

?>
<div class="main-news" style="margin-top: 30px">
    <div class="container">
        <div class="news-posts">
            <?php foreach($news as $new): ?>
                <div class="news-posts__item" style="height:270px;">
                    <?php $dt = ($new['news']->dt_public != $new['news']->dt_add) ? $new['news']->dt_public : $new['news']->dt_add; ?>
                    <!--<span class="date-news__post"><?/*= date('d', $dt) */?> <?/*= DateFunctions::getMonthShortName(date('m', $dt)) */?> <?/*= date('H:i', $dt) */?></span>-->
                    <!--<h4 class="category"><a href="#"><?/*= $cat->title */?></a></h4>-->
                    <a href="/news/<?= $new['news']->slug ?>">
                        <h5 class="post-header"><?= $new['news']->title ?></h5>
                        <div class="post-image">
                            <img src="<?= $new['news']->photo ?>" alt="">
                        </div>
                        <p class="text-preview"><?= WordFunctions::crop_str_word(strip_tags($new['news']->content),15);  ?></p>
                    </a>
                    <a href="/news/<?= $new['news']->slug ?>" class="read-more more-news-link">Читать дальше <img src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>

                    <div class="line"></div>
                </div>
            <?php endforeach; ?>
            <div style="float: left;width: 100%;margin-top: 20px">
                <?php echo LinkPager::widget([
                    'pagination' => $pages,
                ]); ?>
            </div>

        </div>
        <div class="main-news-prefooter">
            <div class="social">
                <h4 class="social-header">МЫ В КОНТАКТЕ</h4>
                <div id="vk_groups_news"></div>
            </div>
            <div class="social">
                <h4 class="social-header">МЫ В ФЕЙСБУКЕ</h4>
                <div class="fb-page" data-href="https://www.facebook.com/da.info.pro/" data-heigh="180"
                     data-small-header="true" data-adapt-container-width="true" data-hide-cover="true"
                     data-show-facepile="true">
                    <blockquote cite="https://www.facebook.com/da.info.pro/" class="fb-xfbml-parse-ignore"><a
                            href="https://www.facebook.com/da.info.pro/">DA</a></blockquote>
                </div>
            </div>
<!--            <div class="banner-bottom">-->
<!--                <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">-->
<!--            </div>-->
        </div>
    </div>
</div>
