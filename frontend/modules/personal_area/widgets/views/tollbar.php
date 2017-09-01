<?php
?>

<div class="cabinet__tollbar">

    <a href="<?= \yii\helpers\Url::to(['/personal_area/default/index'])?>" class="cabinet__avatar">
        <?= \common\classes\UserFunction::getUser_avatar_html(Yii::$app->user->id)?>
        <!--<img src="<?/*= \common\classes\UserFunction::getUser_avatar_url(Yii::$app->user->id, false)*/?>" alt="">-->
    </a>

    <a href="<?= \yii\helpers\Url::to('/user/settings/profile'); ?>" class="cabinet__avatar--edit"></a>

    <div class="cabinet__info">

        <!--<h3><span><img src="img/cabinet/cabinet-logo.png" alt=""></span>Компания феникс</h3>-->

        <!--<p class="cabinet__pkg">Пакет расширенный</p>

        <p class="cabinet__pkg-time">до <span>23.05.2015 (еще 1 месяц)</span></p>

        <a href="#" class="cabinet__add-pkg"></a>

        <a href="#" class="cabinet__froze-pkg">Заморозить абонемент</a>

        <a href="#" class="show-more">РЕДАКТИРОВАТЬ</a>-->

    </div>

    <ul class="cabinet__list">
        <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-news'])?>" class="news">НОВОСТИ <!--<span>258</span>--></a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-poster'])?>" class="poster">АФИШИ</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-promotions'])?>" class="stock">АКЦИИ</a></li>
        <!--<li><a href="#" class="configuration">Настройки</a></li>-->
        <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-company'])?>" class="company">ПРЕДПРИЯТИЯ <!--<span class="add"></span>--></a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-comments'])?>" class="comments">КОМЕНТАРИИ <!--<span class="add"></span>--></a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/personal_area/user-ads'])?>" class="advert">ОБЪЯВЛЕНИЯ <!--<span class="add"></span>--></a></li>
        <!--<li><a href="#" class="notice">Уведомления <span>89</span></a></li>-->
    </ul>

</div>
