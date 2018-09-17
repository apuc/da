<?php
use yii\helpers\Html;
?>


<!--<div class="cabinet__inner-box">

    <h3>Мои компании</h3>

    <a href="<?/*= \yii\helpers\Url::to(['/company/company/create']); */?>" class="cabinet__inner-box--add">
        добавить
        <span>
            <img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt="">
        </span>
    </a>

    <?php
/*    if(!empty($userCompany)): */?>
        <?php /*foreach ($userCompany as $item): */?>
            <div href="#" class="business__sm-item">
                <div class="business__sm-item--img">
                    <img src="<?/*= $item->photo; */?>" alt="">
                </div>

                <p class="business__sm-item--title"><?/*= $item->name*/?></p>

                <p class="business__sm-item--address">
                    <span>Адрес:</span>
                    <span><?/*= $item->address; */?></span>
                </p>

                <?php /*$phone = explode(' ', $item->phone) */?>
                <ul class="business__sm-item--numbers">
                    <li><?/*= isset($phone[0]) ? $phone[0] : '' */?></li>
                    <li> <?/*= isset($phone[1]) ? $phone[1] : '' */?></li>
                </ul>

                <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>
                <p class="business__sm-item--views"><?/*= $item->views; */?></p>

                <div class="cabinet__inner-box--toolth">

                    <a data-method="post" href="<?/*= \yii\helpers\Url::to(['/company/company/delete', 'id' => $item->id]) */?>">
                        <img src="/theme/portal-donbassa/img/icons/cabinetd-delete-icon.png" alt="">
                    </a>
                    <a href="">
                        <img src="/theme/portal-donbassa/img/icons/cabinet-edit-icon.png" alt="">
                    </a>
                    <a href="<?/*= \yii\helpers\Url::to(['/company/company/view', 'slug' => $item->slug]) */?>">
                        <img src="/theme/portal-donbassa/img/icons/cabinet-show-icon.png" alt="">
                    </a>

                </div>

            </div>
        <?php /*endforeach; */?>

    <?php /*else: */?>
        <div class="cabinet__add-element">
            <p>Раздел пока пуст</p>
            <?/*= Html::a('Добавить', \yii\helpers\Url::to(['/company/company/create']), ['class' => 'show-more']);*/?>
        </div>
    <?php /*endif; */?>
</div>-->


<div class="cabinet__inner-box">

    <h3>Мои компании</h3>

    <a href="<?= \yii\helpers\Url::to(['/company/company/create']); ?>" class="cabinet__inner-box--add">добавить <span><img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt=""></span></a>
    <a href="<?= \yii\helpers\Url::to(['/personal_area/user-company'])?>" class="cabinet__inner-box--add">посмотреть <span><img src="/theme/portal-donbassa/img/icons/stat-views-icon.png" alt=""></span></a>

    <?php
    if(!empty($userCompany)): ?>
    <div class="cabinet__inner-box--hover">
        <?php foreach ($userCompany as $item): ?>
            <div class="cabinet__like-block">

                <div class="cabinet__pkg-descr">

                    <div class="cabinet__like-block--company-photo">
                        <img src="<?= $item->photo; ?>" alt="">
                    </div>

                    <h3 class="cabinet__like-block--company-name"><?= $item->name?></h3>
                    <div class="editing">
                        <a href="<?= \yii\helpers\Url::to(['/company/company/update', 'id' => $item->id]) ?>" class="cabinet__like-block--company-edit">редактировать</a>
                        <a data-method="post" href="<?= \yii\helpers\Url::to(['/company/company/delete', 'id' => $item->id]) ?>" class="cabinet__like-block--company-remove">удалить</a>
                    </div>
                    <p class="cabinet__like-block--company-address"><?= $item->address; ?></p>

                    <p class="cabinet__like-block--company-views">Количество посетителей

                        <span class="views"><?= $item->views; ?></span>
                        <!--<span class="date">30 дней:</span>-->
                    </p>



                </div>

                <div class="cabinet__pkg-block">
                    <?php if($item->status == 1): ?>
                        <h3>Предприятие <span>на модерации</span></h3>
                        <p class="notice">Ваше предприятие будет
                            опубликована как только пройдет
                            модерацию</p>
                    <?php endif; ?>

                    <?php if($item->status == 0): ?>
<!--                        --><?php //if($item->tariff_id == 0): ?>
<!--                            <a href="--><?//= \yii\helpers\Url::to(['/company/default/set-tariff-company', 'id' => $item->id])?><!--" class="show-more">Подключить тариф</a>-->
<!--                        --><?php //else: ?>
                        <?php if(isset($item['tariff']->name)): ?>
                            <p class="cabinet__pkg-block--type">Тариф <?=$item['tariff']->name?></p>
                        <?php endif ?>
                        <p class="cabinet__pkg-block--period"><?= \common\classes\DateFunctions::getTimeCompany($item->dt_end_tariff); ?></p>

                        <!--<a href="#" class="cabinet__like-block--company-edit">сменить тариф</a>-->
                        <a href="<?= \yii\helpers\Url::to(['/company/default/set-tariff-company', 'id' => $item->id])?>" class="cabinet__like-block--company-edit">сменить тариф</a>
<!--                        --><?php //endif; ?>
                    <?php endif; ?>


                    <!--<p class="cabinet__pkg-block--type">Пакет Базовый</p>

                    <p class="cabinet__pkg-block--period">до <span>23.05.2015 (еще 1 месяц)</span></p>

                    <a href="#" class="cabinet__like-block--company-edit">сменить тариф</a>-->



                </div>

            </div>

        <?php endforeach; ?>
    </div>
    <?php else: ?>
        <div class="cabinet__add-element">
            <p>Раздел пока пуст</p>
            <a href="<?= \yii\helpers\Url::to(['/company/company/create']); ?>" class="show-more">добавить</a>
        </div>
    <?php endif; ?>
</div>