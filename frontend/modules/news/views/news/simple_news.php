<?php
use common\classes\WordFunctions;
use yii\helpers\Url;

foreach($news as $new): ?>
    <div class="news__wrap_item-sm">
        <div class="thumb">
            <img src="<?= $new->photo; ?>" alt="">
            <div class="content-row">
                <span><small class="view-icon"></small> <?= $new->views; ?></span>
                <a>Новости</a>
            </div>
        </div>
        <div class="content-item">
            <p><a href="<?= Url::to([
                    '/news/default/view',
                    'slug' => $new->slug,
                ]); ?>"><?= $new->title; ?></a></p>
            <span><?= WordFunctions::dateWithMonts($new->dt_public); ?></span>
        </div>
    </div>
<?php endforeach; ?>