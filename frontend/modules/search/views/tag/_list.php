<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 04.10.17
 * Time: 9:20
 */


use common\classes\WordFunctions;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;

if ($model['type'] == 'news') {
    $url = Url::to(['/news/default/view', 'slug' => $model['slug']]);
    $materialType = 'Новости';
}
if ($model['type'] == 'company') {
    $url = Url::to(['/company/company/view', 'slug' => $model['slug']]);
    $materialType = 'Предприятие';
}
if ($model['type'] == 'poster') {
    $url = Url::to(['/poster/default/view', 'slug' => $model['slug']]);
    $materialType = 'Афиша';
}
?>
<a href="<?= $url; ?>" class="search-content__item">
    <p class="search-content__item--title">
        <?= $materialType; ?>
    </p>
    <div class="search-content__item--img">
        <img src="<?= $model['photo']; ?>">
    </div>
    <div class="search-content__item--content">
        <h3><?= $model['title']; ?></h3>
        <span><?= WordFunctions::dateWithMonts($model['dt_update']); ?></span>
        <?= Html::tag('p', StringHelper::truncate(strip_tags($model['content']), 150, '...')) ?>
    </div>
</a>
