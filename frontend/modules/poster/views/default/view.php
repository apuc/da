<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 11.10.2016
 * Time: 16:30
 * @var $poster \common\models\db\Poster
 */
use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\helpers\Url;

$this->title =  $poster->title;
?>
    <div class="shape">
        <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
    </div>
    <div class="bread-crumbs">
        <a href="#">Афиша</a>
        <span>&raquo</span>
        <p><?= \frontend\modules\poster\models\Poster::getCategoryName($poster->id) ?></p>
    </div>
    <span class="consult-views-poster"><span class="views-ico fa fa-eye"></span><?= $poster->views;?></span>
    <div class="poster-container">
        <span class="date-news__post"><?= date('d', $poster->dt_event) ?> <?= DateFunctions::getMonthShortName(date('m',$poster->dt_event)) ?></span>
        <div class="poster-img-container">
            <img src="<?= $poster->photo ?>" alt="">
        </div>
        <div class="poster-description">
            <h4 class="poster-descr-header"><?= $poster->title ?></h4>
            <p class="poster-descr-top"><?= $poster->short_descr ?></p>
            <div class="by-ticket-container">
                <span class="price"><?= $poster->price ?></span>
                <!--<a href="#" class="red-button">Купить билет</a>-->
            </div>
            <p class="another-dates"><?= $poster->start ?></p>
        </div>

    </div>
    <div class="clearfix"></div>
    <p class="poster-descr-bot"><?= $poster->descr ?></p>

<?php if ( ! empty( \common\models\db\KeyValue::find()->where( [ 'key' => 'likes_for_posters' ] )->one()->value ) ): ?>
    <a data-id="<?= $poster->id; ?>" data-type="posters" class="likes"><i
            class="like_icon <?= ( empty( $user_set_like ) ? '' : 'like_icon-set' ); ?>"></i><span
            class="like-count"><?= $count_likes; ?></span></a>
<?php endif; ?>
<div class="another-news">
    <div class="rand-cat-news">
        <?php if($related_posters): ?>
            <h3>Похожие события:</h3>
        <?php endif; ?>
        <?php foreach ($related_posters as $related_new): ?>
            <a href="<?= Url::to( [ '/poster/default/view', 'slug' => $related_new->slug ] ) ?>" class="news-like-item">
                <div class="news-like-img"><img src="<?= $related_new->photo;?>" alt=""></div>
                <h4 class="new-header"><?= $related_new->title;?></h4>
                <p class="new-descr"><?=  WordFunctions::crop_str_word( strip_tags( $related_new->descr ), 13 );?> </p>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="best-views-news">
        <?php if($most_popular_posters): ?>
            <h3>Самые популярные события:</h3>
        <?php endif; ?>
        <?php foreach ($most_popular_posters as $most_popular_new): ?>
            <a href="<?= Url::to( [ '/poster/default/view', 'slug' => $most_popular_new->slug ] ) ?>" class="news-like-item">
                <div class="news-like-img"><img src="<?= $most_popular_new->photo;?>" alt=""></div>
                <h4 class="new-header"><?= $most_popular_new->title;?></h4>
                <p class="new-descr"><?=  WordFunctions::crop_str_word( strip_tags( $most_popular_new->descr ), 13 );?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?= \frontend\widgets\Comments::widget([
    'post_id'=>$poster->id,
    'post_type'=>'posters',
]); ?>
<div class="prefooter-social">
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
    <!--            <div class="weather-forecast">-->
    <!--                <h4 class="weather-header">Погода</h4>-->
    <!--                <img src="/theme/portal-donbassa/img/prefooter-weather.jpg" alt="">-->
    <!--            </div>-->
    <!--            <div class="banner-bottom">-->
    <!--                <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">-->
    <!--            </div>-->
</div>


<!--    <div class="banner-bottom">-->
<!--        <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">-->
<!--    </div>-->


