<?php
?>


<div class="cabinet__owner-tools">
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-likes/index'])?>">
        <span><?= $likes; ?></span>
        <p>лайков</p>
    </a>
    <a href="#">
        <span>0</span>
        <p>акций</p>
    </a>
    <a href="#">
        <span>0</span>
        <p>Афиш</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-company/index'])?>">
        <span><?= $company; ?></span>
        <p>компаний</p>
    </a>
    <a href="#">
        <span>0</span>
        <p>отзывов</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-comments'])?>">
        <span><?= $comments?></span>
        <p>коментария</p>
    </a>
</div>
