<section class="what-say">
    <div class="container">
        <h2>О чем говорят в городе</h2>
        <div class="what-say__servises">
            <!-- <a href=""><span class="comments-icon"></span>Задать свой вопрос</a> -->
            <a href="<?= \yii\helpers\Url::to(['/site/design']);?>"><span class="mail-icon"></span>Подписаться на эту тему</a>
        </div>
        <div class="what-say__wrap">
            <?php foreach ($posts as $post): ?>
                <a href="" class="what-say__wrap_item">
                    <span class="counter"><?= $post->rating;?></span>
                    <div class="thumb">
                        <img src="<?= $post->photo;?>" alt="">
                    </div>
                    <div class="wrapi">
                        <span class="name"><?= $post->nickname;?></span>
                        <p><?= $post->title;?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>