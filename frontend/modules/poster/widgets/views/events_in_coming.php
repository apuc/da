<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 13:04
 * @var $posters \common\models\db\Poster
 * @var $slug string
 */
use common\classes\WordFunctions;
use yii\helpers\Url;

?>
<div class="events-day">
    <h3><?= !empty($slug) ? \common\models\db\CategoryPoster::findOne(['slug'=>$slug])->title : 'События в ближайшие дни'?></h3>
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
        <?php foreach ($posters as $poster): ?>
            <a href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>" class="item">
                <div class="thumb">
                    <img src="<?= $poster->photo ?>" alt="">
                </div>
                <div class="contents">
                    <span class="type"><?= $poster->categories[0]->title ?></span>
                    <h3 style="padding-left: 0"><?= WordFunctions::crop_str_word($poster->title, 6)  ?></h3>
                    <span class="date">
                        <?= WordFunctions::dateWithMonts($poster->dt_event) ?>, <?= date('H:i',$poster->dt_event) ?>
                    </span>
                    <span class="place"><?= $poster->address ?></span>
                </div>
            </a>
        <?php endforeach; ?>
        <span id="more-poster-box"></span>
        <a href="" id="load-more-posters" data-step="2" class="show-more">загрузить БОЛЬШЕ</a>
    </div>
</div>
