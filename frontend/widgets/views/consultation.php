<?php
 ?>

<!--<div class="home-content__sidebar_consultation">
    <h3>КОНСУЛЬТАЦИИ</h3>
    <a href="#" class="ask">
        <span class="ask-icon"></span>
        <span class="ask-title">Задать вопрос</span>
    </a>
    <?php /*foreach ($faq as $item):
        */?>
        <a href="<?/*= \yii\helpers\Url::to(['/consulting/consulting/faq-post', 'slug' => $item->slug]); */?>"
           class="consultation__item">
            <div class="thumb">
                <!--<span>A</span>
                <?php /*if (!empty($item->consulting->photo)): */?>
                    <img src="<?/*= $item->consulting->photo; */?>" alt="">
                <?php /*else: */?>
                    <span><?/*= substr($item->company->user->username, 0, 1); */?></span>
                <?php /*endif; */?>
            </div>
            <p><?/*= $item->question; */?></p>
        </a>
    <?php /*endforeach; */?>
    <a href="<?/*= \yii\helpers\Url::to(['/consulting/consulting']); */?>" class="show-more">посмотреть больше<span
                class="red-arrow"></span></a>
</div>-->



<div class="home-content__sidebar_consultation">

    <h3>КОНСУЛЬТАЦИИ</h3>
    <!-- <span class="consultation-title"></span> -->
    <a href="#" class="ask">
        <span class="ask-icon"></span>
        <span class="ask-title">Задать вопрос</span>
    </a>


    <?php foreach ($faq as $item):
       /* \common\classes\Debug::prn($item['consulting']);*/
        //\common\classes\Debug::prn($item['faq']);
        ?>
        <h4><?= $item->title; ?></h4>
        <?php foreach ($item['faq'] as $val): ?>
        <?php /*\common\classes\Debug::prn($val);*/?>
            <a href="<?= \yii\helpers\Url::to(['/consulting/consulting/faq-post', 'slug' => $val->slug]); ?>" class="consultation__item">

                <div class="thumb">
                    <img src="<?= $item['consulting']->photo; ?>" alt="">
                </div>

                <p><?= $val->question; ?></p>

                <div class="consultation__item--company">

                    <span class="consultation__item--company-icon"></span>

                    <p><?= \common\models\db\Faq::getCompanyName($val->company_id);?></p>

                </div>

            </a>

        <?php endforeach;?>

    <?php endforeach; ?>

<!--    <h4>ВОПРОСЫ ПО НАЛОГООБЛОЖЕНИЮ</h4>

    <a href="#" class="consultation__item">

        <div class="thumb">
            <span>A</span>
        </div>

        <p> Как быстро сделать документы без выезда ДНР? </p>

        <div class="consultation__item--company">

            <span class="consultation__item--company-icon"></span>

            <p>Консалтинговая компания
                «Налоги и финансы»</p>

        </div>

    </a>

    <a href="" class="consultation__item">

        <div class="thumb">
            <span>A</span>
        </div>

        <p> Как быстро сделать документы без выезда ДНР? </p>

        <div class="consultation__item--company">

            <span class="consultation__item--company-icon"></span>

            <p>Консалтинговая компания
                «Налоги и финансы»</p>

        </div>

    </a>

    <a href="" class="consultation__item">

        <div class="thumb">
            <span>A</span>
        </div>

        <p> Как быстро сделать документы без выезда ДНР? </p>

        <div class="consultation__item--company">

            <span class="consultation__item--company-icon"></span>

            <p>Консалтинговая компания
                «Налоги и финансы»</p>

        </div>

    </a>

    <h4>Вопросы по брокерской
        деятельности и
        таможенному оформлению</h4>

    <a href="" class="consultation__item">

        <div class="thumb">
            <span>A</span>
        </div>

        <p> Как быстро сделать документы без выезда ДНР? </p>

        <div class="consultation__item--company">

            <span class="consultation__item--company-icon"></span>

            <p>Консалтинговая компания
                «Налоги и финансы»</p>

        </div>

    </a>

    <a href="" class="show-more">посмотреть больше<span class="red-arrow"></span></a>-->

</div>