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
<section class="company">

    <div class="container">

        <h3 class="main-title">предприятия</h3>
        <span class="separator"></span>

        <a href="#" class="company__trigger">предприятия</a>

        <div class="company__box">
            <?php foreach ($companies as $k => $company): ?>
                <?php if ($k === 1 || $k === 7 || $k === 8): ?>
                    <a  href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>" class="item-large">
                        <div class="thumb">
                            <img src="<?= $company->photo ?>" alt="">
                        </div>
                        <div class="content">
                            <h4><?= $company->name ?></h4>
                            <!-- <p>Донецк Адрес: Пухова 31б </p>
                            <p>Телефон: 0667778540</p> -->
                        </div>
                        <div class="content-hover">
                            <h4><?= $company->name ?></h4>
                            <p><?= $company->address ?></p>
                            <p><?= $company->phone ?></p>
                        </div>
                    </a>
                <?php else: ?>
                    <a  href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>"  class="item-small">
                        <div class="thumb">
                            <img src="<?= $company->photo ?>" alt="">
                        </div>
                        <div class="content">
                            <h4><?= $company->name ?></h4>
                            <!-- <p>Донецк Адрес: Пухова 31б </p> -->
                            <!-- <p>Телефон: 0667778540</p> -->
                        </div>
                        <div class="content-hover">
                            <h4><?= $company->name ?></h4>
                            <p><?= $company->address ?> </p>
                            <p><?= $company->phone ?></p>
                        </div>
                    </a>
                <?php endif; ?>

            <?php endforeach; ?>
        </div>

        <a href="<?= Url::to(['/company/company']) ?>" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>

    </div>

</section>
