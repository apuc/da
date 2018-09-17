<?php
/**
 * @var $news \common\models\db\News
 */

$this->title = 'Чтиво';
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Новости',
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Чтиво',
]);
?>

<div class="news-default-index">
    <?php \common\classes\Debug::prn($news) ?>
</div>
