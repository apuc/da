<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 11:53
 * @var $company \common\models\db\Company
 */
use common\classes\DateFunctions;
use common\classes\WordFunctions;
use yii\helpers\Url;

$this->title = $company->meta_title;
$this->registerMetaTag( [
    'name'    => 'og:image',
    'content' => 'http://'. $_SERVER['HTTP_HOST'] . $company->photo,
] );
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $company->meta_descr,
] );
?>
<div class="shape">
    <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
</div>
<div class="news__post">
    <span
        class="date-news__post"><?= date( 'd', $company->dt_add ) ?> <?= DateFunctions::getMonthShortName( date( 'm', $company->dt_add ) ) ?> <?= date( 'H:i', $company->dt_add ) ?></span>
    <h2 class="map-company-title"><?= $company->name ?></h2>
    <a href="" class="view-img"><img src="<?= $company->photo ?>" alt=""></a>
    <p><b>Тел.:</b> <?= $company->phone ?></p>
    <p><b>Адрес:</b> <span style="display: inline-block;" class="map-company-location"><?= $company->address ?></span></p>
    <p><b>Email:</b> <?= $company->email ?></p>
    <div class="company-description"><?= $company->descr ?></div>

</div>
<div class="clearfix"></div>
<div id="map" style="width: 100%; height: 300px; padding: 0; padding-left: 80px; margin: 0; display: block; float: left;"></div>
<div class="post-nav">
    <span><a href=""><i class="fa fa-eye" aria-hidden="true"></i> <?= $company->views ?></a></span>
    <?php if ( ! empty( $company->tags ) ): ?>
        <span>Теги: <?= $company->tags ?></span>
    <?php endif ?>
    <?php
    $company_url = \yii\helpers\Url::base(true).\yii\helpers\Url::to();
    $company_title = strip_tags( $company->name );
    $company_title = preg_replace( "/\s{2,}/", " ", $company_title );
    $company_title = str_replace('"',"&quot;",$company_title);
    $company_img = 'http://'. $_SERVER['HTTP_HOST'] . $company->photo;

    $count_symbols = 800 - 48 - strlen($news_url) - strlen($news_title) - strlen($news_img);
    $company_content  = strip_tags( $company->descr );
    $company_content  = preg_replace( "/\s{2,}/", " ", $company_content );

    $company_content = substr($company_content, 0, $count_symbols) . '...';

    ?>


    <span>Поделись <a onclick="Share.twitter('<?=$company_url ?>',
            '<?= $company_title ?>')" href=""
                      class="soc-icon">
            <img class="twi" src="/theme/portal-donbassa/img/twi.png" alt="">
        </a>
        <a onclick="Share.facebook(
            '<?= $company_url ?>',
            '<?= $company_title; ?>',
            '<?= $company_img ; ?>',
            '<?= $company_content;?>')" href="" class="soc-icon">
            <img class="fb" src="/theme/portal-donbassa/img/fb.png" alt="">
        </a>

        <a onclick="Share.vkontakte(
            '<?= $company_url ?>',
            '<?= $company_title; ?>',
            '<?= $company_img ?>',
            '<?= $company_content; ?>'
            )" href="" class="soc-icon">
            <img class="vk" src="/theme/portal-donbassa/img/vk.png" alt="">
        </a>
        <a onclick="Share.odnoklassniki(
            '<?= $company_url ?>',
            '<?= $company_title; ?>'
            )" href="" class="soc-icon">
            <img class="ok" src="/theme/portal-donbassa/img/ok.png" alt="">
        </a>
    </span>

    <?php if ( ! empty( \common\models\db\KeyValue::find()->where( [ 'key' => 'likes_for_company' ] )->one()->value ) ): ?>
        <a data-id="<?= $company->id; ?>" data-type="company" class="likes"><i
                class="like_icon <?= ( empty( $user_set_like ) ? '' : 'like_icon-set' ); ?>"></i><span
                class="like-count"><?= $count_likes; ?></span></a>
    <?php endif; ?>
</div>
<div class="another-news">
    <div class="rand-cat-news">
        <?php if($related_company): ?>
            <h3>Похожие компании:</h3>
        <?php endif; ?>
        <?php foreach ($related_company as $related_new): ?>
            <a href="<?= Url::to( [ '/company/default/view', 'slug' => $related_new->slug ] ) ?>" class="news-like-item">
                <div class="news-like-img"><img src="<?= $related_new->photo;?>" alt=""></div>
                <h4 class="new-header"><?= $related_new->name;?></h4>
                <p class="new-descr"><?=  WordFunctions::crop_str_word( strip_tags( $related_new->descr ), 13 );?> </p>
            </a>
        <?php endforeach; ?>
    </div>
    <div class="best-views-news">
        <?php if($most_popular_company): ?>
            <h3>Самые популярные компании:</h3>
        <?php endif; ?>
        <?php foreach ($most_popular_company as $most_popular_new): ?>
            <a href="<?= Url::to( [ '/company/default/view', 'slug' => $most_popular_new->slug ] ) ?>" class="news-like-item">
                <div class="news-like-img"><img src="<?= $most_popular_new->photo;?>" alt=""></div>
                <h4 class="new-header"><?= $most_popular_new->name;?></h4>
                <p class="new-descr"><?=  WordFunctions::crop_str_word( strip_tags( $most_popular_new->descr ), 13 );?></p>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?= \frontend\widgets\Comments::widget([
    'post_id'=>$company->id,
    'post_type'=>'company',
]); ?>