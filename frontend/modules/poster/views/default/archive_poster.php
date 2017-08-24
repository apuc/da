<?php

use common\classes\WordFunctions;
use common\classes\DateFunctions;
use yii\helpers\Url;

$this->title = 'Архив афиш за '.$date;
$date = strtotime($date);
?>
<section class="afisha-events">
    <div class="container">

        <div class="events-day">
            <h3><?= $this->title; ?></h3>
            <div class="events-day__wrap">

                <?php if($model):?>
                <?php foreach ($model as $poster): ?>
                    <a href="<?= Url::to(['/poster/default/view', 'slug'=>$poster->slug]) ?>" class="item">
                        <div class="thumb">
                            <img src="<?= $poster->photo ?>" alt="">
                        </div>
                        <div class="contents">
                                <span class="type">
                                    <?= isset($poster->categories[0]) ? $poster->categories[0]->title : '' ?>
                                </span>
                            <h3 style="padding-left: 0">
                                <?= WordFunctions::crop_str_word($poster->title, 6)  ?>
                            </h3>
                            <span class="date">
                                    <?php
                                    if(date('d-m',$poster->dt_event) == date('d-m',$poster->dt_event_end)):
                                        ?>
                                        <?= date('d',$poster->dt_event) . ' '.DateFunctions::getMonthName(date('m',$poster->dt_event))?>
                                        <?php
                                    else:
                                        ?>
                                        <?= date('d',$poster->dt_event) . ' '.DateFunctions::getMonthName(date('m',$poster->dt_event))?> -
                                        <?= date('d',$poster->dt_event_end) . ' '.DateFunctions::getMonthName(date('m',$poster->dt_event_end))?>
                                        <?php
                                    endif;
                                    ?>

                                </span>
                            <span class="place"><?= $poster->address ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>

                <?php elseif($date > time()):?>
                   <?= $this->render('archive_poster_null_future')?>
                <?php else:?>
                   <?= $this->render('archive_poster_null_past')?>
                <?php endif;?>
                <div class="news__wrap_buttons">
                    <span id="poster_archive" href="#" class="archive-news datepicker-here datepicker-wrap" >архив афиш <span class="rotate-arrow"></span></span>
                </div>
            </div>
        </div>

        <?= \frontend\modules\poster\widgets\InterestedIn::widget() ?>
    </div>

</section>
