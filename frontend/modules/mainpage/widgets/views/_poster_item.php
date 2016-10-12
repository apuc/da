<?php
use common\classes\DateFunctions;
?>

<a href="<?= \yii\helpers\Url::to(['/poster/default/view', 'slug'=>$model['slug']]) ?>" class="afisha__right_item">
    <span class="afisha-date-small"><b><?= date('d', $model['dt_add']) ?></b> <?= DateFunctions::getMonthShortName(date('m', $model['dt_add'])) ?></span>
    <img src="<?= $model['photo'] ?>" alt="">
    <p><?= $model['title'] ?></p>
</a>