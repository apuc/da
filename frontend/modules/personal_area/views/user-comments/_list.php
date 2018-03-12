<?php

use common\models\db\News;
use common\models\db\Pages;
use common\models\db\Stock;
use common\models\db\VkStream;
use yii\helpers\Url;

if ($model['post_type'] == 'news') {
    $post = News::find()->where(['id' => $model['post_id']])->one();
    $title = 'Новости';
    $url = Url::to(['/news/default/view', 'slug' => $post->slug]);
    $img = $post->photo;
}

if ($model['post_type'] == 'page') {
    $post = Pages::find()->where(['id' => $model['post_id']])->one();
    $title = 'Пост';
    $url = Url::to(['/page/default/view', 'slug' => $post->slug]);
    $img = $post->photo;
}

if ($model['post_type'] == 'promotions') {
    $post = Stock::find()->where(['id' => $model['post_id']])->one();
    $title = 'Акции';
    $url = Url::to(['/promotions/promotions/view', 'slug' => $post->slug]);
    $img = $post->photo;
}

if ($model['post_type'] == 'vk_post') {
    $post = VkStream::find()
        ->where(['id' => $model['post_id']])
        ->with('photo', 'comments', 'author', 'group')
        ->one();
    $title = 'VK';
    $url = Url::to(['/stream/default/view', 'slug' => $post->slug]);

    if (!empty($post->photo)):
        $img = $post->photo[0]->getLargePhoto();

    elseif (!empty($post->gif)):
        $img = $post->gif[0]->getLargePreview();
    endif;

}

?>


<div class="cabinet__like-block">

    <a href="<?= $url; ?>" class="cabinet__like-block--section"><?= $title; ?></a>

    <a href="<?= $url; ?>" class="cabinet__like-block--photo">
        <img src="<?= $img ?>" alt="">
    </a>

    <a href="<?= $url; ?>" class="cabinet__like-block--comment-descr"><?= $post->title; ?></a>

    <div class="cabinet__comment-block">

        <?php if ($model['published'] == 1): ?>
            <h3>Коментарий <span>опубликован</span></h3>
        <?php endif; ?>

        <?php if ($model['published'] == 0): ?>
            <h3>Коментарий <span>на модерации</span></h3>
        <?php endif; ?>


        <p><?= $model['content'] ?></p>

        <a href="<?= $url; ?>">читать далее</a>

    </div>

</div>
