<?php
if($model['post_type'] == 'news'){
    $post = \common\models\db\News::find()->where(['id' => $model['post_id']])->one();
    $title = 'Новости';
    $url = \yii\helpers\Url::to(['/news/default/view', 'slug' => $post->slug]);
}

if($model['post_type'] == 'page'){
    $post = \common\models\db\Pages::find()->where(['id' => $model['post_id']])->one();
    $title = 'Пост';
    $url = \yii\helpers\Url::to(['/page/default/view', 'slug' => $post->slug]);
}
?>


<div class="cabinet__like-block">

    <a href="<?= $url; ?>" class="cabinet__like-block--section"><?= $title; ?></a>

    <a href="<?= $url; ?>" class="cabinet__like-block--photo">
        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($post->photo); ?>" alt="">
    </a>

    <a href="<?= $url; ?>" class="cabinet__like-block--comment-descr"><?= $post->title; ?></a>

    <div class="cabinet__comment-block">

        <?php if($model['published'] == 1): ?>
            <h3>Коментарий <span>опубликован</span></h3>
        <?php endif; ?>

        <?php if($model['published'] == 0): ?>
            <h3>Коментарий <span>на модерации</span></h3>
        <?php endif; ?>
        <!--<span class="counter">89</span>

        <div class="cabinet__comment-block--answer"><span>+1</span>ответ</div>-->

        <p><?= $model['content']?></p>

        <a href="<?= $url; ?>">читать далее</a>

    </div>

</div>
