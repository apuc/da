<?php
/**
 * @var array $news
 * @var News $new
 */

use common\models\db\News;
use yii\helpers\Url;

?>
<section class="news">
    <div class="container">
        <div class="news__wrap">
            <?php if (empty($news)): ?>
                <h3 class="section-title"><?= 'Новостей пока нет' ?></h3>
            <?php endif; ?>
            <?php foreach ($news as $new) : ?>
                <a href="<?= Url::to([
                    '/news/default/view',
                    'slug' => $new->slug,
                ]); ?>" class=" news__wrap_item-sm-hot">
                    <div class="thumb">

                        <?php if (stristr($new->photo, 'http')): ?>
                            <img class="thumbnail" src="<?= $new->photo ?>" alt="">
                        <?php else: ?>
                            <img class="thumbnail"
                                 src="<?= $new->photo; ?>" alt="">
                        <?php endif; ?>

                        <div class="content-row">
                            <span><small class="view-icon"></small><?= $new->views; ?></span>
                            <span><small
                                        class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new->id) ?></span>
                            <span><?= $new['categoryNewsRelations'][0]['cat']->title; ?></span>
                        </div>
                    </div>
                    <div class="hover-wrap">
                              <span class="category">
                                <span class="category-star"></span>
                                ГОРЯЧЕЕ
                              </span>
                        <h2><?= $new->title; ?></h2>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>