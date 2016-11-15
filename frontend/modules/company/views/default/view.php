<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 09.09.2016
 * Time: 11:53
 * @var $company \common\models\db\Company
 */
use common\classes\DateFunctions;

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
    <h2><?= $company->name ?></h2>
    <a href="" class="view-img"><img src="<?= $company->photo ?>" alt=""></a>
    <p><b>Тел.:</b> <?= $company->phone ?></p>
    <p><b>Адрес:</b> <?= $company->address ?></p>
    <p><b>Email:</b> <?= $company->email ?></p>
    <?= $company->descr ?>
</div>
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
</div>