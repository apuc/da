<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style>
            .mnu-link a{
                color: whitesmoke!important;
            }
        </style>
    </head>
    <body>
<?php $this->beginBody() ?>
<section class="header__top">
    <div class="container">
        <div class="city">
            <p class="city-string"><span class="geo-city"></span>Ваш город:</p>
            <div class="delivery_block">
                <div class="delivery_list">
                    <span>Донецк</span></div>
                <ul class="cities_list">
                    <li>Макеевка</li>
                    <li>Луганск</li>
                    <li>Транпорт</li>
                    <li>Казань</li>
                </ul>
            </div>
            <p class="weather"><span class="sun"></span>+25</p>
        </div>
        <div class="currency">
            <p>usd <span>24/34</span></p>
            <p>eur <span>34/45</span></p>
            <p>rub <span>98/100</span></p>
        </div>
        <div class="search">
            <form action="">
                <span class="search-icon"></span>
                <input type="search" placeholder="поиск">
            </form>
        </div>
    </div>
</section>
<section class="header__main">
    <div class="container">
        <a href="" class="header__main_logo" style="width: 25%"><img width="70%" src="/theme/portal-donbassa/img/logo2.png" alt=""></a>
        <div class="header__main_panel" style="width: 70%">
            <?php echo \frontend\widgets\MainMenu::widget() ?>
            <!--<div class="header__main_panel_user">
                <a href="" class="header__main_panel_user-name">Александр Константинович</a>
                <a href="" class="header__main_panel_user-pic"><img src="/theme/portal-donbassa/img/user-pic.png" alt=""></a>
                <a href="" class="header__main_panel_user-exit"><span class="exit-icon"></span></a>
            </div>-->
        </div>
    </div>
</section>
<section class="header__menu">
    <div class="container">
        <button class="toggle_mnu">
        <span class="sandwich">
          <span class="sw-topper"></span>
          <span class="sw-bottom"></span>
          <span class="sw-footer"></span>
        </span>
        </button>

    </div>
</section>
<section class="header__banner">
    <img src="/theme/portal-donbassa/img/banner.png" alt="">
    </div>
</section>

<!-- end header.html-->
<!-- start content.html-->

<!-- @@block  =  content-->
<section class="title">
    <div class="container">
        <h2>Новости</h2>
        <div class="title-right">
            <a href="<?= Url::to(['/news/news/create']) ?>" class="header__main_panel-add-cont"><span class="header-news icon"></span>Предложить новость </a>
            <a href="<?= Url::to(['/news/news/']) ?>" class="all-news"><i class="fa fa-newspaper-o" aria-hidden="true"></i>все новости</a>
            <a href="" class="popular"><span></span>Популярные заведения</a>
        </div>
    </div>
</section>
<section class="content">
    <div class="container">
        <div class="content__main">
            <?php echo \frontend\modules\mainpage\widgets\News::widget()?>
            <?php echo \frontend\modules\mainpage\widgets\Company::widget()?>
            <div class="title">
                <h2>афиша</h2>
                <div class="title-right">
                    <a href="" class="all-news">вся афиша</a>
                </div>
            </div>
            <div class="afisha">
                <div class="afisha__left">
                    <div class="afisha__main">
                        <div class="thumb">
                            <span class="afisha-date"><b>20</b> сен</span>
                            <img src="/theme/portal-donbassa/img/big-afisha.png" alt="">
                        </div>
                        <div class="about">
                            <p>Афиша:: Кино</p>
                            <h2>Ночные стражи</h2>
                            <p>Фэнтези, боевик, приключения США, Китай, Канада 2016</p>
                        </div>
                    </div>
                </div>
                <div class="afisha__right">
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                    <a href="" class="afisha__right_item">
                        <span class="afisha-date-small"><b>20</b> сен</span>
                        <img src="/theme/portal-donbassa/img/small-afisha.png" alt="">
                        <p>Lorem ipsum dolor sit amet</p>
                    </a>
                </div>
            </div>
            <div class="banner-bottom">
                <img src="/theme/portal-donbassa/img/banner-bottom.png" alt="">
            </div>
        </div>
        <!-- right bar -->
        <div class="right-bar">
            <h2>топ лучших</h2>
            <a href="<?= Url::to(['/company/company/create']) ?>" class="add-ad">Добавить предприятие </a>
            <div class="right-bar__ad">
                <div class="right-bar__ad_items">
                    <img src="/theme/portal-donbassa/img/pic-ad.png" alt="">
                    <h4>Ресторан “Больше жизни”</h4>
                    <span>Донецк, ул. Щетинина 22</span>
                </div>
                <div class="right-bar__ad_items">
                    <img src="/theme/portal-donbassa/img/pic-ad.png" alt="">
                    <h4>Ресторан “Больше жизни”</h4>
                    <span>Донецк, ул. Щетинина 22</span>
                </div>
                <div class="right-bar__ad_items">
                    <img src="/theme/portal-donbassa/img/pic-ad.png" alt="">
                    <h4>Ресторан “Больше жизни”</h4>
                    <span>Донецк, ул. Щетинина 22</span>
                </div>
                <div class="right-bar__ad_items">
                    <img src="/theme/portal-donbassa/img/pic-ad.png" alt="">
                    <h4>Ресторан “Больше жизни”</h4>
                    <span>Донецк, ул. Щетинина 22</span>
                </div>
                <a class="add-ad" href="">ДОБАВИТЬ ОБЪЯВЛЕНИЕ ?</a>
            </div>
            <div class="right-bar__ad-room">
                <h2>объявления</h2>
                <a href="" class="ad-room">
                    <img src="/theme/portal-donbassa/img/room.png" alt="">
                    <h4>3-к квартира, 65 м², 4/9 эт.</h4>
                    <p><span class="geo-icon"></span>р-н Пролетарский</p>
                </a>
                <a href="" class="ad-room">
                    <img src="/theme/portal-donbassa/img/room.png" alt="">
                    <h4>3-к квартира, 65 м², 4/9 эт.</h4>
                    <p><span class="geo-icon"></span>р-н Пролетарский</p>
                </a>
                <a href="" class="ad-room">
                    <img src="/theme/portal-donbassa/img/room.png" alt="">
                    <h4>3-к квартира, 65 м², 4/9 эт.</h4>
                    <p><span class="geo-icon"></span>р-н Пролетарский</p>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- @@close-->

<!-- end content.html-->
<!-- start footer.html-->
<!-- @@block  =  footer-->

<section class="footer">
    <div class="container">
        <div class="footer__menu">
            <ul class="footer__menu_mnu">
                <li class=""><a href="">главная</a></li>
                <li class=""><a href="">новости </a></li>
                <li class=""><a href="">предприятия</a></li>
                <li class=""><a href="">объявления </a></li>
                <li class=""><a href="">досуг</a></li>
                <li class=""><a href="">о нас</a></li>
            </ul>
        </div>
        <a href="" class="header__main_logo">Портал <span>ДОНБАССА</span></a>
        <p class="footer-alert">Любое использование материалов сайта  разрешается только при условии указания гиперссылки на материал.</p>
        <ul class="social">
            <li><a href="" class="circle"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
            <li><a href="" class="circle"><i class="fa fa-vk" aria-hidden="true"></i></a></li>
            <li><a href="" class="circle"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="" class="circle"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            <li><a href="" class="circle"><i class="fa fa-odnoklassniki" aria-hidden="true"></i> </a></li>
            <li><a href="" class="circle"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
            <li><a href="" class="circle"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
        </ul>
    </div>
    <div class="bottom-footer">
    </div>
</section>
<!-- @@close-->
<?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
