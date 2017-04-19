<?php
/**
 * @var $categories \common\models\db\CategoryPoster
 */
use yii\helpers\Url;

?>
<section class="afisha-menu">
    <div class="container">
        <ul>
            <?php foreach ($categories as $category): ?>
                <li><a href="<?= Url::to([
                        '/poster/default/single_category',
                        'slug' => $category->slug,
                    ]) ?>"><?= $category->title; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>