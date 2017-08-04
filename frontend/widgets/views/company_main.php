<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.03.2017
 * Time: 16:28
 * @var $companies \common\models\db\Company
 */
use yii\helpers\Url;

?>
<section class="company-slider">

    <div class="container">

        <h3 class="main-title">предприятия</h3>
        <span class="separator"></span>

        <a href="#" class="company__trigger">предприятия</a>

        <div class="company-slider__box">
            <?php
            $count = 0;
            foreach ($companies as $k => $company): ?>
                <?php if($count == 0): ?>
                    <div class="company-slider__box_item">
                <?php endif;?>
                    <?php if($count == 1): ?>
                        <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>"
                           class="business__big-item <?= ($company->recommended == 1) ? 'favorite' : ''?>">

                            <div class="recommend">
                                <span class="recommend__star"></span>
                                Рекомендуем
                            </div>

                            <div class="business__sm-item--img">
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($company->photo) ?>" alt="">
                            </div>

                            <p class="business__sm-item--title"><?= $company->name ?></p>

                            <p class="business__sm-item--address">
                                <span>Адрес:</span>
                                <span><?= $company->address ?></span>
                            </p>

                            <?php $phone = explode(' ', $company->phone) ?>
                            <ul class="business__sm-item--numbers">
                                <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                            </ul>

                            <ul class="business__sm-item--numbers">
                                <li><?= isset($phone[2]) ? $phone[2] : '' ?></li>
                                <li> <?= isset($phone[3]) ? $phone[3] : '' ?></li>
                            </ul>

                            <span class="business__sm-item--views-icon"></span>
                            <p class="business__sm-item--views"><?= $company->views; ?></p>

                        </a>
                    <?php else: ?>
                        <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>"
                           class="business__sm-item <?= ($company->recommended == 1) ? 'favorite' : ''?>">

                            <div class="recommend">
                                <span class="recommend__star"></span>
                                Рекомендуем
                            </div>

                            <div class="business__sm-item--img">
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($company->photo) ?>" alt="">
                            </div>

                            <p class="business__sm-item--title"><?= $company->name ?></p>

                            <p class="business__sm-item--address">
                                <span>Адрес:</span>
                                <span><?= $company->address ?></span>
                            </p>

                            <?php $phone = explode(' ', $company->phone) ?>
                            <ul class="business__sm-item--numbers">
                                <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                                <li><?= isset($phone[2]) ? $phone[2] : '' ?></li>
                            </ul>

                            <span class="business__sm-item--views-icon"></span>
                            <p class="business__sm-item--views"><?= $company->views; ?></p>

                        </a>
                    <?php endif;?>

                <?php
                    $count++;
                ?>
                <?php if($count == 4) {
                    $count = 0;
                    echo "</div>";
                }?>


            <?php endforeach;?>
        </div>



    </div>
        <a href="<?= Url::to(['/company/company']) ?>" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
</section>