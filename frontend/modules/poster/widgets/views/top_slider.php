<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 30.03.2017
 * Time: 16:09
 * @var $posters \common\models\db\Poster
 */
use common\classes\DateFunctions;

?>
<section class="afisha-top-slider">
    <div class="container">
        <div class="afisha-top-slider__wrap">
            <?php foreach ($posters as $poster): ?>
                <!-- item -->
                <a  href=""  class="afisha-top-slider__wrap_item">
                    <div class="thumb">
                        <img src="<?= $poster->photo ?>" alt="">
                    </div>
                    <div class="contents contents-grey">
                        <div class="contents-date">
                            <span class="number-day"><?= date('d', $poster->dt_event) ?></span>
                            <span class="mounth"><?= DateFunctions::getMonthShortName(date('m', $poster->dt_event)) ?></span>
                        </div>
                        <!--<p><?/*= $poster->title */?></p>-->
                        <span class="place"><?= $poster->title ?></span>
                    </div>
                </a>
                <!-- item -->
            <?php endforeach; ?>

            <!-- item -->
            <a  href="" class="afisha-top-slider__wrap_item">
                <div class="thumb">
                    <img src="img/home-content/afisha-slider-2.jpg" alt="">
                </div>
                <div class="contents contents-purple">
                    <div class="contents-date">
                        <span class="number-day">1</span>
                        <span class="mounth">фев</span>
                    </div>
                    <p>Новое выступлени</p>
                    <span class="place">Театр Оперы и балета</span>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a  href="" class="afisha-top-slider__wrap_item">
                <div class="thumb">
                    <img src="img/home-content/afisha-slider-3.jpg" alt="">
                </div>
                <div class="contents contents-maroon">
                    <div class="contents-date">
                        <span class="number-day">1</span>
                        <span class="mounth">фев</span>
                    </div>
                    <p>Новое выступлени</p>
                    <span class="place">Театр Оперы и балета</span>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a  href="" class="afisha-top-slider__wrap_item">
                <div class="thumb">
                    <img src="img/home-content/afisha-slider-4.jpg" alt="">
                </div>
                <div class="contents contents-grey">
                    <div class="contents-date ">
                        <span class="number-day">1</span>
                        <span class="mounth">фев</span>
                    </div>
                    <p>Новое выступлени</p>
                    <span class="place">Театр Оперы и балета</span>
                </div>
            </a>
            <!-- item -->
            <!-- item -->
            <a  href="" class="afisha-top-slider__wrap_item">
                <div class="thumb">
                    <img src="img/home-content/afisha-slider-5.png" alt="">
                </div>
                <div class="contents contents-maroon">
                    <div class="contents-date">
                        <span class="number-day">1</span>
                        <span class="mounth">фев</span>
                    </div>
                    <p>Новое выступлени</p>
                    <span class="place">Театр Оперы и балета</span>
                </div>
            </a>
            <!-- item -->

        </div>
    </div>
</section>
