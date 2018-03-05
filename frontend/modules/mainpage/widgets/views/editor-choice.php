<?php

/**
 * @var \common\models\db\News $item
 */

use common\classes\WordFunctions;
use yii\helpers\Url;

if (!empty($news)): ?>
    <div class="editors-choice">
        <h2>выбор редакции</h2>
        <?php foreach ($news as $item): ?>
            <a href="<?= Url::to(['/news/default/view', 'slug' => $item->slug,]); ?>" class="news__wrap_item-lg">
                <div class="thumb">
                    <img src="<?= $item->photo . '?width=255' ?>"
                         alt="<?= !empty($item->alt) ? $item->alt : $item->title ?>">
                    <div class="content-row">
                        <span><?= WordFunctions::dateWithMonts($item->dt_public); ?></span> <br>
                        <span><?= $item['categoryNewsRelations'][0]['cat']->title; ?></span>
                        <span><small class="view-icon"></small> <?= $item->views; ?></span>
                        <span>
                            <small class="comments-icon"></small>
                            <?= \common\models\db\News::getCommentsCount($item->id) ?>
                        </span>
                        <h2><?= $item->title; ?></h2>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

<?php endif;