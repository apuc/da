<?php
/**
 * @var $cat \backend\modules\category\models\CategoryNews
 * @var $news \common\models\db\News
 */
use common\classes\WordFunctions;
use yii\helpers\Url;

?>
<ul class="content__main_mnu" style="width: 100%">
<!--    <li class="menu-link active"><a href="#" data-id="0">картина дня</a></li>-->
    <?php foreach($cat as $item): ?>
        <li class="menu-link"><a href="#" data-id="<?= $item->id ?>"><?= $item->title ?></a></li>
    <?php endforeach; ?>
</ul>
<?php if ($main_new): ?>
    <div class="content__main_post">
        <div class="content__main_post_pic">
            <a href="#" class="date-post">
                <span class="date"><?= date('Y-m-d H:i', $main_new->dt_public) ?></span>
                <span class="note"></span>
            </a>
            <img src="<?= $main_new->photo ?>" alt="">
        </div>
        <div class="content__main_post_text">
            <h2><?= $main_new->title ?></h2>
            <!--<p><?/*= WordFunctions::crop_str_word(strip_tags($main_new->content));  */?></p>-->
        </div>
        <div class="content__main_post_navigation">
            <a href="" class="views"><span class="view-icon"></span><?= $main_new->views ?> просмотров  </a>
            <!--<a href="" class="comments"><span class="comments-icon"></span> 21 комментарий</a>-->
            <a href="<?= Url::to(['/news/default/view', 'slug' => $main_new->slug]) ?>" class="next-read">Читать дальше<span class="arrow-next"></span></a>
        </div>
    </div>
<?php else: ?>
    <div class="content__main_post">
        <div class="content__main_post_pic">
            <a href="#" class="date-post">
                <span class="date"><?= date('Y-m-d H:i', $news[0]->dt_public) ?></span>
                <span class="note"></span>
            </a>
            <img src="<?= $news[0]->photo ?>" alt="">
        </div>
        <div class="content__main_post_text">
            <h2><?= $news[0]->title ?></h2>
            <!--<p><?/*= WordFunctions::crop_str_word(strip_tags($news[0]->content));  */?></p>-->
        </div>
        <div class="content__main_post_navigation">
            <a href="" class="views"><span class="view-icon"></span><?= $news[0]->views ?> просмотров  </a>
            <!--<a href="" class="comments"><span class="comments-icon"></span> 21 комментарий</a>-->
            <a href="<?= Url::to(['/news/default/view', 'slug' => $news[0]->slug]) ?>" class="next-read">Читать дальше<span class="arrow-next"></span></a>
        </div>
    </div>
<?php endif; ?>
<div class="content__main_posts">
    <?php foreach($news as $new): ?>
        <a href="<?= Url::to(['/news/default/view', 'slug' => $new->slug]) ?>" data-id="<?= $new->id ?>" class="content__main_posts_items">
<!--            <p class="post-of-time"><span class="posts-time">--><?//= date('H:i', $new->dt_add) ?><!--</span>--><?//= $new->title ?><!--</p>-->
<!--            <p class="post-of-time"><span class="posts-time">--><?//= \frontend\modules\mainpage\widgets\News::getDateNew(date('H:i', $new->dt_add)); ?><!--</span>--><?//= $new->title ?><!--</p>-->
            <p class="post-of-time"><span class="posts-time"><?= \frontend\modules\mainpage\widgets\News::getDateNew(date('d.m.Y', $new->dt_public)) . ' ' . date('H:i', $new->dt_public); ?></span><?= $new->title ?></p>
        </a>
    <?php endforeach; ?>

    <a href="<?= Url::to(['/news/news']) ?>" class="watch-all">Смотреть все <img src="/theme/portal-donbassa/img/scroll-arrow-to-right.svg" width="4px" height="6px"></a>
</div>