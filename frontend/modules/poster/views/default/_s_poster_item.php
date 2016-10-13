<?php
use common\classes\DateFunctions;
?>

<a href="<?= \yii\helpers\Url::to(['/poster/default/view', 'slug'=>$model['poster']['slug']]) ?>" class="afisha__right_item">
    <span class="afisha-date-small"><b><?= date('d', $model['poster']['dt_add']) ?></b> <?= DateFunctions::getMonthShortName(date('m', $model['poster']['dt_add'])) ?></span>
    <img src="<?= $model['poster']['photo'] ?>" alt="">
    <p><?= $model['poster']['title'] ?></p>
</a>