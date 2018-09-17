<div class="articles">
    <?php use yii\helpers\Url;

    foreach ($news as $new): ?>
        <a href="<?= Url::to(['/news/default/view','slug'=>$new->slug]);?>" class="article">
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($new->photo); ?>" alt="">


            <div class="content-row">
                <span><?= \frontend\widgets\MainSlider::getDateNew($new->dt_public); ?></span>
                <span><?= $new['categoryNewsRelations'][0]['cat']->title; ?></span>
                <span><small class="view-icon"></small><?= $new->views; ?></span>
                <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new->id); ?></span>
            </div>
            <!--<div class="time">4 часа назад</div>-->
            <p><?= $new->title;?></p>

            <div class="po-teme">Популярное</div>
        </a>
    <?php endforeach; ?>
</div>