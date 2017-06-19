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
            $k = 1;?>

            <?php foreach ($companies as $k => $company): ?>
                <?php if ($k === 2 || $k === 6 || $k === 10): ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>" class="business__sm-item favorite">

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

                    <ul class="business__sm-item--numbers">
                        <?php $phone = explode(' ', $company->phone);?>
                        <?php foreach ($phone as $phon):?>
                            <li><?= $phon ?></li>
                        <?php endforeach; ?>
                        <!--<li>+380667778540</li>-->
                    </ul>

                    <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                    <p class="business__sm-item--views"><?= $company->views; ?></p>

                </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>" class="business__sm-item">

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

                        <ul class="business__sm-item--numbers">
                            <?php $phone = explode(' ', $company->phone);?>
                            <?php foreach ($phone as $key => $phon):?>
                                <?php if($k == 3){break;} ?>
                                <li><?= $phon ?></li>
                            <?php endforeach; ?>
                            <!--<li>+380667778540</li>-->
                        </ul>

                        <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                        <p class="business__sm-item--views"><?= $company->views; ?></p>

                    </a>
                <?php endif; ?>


            <?php endforeach;?>
        </div>

        <a href="<?= Url::to(['/company/company']) ?>" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>

    </div>

</section>