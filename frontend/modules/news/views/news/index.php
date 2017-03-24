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

//$this->title                   = Yii::t( 'news', 'News' );
$this->params['breadcrumbs'][] = $this->title;
$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );
$md = new \common\classes\Mobile_Detect();
?>

<section class="news">
    <div class="container">
        <div class="news-slider-index-panel">
            <h3>Горяичие темы</h3>
            <div class="buttons-wrap">
                <a href="">подписаться</a>

            </div>
            <div class="hot-tag">
                <a href="">Криптовалюты  </a>
                <a href="">Дональд Трамп</a>
                <a href="">ОПЕК</a>
                <a href="">Китай Tesla </a>
            </div>
        </div>
        <div class="news__wrap">
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class=" news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <a href="" class="category">
                        <span class="category-star"></span>
                        ГОРЯЧЕЕ
                    </a>
                    <h2><a href="">Прокомментировали информацию о планах Трампа снять санкции с России</a></h2>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <!-- item -->
            <div class=" news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <a href="" class="category">
                        <span class="category-star"></span>
                        ГОРЯЧЕЕ
                    </a>
                    <h2><a href="">Прокомментировали информацию о планах Трампа снять санкции с России</a></h2>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class=" news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <a href="" class="category">
                        <span class="category-star"></span>
                        ГОРЯЧЕЕ
                    </a>
                    <h2><a href="">Прокомментировали информацию о планах Трампа снять санкции с России</a></h2>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-lg">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/pic-2.png" alt="">
                    <div class="content-row">
                        <span>20 января</span>
                        <a href="">Новости</a>
                        <span><small class="view-icon"></small> 2589</span>
                        <h2><a href="#">День, когда президентом стал Дональд Трамп</a></h2>
                    </div>

                </div>
                <!-- thumb -->
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class=" news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <a href="" class="category">
                        <span class="category-star"></span>
                        ГОРЯЧЕЕ
                    </a>
                    <h2><a href="">Прокомментировали информацию о планах Трампа снять санкции с России</a></h2>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <!-- item -->
            <div class=" news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <a href="" class="category">
                        <span class="category-star"></span>
                        ГОРЯЧЕЕ
                    </a>
                    <h2><a href="">Прокомментировали информацию о планах Трампа снять санкции с России</a></h2>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->

            <!-- item -->
            <div class="news__wrap_item-lg">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/pic-2.png" alt="">
                    <div class="content-row">
                        <span>20 января</span>
                        <a href="">Новости</a>
                        <span><small class="view-icon"></small> 2589</span>
                        <h2><a href="#">День, когда президентом стал Дональд Трамп</a></h2>
                    </div>

                </div>
                <!-- thumb -->
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-sm">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                    <div class="content-row">
                        <span><small class="view-icon"></small> 2589</span>
                        <a href="">Новости</a>
                    </div>
                </div>
                <!-- thumb -->
                <div class="content-item">
                    <p><a href="">Что происходит на рынках прямо сейчас</a></p>
                    <span>20 января</span>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="news__wrap_item-lg">
                <!-- thumb -->
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/pic-2.png" alt="">
                    <div class="content-row">
                        <span>20 января</span>
                        <a href="">Новости</a>
                        <span><small class="view-icon"></small> 2589</span>
                        <h2><a href="">День, когда президентом стал Дональд Трамп</a></h2>
                    </div>

                </div>
                <!-- thumb -->
            </div>
            <!-- item -->
            <div class="home-content__wrap_subscribe">
                <div class="subscribe__wrap">
                    <h3>ПОДПИСАТЬСЯ НА НОВОСТИ</h3>
                    <form action="">
                        <input type="text" placeholder="Выслать на email">
                        <button>подписаться</button>
                    </form>
                    <div class="social-wrap">
                        <h4>мы в социальных сетях</h4>
                        <a href="" class="social-wrap__item vk">
                            <img src="theme/portal-donbassa/img/soc/vk.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item fb">
                            <img src="theme/portal-donbassa/img/soc/fb.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item ok">
                            <img src="theme/portal-donbassa/img/soc/ok-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item insta">
                            <img src="theme/portal-donbassa/img/soc/insta-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item twitter">
                            <img src="theme/portal-donbassa/img/soc/twi-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item google">
                            <img src="theme/portal-donbassa/img/soc/google-icon.png" alt="">
                        </a>
                        <a href="" class="social-wrap__item pinterest">
                            <img src="theme/portal-donbassa/img/soc/pinter-icon.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="news__wrap_buttons">
            <a href=""><span class="rotate-arrow"></span>рубрикатор</a>
            <a href="" class="show-more">загрузить БОЛЬШЕ</a>
            <span href="#" class="archive-news datepicker-here datepicker-wrap" >архив новостей</span>
        </div>
    </div>
</section>

<section class="what-say">
    <div class="container">
        <h2>О чем говорят в городе</h2>
        <div class="what-say__servises">
            <!-- <a href=""><span class="comments-icon"></span>Задать свой вопрос</a> -->
            <a href=""><span class="mail-icon"></span>Подписаться на эту тему</a>
        </div>
        <div class="what-say__wrap">
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a href="" class="what-say__wrap_item">
                <span class="counter">99</span>
                <div class="thumb">
                    <img src="theme/portal-donbassa/img/home-content/what-say-1.png" alt="">
                </div>
                <div class="wrapi">
                    <span class="name">Кирилл Кириленко</span>
                    <p>О сколько нам открытий чудных?</p>
                </div>
            </a>
            <!-- item -->
        </div>
    </div>
</section>

<section class="rubrick-slider">
    <div class="container">
        <div class="rubrick-slider__wrap">
            <!-- item -->
            <div class="rubrick-slider__item">
                <div class="rubrick-slider__title">
                    <h2>Политика</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus laudantium aperiam amet maxime, at! Soluta enim magnam voluptas deserunt, nihil.</p>
                </div>
                <div class="rubrick-slider__item_wrap">
                    <div class="item__big">
                        <img src="theme/portal-donbassa/img/home-content/big-pic.png" alt="">
                        <div class="item__big_content">
                            <h4><a href="">Первый испытательный полет МС-21 пройдет в начале весны</a></h4>
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- item -->
            <!-- item -->
            <div class="rubrick-slider__item">
                <div class="rubrick-slider__title">
                    <h2>Объявления</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minus laudantium aperiam amet maxime, at! Soluta enim magnam voluptas deserunt, nihil.</p>
                </div>
                <div class="rubrick-slider__item_wrap">
                    <div class="item__big">
                        <img src="theme/portal-donbassa/img/home-content/big-pic.png" alt="">
                        <div class="item__big_content">
                            <h4><a href="">Первый испытательный полет МС-21 пройдет в начале весны</a></h4>
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                    <div class="item__small">
                        <img src="theme/portal-donbassa/img/home-content/small-pic.png" alt="">
                        <div class="item__small_content">
                            <span class="hour-ago">7 часов назад</span>
                            <div class="item__content_panel">
                                <a href=""><span class="comments-icon"></span>31</a>
                                <span><small class="view-icon"></small> 2589</span>
                            </div>
                            <h4><a href="">Куда пойти на День Святого Патрика?</a></h4>
                        </div>
                    </div>
                </div>          <div class="item__big">
                    <img src="theme/portal-donbassa/img/home-content/big-pic.png" alt="">
                    <div class="item__big_content">
                        <h4></h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- item -->
    </div>

    </div>
</section>


