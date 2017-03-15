<div class="home-content__wrap_slider">
    <?php foreach ($news as $new): ?>
        <div class="item">
            <img src="<?= $new->photo;?>" alt="">
            <div class="content">
                <div class="content-row">
                    <span><?= \frontend\widgets\MainSlider::getDateNew( $new->dt_public); ?></span>
                    <a href="/news">Новости</a>
                    <span><small class="view-icon"></small> <?= $new->views;?></span>
                </div>
                <a href="">
                    <h3><?= $new->title;?></h3>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>