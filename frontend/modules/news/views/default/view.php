<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 16:15
 * @var $news \common\models\db\News
 */

use common\classes\DateFunctions;

$this->title = $news->meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $news->meta_descr,
] );
?>
<div class="shape">
    <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
</div>
<div class="news__post">
    <span
        class="date-news__post"><?= date( 'd', $news->dt_add ) ?> <?= DateFunctions::getMonthShortName( date( 'm', $news->dt_add ) ) ?> <?= date( 'H:i', $news->dt_add ) ?></span>
    <h2><?= $news->title ?></h2>
    <a href="<?= $news->photo ?>" data-lightbox="image-1" class="view-img"><img src="<?= $news->photo ?>" alt=""></a>
    <?= $news->content ?>
</div>
<div class="post-nav">
    <span><a href=""><i class="fa fa-eye" aria-hidden="true"></i> <?= $news->views ?></a></span>
    <?php if ( ! empty( $news->tags ) ): ?>
        <span>Теги: <?= $news->tags ?></span>
    <?php endif ?>
    <?php
    $news_url = \yii\helpers\Url::base(true).\yii\helpers\Url::to();
    $news_title = strip_tags( $news->title );
    $news_title = preg_replace( "/\s{2,}/", " ", $news_title );
    $news_title = str_replace('"',"&quot;",$news_title);
    $news_img = 'http://'. $_SERVER['HTTP_HOST'] . $news->photo;

    $count_symbols = 800 - 48 - strlen($news_url) - strlen($news_title) - strlen($news_img);
    $news_content  = strip_tags( $news->content );
    $news_content  = preg_replace( "/\s{2,}/", " ", $news_content );

    $news_content = substr($news_content, 0, $count_symbols) . '...';

    ?>


    <span>Поделись <a onclick="Share.twitter('<?=$news_url ?>',
            '<?= $news_title ?>')" href=""
                      class="soc-icon">
            <img class="twi" src="/theme/portal-donbassa/img/twi.png" alt="">
        </a>
        <a onclick="Share.facebook(
            '<?= $news_url ?>',
            '<?= $news_title; ?>',
            '<?= $news_img; ?>',
            '<?= $news_content; ?>')" href="" class="soc-icon">
            <img class="fb" src="/theme/portal-donbassa/img/fb.png" alt="">
        </a>

        <a onclick="Share.vkontakte(
            '<?= $news_url ?>',
            '<?= $news_title; ?>',
            '<?= $news_img; ?>',
            '<?= $news_content; ?>'
            ); return false;" href="" class="soc-icon">
            <img class="vk" src="/theme/portal-donbassa/img/vk.png" alt="">
        </a>
        <a onclick="Share.odnoklassniki(
            '<?= $news_url ?>',
            '<?= $news_title; ?>'
            )" href="" class="soc-icon">
            <img class="ok" src="/theme/portal-donbassa/img/ok.png" alt="">
        </a>
    </span>
</div>
