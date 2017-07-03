<?php
use common\classes\WordFunctions;

if($model['post_type'] == 'news') {
    $post = \common\models\db\News::find()->where(['id' => $model['post_id']])->one();
    $url = \yii\helpers\Url::to(['/news/default/view', 'slug' => $post->slug]);
    $name = 'Новости';
    $time = WordFunctions::FullEventDate($post->dt_public);
}

if($model['post_type'] == 'poster') {
    $post = \common\models\db\Poster::find()->where(['id' => $model['post_id']])->one();
    $url = \yii\helpers\Url::to(['/poster/default/view', 'slug' => $post->slug]);
    $name = 'Афиша';
}


?>


<a href="<?= $url?>" class="cabinet__like-block--section"><?= $name; ?></a>

<a href="<?= $url?>" class="cabinet__like-block--photo">
    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($post->photo); ?>" alt="">
</a>

<a href="<?= $url?>" class="cabinet__like-block--descr"><?= $post->title; ?></a>


<a href="#" class="like likes active"
   csrf-token="<?= Yii::$app->request->getCsrfToken() ?>"
   data-id="<?= $post->id; ?>"
   data-type="news">
    <i class="like-set-icon"></i>
    <span class="like-counter"><?= \common\models\db\Likes::find()->where(['post_type' => $model['post_type'], 'post_id' => $post->id])->count(); ?></span>
</a>

<!--<a href="#" class="like active">
    <i class="like-set-icon"></i>
    <span class="like-counter">22</span>
</a>-->

<?php if($model['post_type'] == 'news'): ?>
    <span class="data-time"><?= $time;  ?></span>
<?php endif; ?>