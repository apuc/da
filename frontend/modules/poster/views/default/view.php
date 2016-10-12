<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 11.10.2016
 * Time: 16:30
 * @var $poster \common\models\db\Poster
 */
use common\classes\DateFunctions;

?>
    <div class="shape">
        <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
    </div>
    <div class="bread-crumbs">
        <a href="#">Афиша</a>
        <span>&raquo</span>
        <p>Цирк</p>
    </div>
    <div class="poster-container">
        <span class="date-news__post"><?= date('d', $poster->dt_add) ?> <?= DateFunctions::getMonthShortName(date('m',$poster->dt_add)) ?></span>
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
    <div class="social">
        <h4 class="social-header">МЫ В КОНТАКТЕ</h4>
        <img src="/theme/portal-donbassa/img/we-at-vk.jpg" alt="">
    </div>
    <div class="banner-bottom">
        <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">
    </div>


