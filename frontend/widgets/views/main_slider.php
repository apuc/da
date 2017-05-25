<div class="home-content__wrap_slider">
    <?php foreach ($news as $new): ?>
        <!--<div class="item">
            <a href="<?/*= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); */?>">
                <img src="<?/*= $new->photo; */?>" alt="">
            </a>
            <div class="content">
                <div class="content-row">
                    <span><?/*= \frontend\widgets\MainSlider::getDateNew($new->dt_public); */?></span>
                    <a href="/news">Новости</a>
                    <span><small class="view-icon"></small> <?/*= $new->views; */?></span>
                </div>
                <h3><?/*= $new->title; */?></h3>
            </div>
        </div>-->

        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" class="item">

            <img src="<?= $new->photo; ?>" alt="">

            <div class="content">
                <div class="content-row">
                    <span><?= \frontend\widgets\MainSlider::getDateNew($new->dt_public); ?></span>
                    <span>Новости</span>
                    <span> <?= $new->views; ?></span>
                </div>
                <h3><?= $new->title; ?></h3>
                <p><?= strip_tags($new->content) ?></p>
            </div>
        </a>
    <?php endforeach; ?>
</div>