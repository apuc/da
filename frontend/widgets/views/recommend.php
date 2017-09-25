<?php
/**
 * Created by PhpStorm.
 * User: 7
 * Date: 19.07.2017
 * Time: 11:10
 */
use yii\helpers\Url;
?>

<div class="business__sidebar stock" id="business-stock-sidebar">

    <h3>рекомендуем</h3>

    <a href="<?= Url::to(['/company/company/view', 'slug' => $companyBig->slug]) ?>" class="business__sm-item">

        <div class="recommend">
            <span class="recommend__star"></span>
            Рекомендуем
        </div>

        <div class="business__sm-item--img">
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($companyBig->photo); ?>" alt="">
        </div>

        <p class="business__sm-item--title"><?= $companyBig->name; ?></p>

        <?php if (!empty($companyBig->phone)): ?>
            <?php $phone = explode(' ', $company->phone) ?>
            <ul class="business__sm-item--numbers">
                <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
            </ul>


        <?php elseif(!empty($companyBig->allPhones)):?>
            <ul class="business__sm-item--numbers">
                <?php foreach ($companyBig->allPhones as $key => $phones):?>
                    <li><?= $phones->phone?></li>
                    <? if ($key == 1) break;?>
                <?php endforeach;?>
            </ul>
        <?php endif; ?>

        <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
        <p class="business__sm-item--views"><?= $companyBig->views;?></p>

    </a>
    <?php foreach ($model as $item): ?>
    <a href="<?= $item->link ?>" class="stock__item">
        <div class="stock__item_visible">
            <div class="thumb">
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
                <span class="time-icon"></span>
            </div>
            <div class="stock__item_label">
                <p><?= $item->title ?></p>
            </div>
            <div class="content">
                <?= $item->dt_event ?>
                <!--<p> Акция проходит <small>с 01.01.2017</small> </p>-->
                <!-- <a href="">подробнее</a>-->
            </div>

        </div>
    </a>
    <?php endforeach; ?>

</div>
