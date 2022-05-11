<?php

use backend\modules\news\models\ForcedView;

?>
<div class="content-info">
    <span class="author"><?= $model->author; ?></span>
    <span class="comments"><?= $countComments . ' ' . \common\classes\WordFunctions::getNumEnding($countComments,
            [
                'комментарий',
                'комментария',
                'комментариев',
            ]); ?>
                </span>
    <span class="views"><?= $model->views + ForcedView::getViews($model->id) ?> просмотров</span>
    <span class="data-time"><?= \common\classes\WordFunctions::FullEventDate($model->dt_public) ?></span>

    <a href="#" class="like likes <?= (!empty($thisUserLike)) ? 'active' : ''?>"
       csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
       data-id="<?= $model->id; ?>"
       data-type="news">
        <i class="like-set-icon"></i>
        <span class="like-counter"><?= $likes; ?></span>
    </a>
</div>