<?php
?>


<div class="cabinet__owner-tools">
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-likes/index'])?>">
        <span><?= $likes; ?></span>
        <p>лайков</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-promotions'])?>">
        <span><?= $promotions?></span>
        <p>акций</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-poster'])?>">
        <span><?= $poster; ?></span>
        <p>Афиш</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-company/index'])?>">
        <span><?= $company; ?></span>
        <p>компаний</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-desire/index'])?>">
    <span><?= $desireCount?></span>
        <p>Мои желания</p>
    </a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-comments'])?>">
        <span><?= $comments?></span>
        <p>коментария</p>
    </a>
</div>
