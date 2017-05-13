<?php
; ?>

<div class="home-content__sidebar_consultation">
    <h3>КОНСУЛЬТАЦИИ</h3>
    <!-- <span class="consultation-title"></span> -->
    <a href="" class="ask"><span class="ask-icon"></span> Задать вопрос</a>
    <?php foreach ($faq as $item): ?>
        <a href="" class="consultation__item">
            <div class="thumb">
                <!--<img src="--><?//= $item->company->photo; ?><!--" alt="">-->
                <img src="/theme/portal-donbassa/img/users-avatars/no-avatar.png" alt="">
            </div>
            <span class="category"><?= $item->category->title;?></span>
            <p><?= $item->question; ?></p>
        </a>
    <?php endforeach; ?>
    <a href="<?= \yii\helpers\Url::to(['/consulting/consulting']);?>" class="show-more">посмотреть больше<span class="red-arrow"></span></a>
</div>