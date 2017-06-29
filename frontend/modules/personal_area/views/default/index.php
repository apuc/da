<?php
$this->title = "Личный кабинет";
?>

<?= $this->render('_user-news', ['userNews' => $userNews]); ?>

<?= \frontend\modules\personal_area\widgets\ShowVisitsUser::widget(); ?>

<div class="cabinet__inner-box">

                <h3>Мои компании</h3>

                <a href="#" class="cabinet__inner-box--add">добавить <span><img src="img/icons/add-pkg-icon.png" alt=""></span></a>

                <div href="#" class="business__sm-item">

                    <div class="recommend">
                        <span class="recommend__star"></span>
                        Рекомендуем
                    </div>

                    <div class="business__sm-item--img">
                        <img src="img/business/business-sm.png" alt="">
                    </div>

                    <p class="business__sm-item--title">Региональный центр восстановления позвоночника и
                        реабилитации</p>

                    <p class="business__sm-item--address">
                        <span>Адрес:</span>
                        <span>г. Донецк, проспект Мира, 8а</span>
                    </p>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views">569</p>

                    <div class="cabinet__inner-box--toolth">

                        <a href="">
                            <img src="img/icons/cabinetd-delete-icon.png" alt="">
                        </a>
                        <a href="">
                            <img src="img/icons/cabinet-edit-icon.png" alt="">
                        </a>
                        <a href="">
                            <img src="img/icons/cabinet-show-icon.png" alt="">
                        </a>

                    </div>

                </div>

                <a href="#" class="business__big-item">

                    <div class="recommend">
                        <span class="recommend__star"></span>
                        Рекомендуем
                    </div>

                    <div class="business__sm-item--img">
                        <img src="img/business/business-sm.png" alt="">
                    </div>

                    <p class="business__sm-item--title">Региональный центр восстановления позвоночника и
                        реабилитации</p>

                    <!--<p class="business__big-item&#45;&#45;address">
                        <span>Время работы Министерства:</span>
                        <span>с 9:00 до 18:00 (перерыв с 13:00 до 14:00)</span>
                    </p>-->

                    <p class="business__sm-item--address">
                        <span>Адрес:</span>
                        <span>г. Донецк, проспект Мира, 8а</span>
                    </p>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views">569</p>

                </a>

                <a href="#" class="business__sm-item">

                    <div class="recommend">
                        <span class="recommend__star"></span>
                        Рекомендуем
                    </div>

                    <div class="business__sm-item--img">
                        <img src="img/business/business-sm.png" alt="">
                    </div>

                    <p class="business__sm-item--title">Региональный центр восстановления позвоночника и
                        реабилитации</p>

                    <p class="business__sm-item--address">
                        <span>Адрес:</span>
                        <span>г. Донецк, проспект Мира, 8а</span>
                    </p>

                    <ul class="business__sm-item--numbers">
                        <li>+380667778540</li>
                        <li>+380667778540</li>
                    </ul>

                    <!--<span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views">569</p>

                </a>

            </div>




