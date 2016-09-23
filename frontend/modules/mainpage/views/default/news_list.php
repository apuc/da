<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 07.09.2016
 * Time: 17:02
 * @var $news \common\models\db\News
 */

?>
<?php foreach($news as $new): ?>
    <a href="#" data-id="<?= $new->id ?>" class="content__main_posts_items">
        <p class="post-of-time"><span class="posts-time"><?= date('Y-m-d H:i', $new->dt_add) ?></span><?= $new->title ?></p>
    </a>
<?php endforeach; ?>
