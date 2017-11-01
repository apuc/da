<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 04.10.17
 * Time: 9:20
 */

//\common\classes\Debug::prn($model['type']);

use common\classes\WordFunctions;
use yii\helpers\Html;

if ($model['type'] == 'news') {

        $url = \yii\helpers\Url::to(['/news/default/view', 'slug' => $model['nslug']]);
        $materialType = 'Новости';
        $photo = $model['nphoto'];
        $title = $model['nn'];
        $dt = $model['ndt'];
        $descr = $model['ncontent'];
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

    //\common\classes\Debug::prn(1);
}

if ($model['type'] == 'company') {

        $url = \yii\helpers\Url::to(['/company/company/view', 'slug' => $model['cslug']]);
        $materialType = 'Предприятие';
        $photo = $model['cphoto'];
        $title = $model['cn'];
        $dt = $model['cdt'];
        $descr = $model['ccontent'];
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

?>

