<?php
use yii\helpers\Html;
?>


<div class="cabinet__inner-box">

    <h3>Мои компании</h3>

    <a href="<?= \yii\helpers\Url::to(['/company/company/create']); ?>" class="cabinet__inner-box--add">
        добавить
        <span>
            <img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt="">
        </span>
    </a>

    <?php
    if(!empty($userCompany)): ?>
        <?php foreach ($userCompany as $item): ?>
            <div href="#" class="business__sm-item">
                <div class="business__sm-item--img">
                    <img src="<?= $item->photo; ?>" alt="">
                </div>

                <p class="business__sm-item--title"><?= $item->name?></p>

                <p class="business__sm-item--address">
                    <span>Адрес:</span>
                    <span><?= $item->address; ?></span>
                </p>

                <?php $phone = explode(' ', $item->phone) ?>
                <ul class="business__sm-item--numbers">
                    <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                    <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                </ul>

                <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                <p class="business__sm-item--views"><?= $item->views; ?></p>

                <div class="cabinet__inner-box--toolth">

                    <a data-method="post" href="<?= \yii\helpers\Url::to(['/company/company/delete', 'id' => $item->id]) ?>">
                        <img src="/theme/portal-donbassa/img/icons/cabinetd-delete-icon.png" alt="">
                    </a>
                    <a href="">
                        <img src="/theme/portal-donbassa/img/icons/cabinet-edit-icon.png" alt="">
                    </a>
                    <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $item->slug]) ?>">
                        <img src="/theme/portal-donbassa/img/icons/cabinet-show-icon.png" alt="">
                    </a>

                </div>

            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <div class="cabinet__add-element">
            <p>Раздел пока пуст</p>
            <?= Html::a('Добавить', \yii\helpers\Url::to(['/company/company/create']), ['class' => 'show-more']);?>
        </div>
    <?php endif; ?>
</div>
