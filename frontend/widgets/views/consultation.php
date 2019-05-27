<?php
use yii\helpers\Url;
 ?>

<div class="home-content__sidebar_consultation">

    <h3><a href="/consulting">КОНСУЛЬТАЦИИ</a></h3>
    <!-- <span class="consultation-title"></span> -->
    <a href="#" class="ask">
        <span class="ask-icon"></span>
        <span class="ask-title">Задать вопрос</span>
    </a>


    <?php

    foreach ($faq as $item):
       /* \common\classes\Debug::prn($item['consulting']);*/
        //\common\classes\Debug::prn($item['faq']);
        ?>
        <h4><?= $item->title; ?></h4>
        <?php foreach ($item['faq'] as $val): ?>
        <?php /*\common\classes\Debug::prn($val);*/?>
            <a href="<?= \yii\helpers\Url::to(['/consulting/consulting/faq-post', 'slug' => $val->slug]); ?>" class="consultation__item">

                <div class="thumb">
                    <img src="<?= $item['consulting']->photo . '?width=50' ?>" alt="">
                </div>

                <p><?= $val->question; ?></p>

                <div class="consultation__item--company">

                    <span class="consultation__item--company-icon"></span>

                    <p><?= \common\models\db\Faq::getCompanyName($val->company_id);?></p>

                </div>

            </a>

        <?php endforeach;?>

    <?php endforeach; ?>

    <a href="<?= Url::to(['/consulting/consulting']); ?>" class="show-more">посмотреть больше<span class="red-arrow"></span></a>

</div>