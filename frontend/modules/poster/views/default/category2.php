<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 13.10.2016
 * Time: 11:31
 * @var $category \common\models\db\CategoryPoster
 * @var $dataProvider \yii\data\SqlDataProvider
 * @var $meta_title \backend\modules\key_value\Key_value
 * @var $meta_descr \backend\modules\key_value\Key_value
 */
use yii\helpers\Url;
$this->title = $meta_title;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta_descr,
] );
?>

<?= \frontend\modules\poster\widgets\Banner::widget(); ?>

<?= \frontend\modules\poster\widgets\Categories::widget(); ?>

<?= \frontend\modules\poster\widgets\TopSlider::widget(); ?>

<section class="afisha-events">
    <div class="container">
        <div class="events-day">
            <h3>События в ближайшие дни</h3>
            <div class="calendar-wrap">
                <ul>
                    <li class="weekend">
                        <b>сб</b>
                        <span>04</span>
                    </li>
                    <li class="weekend">
                        <b>вс</b>
                        <span>05</span>
                    </li>
                    <li>
                        <b>пн</b>
                        <span>06</span>
                    </li>
                    <li>
                        <b>вт</b>
                        <span>07</span>
                    </li>
                    <li>
                        <b>ср</b>
                        <span>08</span>
                    </li>
                    <li>
                        <b>чт</b>
                        <span>09</span>
                    </li>
                    <li>
                        <b>пт</b>
                        <span>10</span>
                    </li>
                    <li class="datepicker-here datepicker-wrap">
                        <span class="dot"></span>
                        <span class="dot"></span>
                        <span class="dot"></span>
                    </li>
                </ul>
            </div>
            <div class="events-day__wrap">
                <a href="" class="item">
                    <div class="thumb">
                        <img src="theme/portal-donbassa/img/home-content/pic2.png" alt="">
                    </div>
                    <div class="contents">
                        <span class="type">Концерт</span>
                        <h3>ДДТ</h3>
                        <span class="date">5 марта, 19:00</span>
                        <span class="place">Олимпийский</span>
                        <!-- <div class="social-wrap">
                          <a class="social-wrap__item vk">
                            <img src="theme/portal-donbassa/img/soc/vk.png" alt="">
                          </a>
                          <a class="social-wrap__item fb">
                            <img src="theme/portal-donbassa/img/soc/fb.png" alt="">
                          </a>
                          <a class="social-wrap__item ok">
                            <img src="theme/portal-donbassa/img/soc/ok-icon.png" alt="">
                          </a>
                          <a class="social-wrap__item insta">
                            <img src="theme/portal-donbassa/img/soc/insta-icon.png" alt="">
                          </a>
                          <a class="social-wrap__item twitter">
                            <img src="theme/portal-donbassa/img/soc/twi-icon.png" alt="">
                          </a>
                          <a class="social-wrap__item google">
                            <img src="theme/portal-donbassa/img/soc/google-icon.png" alt="">
                          </a>
                          <a class="social-wrap__item pinterest">
                            <img src="theme/portal-donbassa/img/soc/pinter-icon.png" alt="">
                          </a>
                        </div> -->
                    </div>
                </a>
                <a href="" class="item">
                    <div class="thumb">
                        <img src="theme/portal-donbassa/img/home-content/pic2.png" alt="">
                    </div>
                    <div class="contents">
                        <span class="type">Концерт</span>
                        <h3>ДДТ</h3>
                        <span class="date">5 марта, 19:00</span>
                        <span class="place">Олимпийский</span>
                    </div>
                </a>
                <a href="" class="item">
                    <div class="thumb">
                        <img src="theme/portal-donbassa/img/home-content/pic2.png" alt="">
                    </div>
                    <div class="contents">
                        <span class="type">Концерт</span>
                        <h3>ДДТ</h3>
                        <span class="date">5 марта, 19:00</span>
                        <span class="place">Олимпийский</span>
                    </div>
                </a>
                <a href="" class="item">
                    <div class="thumb">
                        <img src="theme/portal-donbassa/img/home-content/pic2.png" alt="">
                    </div>
                    <div class="contents">
                        <span class="type">Концерт</span>
                        <h3>ДДТ</h3>
                        <span class="date">5 марта, 19:00</span>
                        <span class="place">Олимпийский</span>
                    </div>
                </a>
                <a href="" class="show-more">загрузить БОЛЬШЕ</a>
            </div>
        </div>
        <div class="what-to-see">
            <h3>Что посмотреть</h3>
            <div class="afisha-events__wrap">
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
            </div>
            <a href="" class="show-more">загрузить БОЛЬШЕ</a>
        </div>
        <div class="where-to-go">
            <h3>Куда сходить</h3>
            <div class="afisha-events__wrap">
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
                <a href="" class="item">
                    <img src="theme/portal-donbassa/img/home-content/afisha-pic.png" alt="">
                    <div class="item-content">
                        <span class="type">Концерт / Рок</span>
                        <span class="name-item">Закон ночи</span>
                        <span class="time">"28 января 09:00"</span>
                    </div>
                </a>
            </div>
            <a href="" class="show-more">загрузить БОЛЬШЕ</a>
        </div>
        <?= \frontend\modules\poster\widgets\InterestedIn::widget() ?>
    </div>
</section>
