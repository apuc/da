<div class="home-content__wrap_slider">
    <?php foreach ($news as $new): ?>
        <div class="item">
        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?>" >
            <img src="<?= $new->photo; ?>" alt="">
        </a>
            <div class="content">
                <div class="content-row">
                    <span><?= \frontend\widgets\MainSlider::getDateNew($new->dt_public); ?></span>
                    <a href="/news">Новости</a>
                    <span><small class="view-icon"></small> <?= $new->views; ?></span>
                </div>
                <!--<a href="--><?//= \yii\helpers\Url::to(["/news/default/view", "slug" => $new->slug]); ?><!--">-->
                    <h3><?= $new->title; ?></h3>
                <!--</a>-->
            </div>
        </div>
    <?php endforeach; ?>
</div>