<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 19.04.2017
 * Time: 11:40
 * @var $meta_title \common\models\db\KeyValue
 * @var $meta_descr \common\models\db\KeyValue
 * @var $wrc array
 * @var $positions array
 * @var $organizations \common\models\db\Company
 */
use common\classes\GeobaseFunction;
use yii\helpers\Url;

?>
<?php $pos = 0;
$wrc_count = 0; ?>
<?php while($pos < 16): ?>
    <?php if (in_array($pos, $positions, true)): ?>
        <?php $company = isset($wrc[$wrc_count]) ? $wrc[$wrc_count] : $organizations[$pos] ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>"
           class="business__big-item <?= ($company->recommended == 1) ? 'favorite' : ''?>">
            <div class="recommend">
                <span class="recommend__star"></span>
                Рекомендуем
            </div>
            <div class="business__sm-item--img">



                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($company->photo); ?>" alt="">
            </div>

            <p class="business__sm-item--title">
                <?= $company->name ?>
            </p>
            <?php if($company->verifikation == 1): ?>
                <span class="business__sm-item--label">
                    <img src="/theme/portal-donbassa/img/icons/ver.png" alt="">
                </span>
            <?php endif; ?>
            <!--<p class="business__big-item--address">
                <span>Время работы Министерства:</span>
                <span>с 9:00 до 18:00 (перерыв с 13:00 до 14:00)</span>
            </p>-->

            <p class="business__sm-item--address">
                <span>Адрес:</span>
                <?php
                if($company->region_id != 0){
                    $address = GeobaseFunction::getRegionName($company->region_id) . ', ' .GeobaseFunction::getCityName($company->city_id) . ', ' . $company->address ;
                }
                else{
                    $address = $company->address;
                }
                ?>
                <span><?= $address ?></span>
            </p>

            <?php if (!empty($company->phone)): ?>
                <?php $phone = explode(' ', $company->phone) ?>
                <ul class="business__sm-item--numbers">
                    <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                    <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                </ul>

                <ul class="business__sm-item--numbers">
                    <li><?= isset($phone[2]) ? $phone[2] : '' ?></li>
                    <li> <?= isset($phone[3]) ? $phone[3] : '' ?></li>
                </ul>

            <?php elseif(!empty($company->allPhones)):?>
                <ul class="business__sm-item--numbers">
                <?php foreach ($company->allPhones as $key => $phones):?>
                    <?php if ($key == 2):?>
                        </ul><ul class="business__sm-item--numbers">
                    <?php endif; ?>
                    <li><?= $phones->phone?></li>
                    <?php if ($key == 4) break;?>
                <?php endforeach;?>
                </ul>
            <?php endif; ?>

            <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
            <p class="business__sm-item--views"><?= $company->views ?></p>

        </a>
        <?php $pos++;$wrc_count++; ?>
    <?php else: ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $organizations[$pos]->slug]) ?>"
           class="business__sm-item <?= ($organizations[$pos]->recommended == 1) ? 'favorite' : ''?>">
            <div class="recommend">
                <span class="recommend__star"></span>
                Рекомендуем
            </div>
            <div class="business__sm-item--img">
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($organizations[$pos]->photo); ?>" alt="">
            </div>

            <p class="business__sm-item--title">
                <?= $organizations[$pos]->name ?>
            </p>
            <?php if($organizations[$pos]->verifikation == 1): ?>
                <span class="business__sm-item--label">
                    <img src="/theme/portal-donbassa/img/icons/ver.png" alt="">
                </span>
            <?php endif; ?>
            <p class="business__sm-item--address">
                <span>Адрес:</span>
                <span><?= $organizations[$pos]->address ?></span>
            </p>
            <?php

            if (!empty($organizations[$pos]->phone)): ?>
                <?php $phone = explode(' ', $organizations[$pos]->phone) ?>
                <ul class="business__sm-item--numbers">
                    <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                    <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                </ul>

            <?php elseif(!empty($organizations[$pos]->allPhones)):?>
                <ul class="business__sm-item--numbers">
                <?php foreach ($organizations[$pos]->allPhones as $key => $phones):?>
                    <li><?= $phones->phone?></li>
                    <?php if ($key == 1) break;?>
                <?php endforeach;?>
                </ul>
            <?php endif; ?>

            <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
            <p class="business__sm-item--views"><?= $organizations[$pos]->views ?></p>

        </a>
        <?php $pos++; ?>
    <?php endif; ?>
<?php endwhile; ?>
