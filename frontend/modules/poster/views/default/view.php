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

$this->title = $model->title;


$this->registerMetaTag([
    'name' => 'og:image',
    'content' => 'http://' . $_SERVER['HTTP_HOST'] . $model->photo,
]);
$this->title = $model->meta_title;

$this->registerMetaTag([
    'name' => 'og:title',
    'content' => $model->meta_title,
]);
$this->registerMetaTag([
    'name' => 'og:description',
    'content' => $model->meta_descr,
]);

$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
]);




/*$this->registerJsFile('/theme/portal-donbassa/js/countdown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);*/
/*$this->registerJsFile('/theme/portal-donbassa/js/afisha-countdown.js', ['depends' => [\yii\web\JqueryAsset::className()]]);*/
$this->registerJsFile('/js/poster.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

/*\common\classes\Debug::prn());*/
?>

<?= \frontend\modules\poster\widgets\Banner::widget(); ?>

<?= \frontend\modules\poster\widgets\Categories::widget(); ?>


<!--<section class="single-afisha">
    <div class="container">
        <p class="age"><?/*= $category->title; */?></p>
        <h1 class="map-placemarks-title"><?/*= $model->title; */?></h1>

        <div class="afisha-content-wrapper">

            <div class="thumbnail-afisha">
                <img src="<?/*= $model->photo; */?>" alt="">
            </div>

            <div class="afisha-content">
                <div class="date-time"><?/*= WordFunctions::FullEventDate($model->dt_event); */?></div>
                <?/*= $model->descr; */?>
            </div>
        </div>

        <div class="maps tabs">


            <div class="map-wrapper tabs__content active">
                <div class="maps-info">
                    <div class="date">
                        <div class="day"><?/*= date('d', $model->dt_event); */?></div>
                        <div class="weekday">
                            <span><?/*= WordFunctions::getRuWeek()[date('N', $model->dt_event)]; */?></span>
                            <span><?/*= WordFunctions::getRuMonth()[date('m', $model->dt_event)]; */?></span>
                        </div>
                    </div>
                    <div class="adress">
                        Адрес: <span class="concreate-adress">
                            <?/*= $model->address; */?>
                        </span>
                    </div>
                </div>
                <div class="map">
                    <h3>Адрес</h3>

                    <div id="map" class="ymaps"></div>
                </div>
            </div>

            <div class="map-wrapper tabs__content">
                <div class="maps-info">
                    <div class="date">
                        <div class="day">21</div>
                        <div class="weekday">
                            <span>понедельник</span>
                            <span>ноября</span>
                        </div>
                    </div>
                    <div class="adress">
                        Адрес: г. Донецк,
                        ул. Фомина, 9
                    </div>
                </div>
                <div class="map">
                    <h3>Адресс</h3>

                    <div id="map_2" class="ymaps"></div>
                </div>
            </div>

            <div class="map-wrapper tabs__content">
                <div class="maps-info">
                    <div class="date">
                        <div class="day">01</div>
                        <div class="weekday">
                            <span>Четверг</span>
                            <span>Апреля</span>
                        </div>
                    </div>
                    <div class="adress">
                        Адрес: г. Донецк,
                        ул. Жили-были, 75
                    </div>
                </div>
                <div class="map">
                    <h3>Адресс</h3>

                    <div id="map_3" class="ymaps"></div>
                </div>
            </div>
        </div>

        <?/*= \frontend\modules\poster\widgets\Popular::widget();*/?>

        <div class="social-wrapper">
            <a href="#" target="_blank" class="social-wrap__item vk">
                <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
                <span>03</span>
            </a>
            <a href="#" target="_blank" class="social-wrap__item fb">
                <img src="/theme/portal-donbassa/img/soc/fb.png" alt="fb">
                <span>12</span>
            </a>
            <a href="#" target="_blank" class="social-wrap__item ok">
                <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="ok">
                <span>05</span>
            </a>
            <a href="#" target="_blank" class="social-wrap__item insta">
                <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="instagramm">
                <span>63</span>
            </a>
            <a href="#" target="_blank" class="social-wrap__item google">
                <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="google">
                <span>36</span>
            </a>
            <a href="#" target="_blank" class="social-wrap__item twitter">
                <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="twitter">
                <span>11</span>
            </a>
        </div>

    </div>
</section>-->

<section class="single-afisha">
    <div class="container">
        <h1 class="map-placemarks-title"><?= $model->title; ?></h1>
        <div class="single-afisha__timetable">

            <?php
            if(date('d-m',$model->dt_event) == date('d-m',$model->dt_event_end)):
                ?>
                <?= date('d',$model->dt_event) . ' '.DateFunctions::getMonthName(date('m',$model->dt_event))?>
                <?php
            else:
                ?>
                <?= date('d',$model->dt_event) . ' '.DateFunctions::getMonthName(date('m',$model->dt_event))?> -
                    <?= date('d',$model->dt_event_end) . ' '.DateFunctions::getMonthName(date('m',$model->dt_event_end))?>
                <?php
            endif;
            ?>


            <?/*= WordFunctions::FullEventDate($model->dt_event); */?>

        </div>
        <div class="single-afisha__countdown">
        <?php if($model->dt_event > time() ): ?>

            <p>До начала осталось</p>

            <div class="single-afisha__countdown-clock">

                <ul id="countdown" data-date="<?= date('d M Y H:i', $model->dt_event); ?>">
                    <li>
                        <p class="timeRefDays">дни</p>
                        <span class="days">00</span>
                    </li>
                    <li>
                        <p class="timeRefHours">часы</p>
                        <span class="hours">00</span>
                    </li>
                    <li>
                        <p class="timeRefMinutes">минуты</p>
                        <span class="minutes">00</span>
                    </li>
                    <li>
                        <p class="timeRefSeconds">секунды</p>
                        <span class="seconds">00</span>
                    </li>
                </ul>
            </div>
        <?php endif; ?>

        <?php if($model->dt_event < time() && $model->dt_event_end > time()): ?>
                <p>Мероприятие <span>уже началось</span><br>
                    посетите нас по адресу</p>

                <p class="single-afisha__rem-address"><?= $model->address; ?></p>
        <?php endif;?>

        <?php if($model->dt_event_end < time()):?>
            <p>Мероприятие <span>закончилось</span></p>
            <div class="single-afisha__countdown--socials">
                <p>следите за новыми мероприятиями у нас в соц.сетях</p>
                <div class="single-afisha__countdown--links">
                    <a href="https://vk.com/da_info_pro" target="_blank" class="social-wrap__item vk">
                        <img src="/theme/portal-donbassa/img/soc/vk.png" alt="">
                    </a>
                    <a href="https://www.facebook.com/da.info.pro/" target="_blank" class="social-wrap__item fb">
                        <img src="/theme/portal-donbassa/img/soc/fb.png" alt="">
                    </a>
                    <a href="https://ok.ru/da...infor" target="_blank" class="social-wrap__item ok">
                        <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="">
                    </a>
                    <a href="https://www.instagram.com/da.info.pro/" target="_blank" class="social-wrap__item insta">
                        <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="">
                    </a>
                    <a href="https://twitter.com/DA_info_pro" target="_blank" class="social-wrap__item twitter">
                        <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="">
                    </a>
                    <a href="https://plus.google.com/u/0/communities/115639152242515279745" target="_blank" class="social-wrap__item google">
                        <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="">
                    </a>
                    <a href="https://ru.pinterest.com/DA_Info_Pro/da-info-pro/" target="_blank" class="social-wrap__item pinterest">
                        <img src="/theme/portal-donbassa/img/soc/pinter-icon.png" alt="">
                    </a>
                    <a href="https://t.me/DAInfo" target="_blank" class="social-wrap__item telegram">
                        <img src="/theme/portal-donbassa/img/soc/telegram-f.png" alt="">
                    </a>
                    <a  href="http://da-info-pro.livejournal.com/" target="_blank" class="social-wrap__item live-journal">
                        <img src="/theme/portal-donbassa/img/soc/livejournal-f.png" alt="">
                    </a>
                    <a href="https://www.linkedin.com/in/da-info-pro/recent-activity/" target="_blank" class="social-wrap__item in">
                        <img src="/theme/portal-donbassa/img/soc/in-f.png" alt="">
                    </a>
                </div>
            </div>
        <?php endif;?>
            <p><?= $model->metka;?></p>
            <span class="single-afisha__countdown--views"><small class="view-icon"></small><?= $model->views; ?></span>



            <a href="#" class="like likes <?= (!empty($thisUserLike)) ? 'active' : ''?>"
               csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
               data-id="<?= $model->id; ?>"
               data-type="poster">
                <i class="like-set-icon"></i>
                <span class="like-counter"><?= $likes; ?></span>
            </a>
        </div>
        <div class="single-afisha__wrapper">
            <div class="afisha-content-wrapper">
                <div class="thumbnail-afisha">
                    <img src="<?= $model->photo; ?>" alt="">
                </div>
                <div class="afisha-content">
                    <!--<div class="date-time">4 мая 2016, в 15:00</div>-->
                    <?= $model->descr; ?>
                </div>
            </div>

            <div class="single-afisha__when">
                <div class="afisha-content-wrapper__separator"></div>
                <h3>Когда?</h3>
                <p>
                <?php
                    if(date('d-m',$model->dt_event) == date('d-m',$model->dt_event_end)):
                ?>
                        <span><?= date('d',$model->dt_event) . ' '.DateFunctions::getMonthName(date('m',$model->dt_event))?></span>
                <?php
                    else:
                ?>
                        <span><?= date('d',$model->dt_event) . ' '.DateFunctions::getMonthName(date('m',$model->dt_event))?> -
                            <?= date('d',$model->dt_event_end) . ' '.DateFunctions::getMonthName(date('m',$model->dt_event_end))?>
                        </span>
                <?php
                    endif;
                ?>
                    <?= $model->start; ?></p>
                <div class="afisha-content-wrapper__separator"></div>
            </div>

            <?php if(!empty($model->price)): ?>

                <div class="single-afisha__price">

                    <div class="afisha-content-wrapper__separator"></div>

                    <h3>Цена:</h3>

                    <p><span><?= $model->price; ?></span></p>
                    <div class="afisha-content-wrapper__separator"></div>
                </div>

            <?php endif; ?>


            <div class="single-afisha__place">
                <div class="map">
                    <div id="map" class="ymaps"></div>
                </div>

                <div class="single-afisha__place--requisites">

                    <h3>Место проведения</h3>


                    <?php if(!empty($model->phone)): ?>
                        <div class="single-afisha__place--phones">
                            <span class="single-afisha__place--phone"></span>
                            <?php
                            $phone = explode(' ', $model->phone);
                            ?>
                            <a href="#"><?= isset($phone[0]) ? $phone[0] : '' ?></a>
                            <a href="#"><?= isset($phone[1]) ? $phone[1] : '' ?></a>
                        </div>
                    <?php endif; ?>

                    <div class="single-afisha__place--address">
                        <span class="single-afisha__place--placeholder"></span>
                        <p class="concreate-adress"><?= $model->address; ?> </p>
                    </div>
                </div>
            </div>

            <!-- start socials.html-->
            <?= \frontend\widgets\Share::widget([
                'url' => \yii\helpers\Url::base(true) . '/poster/' . $model->slug,
                'title' => $model->title,
                'description' => $model->descr,
                'view' => 'share-news',
                'image' => $model->photo,
            ]); ?>
            <!-- end socials.html-->

        </div>



        <?= \frontend\modules\poster\widgets\Popular::widget();?>



    </div>

</section>