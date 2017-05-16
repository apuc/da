<?php
; ?>

<div class="home-content__sidebar_consultation">
    <h3>КОНСУЛЬТАЦИИ</h3>
    <a href="#" class="ask">
        <span class="ask-icon"></span>
        <span class="ask-title">Задать вопрос</span>
    </a>
    <?php foreach ($faq as $item): ?>
        <a href="<?= \yii\helpers\Url::to(['/consulting/consulting/faq-post','slug'=>$item->slug]);?>" class="consultation__item">
            <div class="thumb">
                <!--<span>A</span>-->
                <span><?= substr($item->company->user->username, 0, 1); ?></span>
            </div>
            <p><?= $item->question; ?></p>
        </a>
    <?php endforeach; ?>
    <a href="<?= \yii\helpers\Url::togit (['/consulting/consulting']); ?>" class="show-more">посмотреть больше<span
                class="red-arrow"></span></a>
</div>

<!---->
<!--<div class="home-content__sidebar_consultation">-->
<!---->
<!--    <h3>КОНСУЛЬТАЦИИ</h3>-->
<!--    <!-- <span class="consultation-title"></span> -->
<!--    <a href="#" class="ask">-->
<!--        <span class="ask-icon"></span>-->
<!--        <span class="ask-title">Задать вопрос</span>-->
<!--    </a>-->
<!---->
<!--    <a href="" class="consultation__item">-->
<!--        <div class="thumb">-->
<!--            <span>A</span>-->
<!--        </div>-->
<!--        <!-- <span class="category">право</span>-->
<!--        <p> Как быстро сделать документы без выезда ДНР? </p>-->
<!--    </a>-->
<!---->
<!--    <a href="" class="consultation__item">-->
<!--        <div class="thumb">-->
<!--            <span>A</span>-->
<!--        </div>-->
<!--        <!-- <span class="category">право</span>-->
<!--        <p> Как быстро сделать документы без выезда ДНР? </p>-->
<!--    </a>-->
<!---->
<!--    <a href="" class="consultation__item">-->
<!--        <div class="thumb">-->
<!--            <span>A</span>-->
<!--        </div>-->
<!--        <!-- <span class="category">право</span>-->
<!--        <p> Как быстро сделать документы без выезда ДНР? </p>-->
<!--    </a>-->
<!---->
<!--    <a href="" class="consultation__item">-->
<!--        <div class="thumb">-->
<!--            <span>A</span>-->
<!--        </div>-->
<!--        <!-- <span class="category">право</span>-->
<!--        <p> Как быстро сделать документы без выезда ДНР? </p>-->
<!--    </a>-->
<!---->
<!--    <a href="" class="show-more">посмотреть больше<span class="red-arrow"></span></a>-->
<!---->
<!--</div>-->
<!---->
<!--<div class="home-content__sidebar_consultation">-->
<!--    <h3>КОНСУЛЬТАЦИИ</h3>-->
<!--    <a href="#" class="ask">-->
<!--        <span class="ask-icon"></span>-->
<!--        <span class="ask-title">Задать вопрос</span>-->
<!--    </a>-->
<!--    --><?php //foreach ($faq as $item): ?>
<!--        <a href="" class="consultation__item">-->
<!--            <div class="thumb">-->
<!--                <!--<img src="--><? ////= $item->company->photo; ?><!--<!--" alt="">-->
<!--                <img src="/theme/portal-donbassa/img/users-avatars/no-avatar.png" alt="">-->
<!--            </div>-->
<!--            <span class="category">--><? //= $item->category->title;?><!--</span>-->
<!--            <p>--><? //= $item->question; ?><!--</p>-->
<!--        </a>-->
<!---->
<!--    --><?php //endforeach; ?>
<!--    <a href="--><? //= \yii\helpers\Url::to(['/consulting/consulting']);?><!--" class="show-more">посмотреть больше<span class="red-arrow"></span></a>-->
<!--</div>-->