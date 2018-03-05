<?php
use common\classes\WordFunctions;
use common\models\db\VkStream;

//\common\classes\Debug::dd($model);
?>



<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['product']->slug])?>" class="cabinet__like-block--section">
    <?= $model['product']->title; ?>
</a>

<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['product']->slug])?>" class="cabinet__like-block--photo">
    <img src="<?= $model['product']->cover; ?>" alt="">
</a>

<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['product']->slug])?>" class="cabinet__like-block--descr">
    <?= $model['product']->title; ?></a>


<!--<a href="#" class="like active">
    <i class="like-set-icon"></i>
    <span class="like-counter">22</span>
</a>-->

