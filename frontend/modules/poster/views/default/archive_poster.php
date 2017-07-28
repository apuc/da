<?php

use common\classes\WordFunctions;
use common\classes\DateFunctions;
use yii\helpers\Url;

$this->title = 'Архив афиш за '.$date;
?>
<section class="afisha-events">
    <div class="container">

        <div class="events-day">
            <div class="events-day__wrap">

                <?if($model):?>
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


                                <?/*= WordFunctions::dateWithMonts($poster->dt_event) */?><!--, --><?/*= $poster->start; */?>
                                </span>
                            <span class="place"><?= $poster->address ?></span>
                        </div>
                    </a>
                <?php endforeach; ?>

                <?else:?>
                    <h3>В этот день событий не было</h3>
                <?endif;?>
                <div class="news__wrap_buttons">
                    <span id="poster_archive" href="#" class="archive-news datepicker-here datepicker-wrap" >архив афиш <span class="rotate-arrow"></span></span>
                </div>
            </div>
        </div>


    </div>
</section>