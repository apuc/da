<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 04.10.17
 * Time: 9:20
 */

//\common\classes\Debug::prn($model);

use common\classes\WordFunctions;
use yii\helpers\Html;

if ($model['type'] == 'news') {
    if (!empty($model['news'])) {
        $url = \yii\helpers\Url::to(['/news/default/view', 'slug' => $model['news']['slug']]);
        $materialType = 'Новости';
        $photo = $model['news']['photo'];
        $title = $model['news']['title'];
        $dt = $model['news']['dt_update'];
        $descr = $model['news']['content'];
        ?>
        <a href="<?= $url; ?>" class="search-content__item">

            <p class="search-content__item--title"><?= $materialType; ?></p>

            <div class="search-content__item--img">
                <img src="<?= $photo ?>">
            </div>

            <div class="search-content__item--content">

                <h3><?= $title; ?></h3>
                <span><?= WordFunctions::dateWithMonts($dt); ?></span>

                <?= Html::tag('p', yii\helpers\StringHelper::truncate(strip_tags($descr), 150, '...')) ?>

            </div>

        </a>
        <?php
    }
    //\common\classes\Debug::prn(1);
}

if ($model['type'] == 'company') {
    if (!empty($model['company'])) {
        $url = \yii\helpers\Url::to(['/company/company/view', 'slug' => $model['company']['slug']]);
        $materialType = 'Предприятие';
        $photo = $model['company']['photo'];
        $title = $model['company']['name'];
        $dt = $model['company']['dt_update'];
        $descr = $model['company']['descr'];
        ?>
        <a href="<?= $url; ?>" class="search-content__item">

            <p class="search-content__item--title"><?= $materialType; ?></p>

            <div class="search-content__item--img">
                <img src="<?= $photo ?>">
            </div>

            <div class="search-content__item--content">

                <h3><?= $title; ?></h3>
                <span><?= WordFunctions::dateWithMonts($dt); ?></span>

                <?= Html::tag('p', yii\helpers\StringHelper::truncate(strip_tags($descr), 150, '...')) ?>

            </div>

        </a>
        <?php
    }
}

?>

