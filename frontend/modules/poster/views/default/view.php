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

$this->title = $poster->title;
?>

<?= \frontend\modules\poster\widgets\Banner::widget(); ?>

<?= \frontend\modules\poster\widgets\Categories::widget(); ?>

<section class="single-afisha">
    <div class="container">
        <p class="age"><?= $category->title; ?></p>
        <h1 class="map-placemarks-title"><?= $model->title; ?></h1>

        <div class="afisha-content-wrapper">

            <div class="thumbnail-afisha">
                <img src="<?= $model->photo; ?>" alt="">
            </div>

            <div class="afisha-content">
                <div class="date-time"><?= WordFunctions::FullEventDate($model->dt_event); ?></div>
                <?= $model->descr; ?>
            </div>
        </div>

        <div class="maps tabs">


            <div class="map-wrapper tabs__content active">
                <div class="maps-info">
                    <div class="date">
                        <div class="day"><?= date('d', $model->dt_event); ?></div>
                        <div class="weekday">
                            <span><?= WordFunctions::getRuWeek()[date('N', $model->dt_event)]; ?></span>
                            <span><?= WordFunctions::getRuMonth()[date('m', $model->dt_event)]; ?></span>
                        </div>
                    </div>
                    <div class="adress">
                        Адрес: <span class="concreate-adress">
                            <?= $model->address; ?>
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

        <?= \frontend\modules\poster\widgets\Popular::widget();?>

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
</section>
