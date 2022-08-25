<?php

use backend\modules\news\models\ForcedView;

?>
<li>
            <span class="time">
            <?= date('d.m', $model['dt_public']) ?><br>
            <span><?= date('H:i', $model['dt_public']) ?></span>
        </span>
    <a href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $model['slug']]) ?>">

        <?= $model['title'] ?>
        <span class="views">
            <i class="views-ico fa fa-eye"></i>
            <?= $model['views'] + ForcedView::getViews($model['id']) ?>
        </span>
    </a>
</li>