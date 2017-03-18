<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.03.2017
 * Time: 16:28
 * @var $companies \common\models\db\Company
 */

?>

<section class="company">

    <div class="container">

        <h3 class="main-title">предприятия</h3>
        <span class="separator"></span>

        <a href="#" class="company__trigger">предприятия</a>

        <div class="company__box">
            <?php foreach ($companies as $k => $company): ?>
                <?php if ($k === 1 || $k === 7 || $k === 8): ?>
                    <a href="#" class="company__big-item">
                <span class="company__item--image">
                    <img src="<?= $company->photo ?>" alt="">
                </span>

                        <div class="content">
                            <span class="company__item--title"><?= $company->name ?></span>

                            <p class="company__item--descr"><?= $company->address ?> <br> Телефон: <?= $company->phone ?></p>
                        </div>

                    </a>
                <?php else: ?>
                    <a href="#" class="company__item">
                <span class="company__item--image">
                    <img src="<?= $company->photo ?>" alt="">
                </span>

                        <div class="content">
                            <span class="company__item--title"><?= $company->name ?></span>

                            <p class="company__item--descr"> Телефон: <?= $company->phone ?></p>
                        </div>
                    </a>
                <?php endif; ?>

            <?php endforeach; ?>
            
        </div>

        <a href="#" class="more">посмотреть больше <i class="fa fa-chevron-right" aria-hidden="true"></i></a>

    </div>

</section>
