<?php
/**
 * @var $news \common\models\db\News
 */

$this->title = 'Новости';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Новости',
]);
?>

<div class="news-default-index">
    <?php \common\classes\Debug::prn($news) ?>
</div>
