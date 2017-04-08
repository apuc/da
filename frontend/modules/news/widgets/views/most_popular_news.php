<div class="articles">
    <?php use yii\helpers\Url;

    foreach ($news as $new): ?>
        <div class="article">
            <img src="<?= $new->photo;?>" alt="">

            <div class="time">4 часа назад</div>
            <a href="<?= Url::to(['/news/default/view','slug'=>$new->slug]);?>"><?= $new->title;?></a>

            <div class="po-teme">Популярное</div>
        </div>
    <?php endforeach; ?>
</div>