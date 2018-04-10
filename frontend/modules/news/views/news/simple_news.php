<?php
use common\classes\WordFunctions;
use yii\helpers\Url;

foreach($news as $new): ?>
    <div class="news__wrap_item-sm">
        <a href="<?= Url::to([
            '/news/default/view',
            'slug' => $new->slug,
        ]); ?>" class="thumb" title="<?= $new->title; ?>">
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($new->photo); ?>" alt="">
            <div class="content-row">
                <span><small class="view-icon"></small> <?= $new->views; ?></span>
                <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new->id)?></span>
                <span><?= $new['categoryNewsRelations'][0]['cat']->title; ?></span>
            </div>

        </a>
        <div class="content-item">
            <p><a href="<?= Url::to([
                    '/news/default/view',
                    'slug' => $new->slug,
                ]); ?>"><?= $new->title; ?></a></p>
            <span><?= WordFunctions::dateWithMonts($new->dt_public); ?></span>
        </div>
    </div>
<?php endforeach; ?>
