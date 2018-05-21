<?php
use common\classes\WordFunctions;
use common\models\db\VkStream;

//\common\classes\Debug::dd($model);
?>



<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['product']->slug])?>" class="cabinet__like-block--section">
    <?= $model['product']->title; ?>
</a>

<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['product']->slug])?>" class="cabinet__like-block--photo">
    <?php
    if (!empty($model['product']->cover)): ?>
        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['product']['cover']); ?>"
             alt="<?= $model['product']['title']; ?>">
    <?php else: ?>

        <?php if (!empty($model['product']['images'][0]->img_thumb)): ?>
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage('/' . $model['product']['images'][0]->img_thumb); ?>">
        <?php else: ?>
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['product']['cover']); ?>"
                 alt="<?= $model['product']['title']; ?>">
        <?php endif; ?>
    <?php endif; ?>
</a>

<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['product']->slug])?>" class="cabinet__like-block--descr">
    <?= $model['product']->title; ?></a>


<!--<a href="#" class="like active">
    <i class="like-set-icon"></i>
    <span class="like-counter">22</span>
</a>-->

