<?php

use miloschuman\highcharts\Highcharts;

/** @var common\models\db\Company $model */

$statistics = $model->getPage('statistics');
?>
<div class="cabinet__pkg-descr">

    <div class="cabinet__like-block--company-photo">
        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['photo']) ?>" alt="">
    </div>

    <h3 class="cabinet__like-block--company-name">
        <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $model['slug']]) ?>">
            <?= $model['name']; ?>
        </a>
    </h3>
    <div class="editing">
        <a href="<?= \yii\helpers\Url::to(['/company/company/update', 'id' => $model['id']]) ?>"
           class="cabinet__like-block--company-edit">редактировать</a>
        <a data-method="post" data-confirm="Вы уверены, что хотите удалить этот элемент?"
           href="<?= \yii\helpers\Url::to(['/company/company/delete', 'id' => $model['id']]) ?>"
           class="cabinet__like-block--company-remove">удалить </a>
    </div>
    <p class="cabinet__like-block--company-address"><?= $model['address']; ?></p>
    <p class="cabinet__like-block--company-address"><?= $model['email']; ?></p>
    <?php if (!empty($model['allPhones'])): ?>
        <p class="cabinet__like-block--company-address">
            <?php foreach ($model['allPhones'] as $phone)
                echo $phone->phone . ' '; ?>
        </p>
    <?php endif; ?>

</div>

<div class="cabinet__pkg-block">

    <?php if ($model['status'] == 1 || $model['status'] == 2): ?>
        <h3>Предприятие <span>на модерации</span></h3>
        <p class="notice">Ваше предприятие будет
            опубликована как только пройдет
            модерацию</p>
    <?php endif; ?>

    <?php if ($model['status'] == 0): ?>
            <?php if(isset($item['tariff']->name)): ?>
                <p class="cabinet__pkg-block--type">Тариф <?= $model['tariff']->name ?></p>
                <p class="cabinet__pkg-block--period"><?= \common\classes\DateFunctions::getTimeCompany($model['dt_end_tariff']); ?></p>
            <?php endif ?>
            <a href="<?= \yii\helpers\Url::to(['/company/default/set-tariff-company', 'id' => $model['id']]) ?>"
               class="cabinet__like-block--company-edit">сменить тариф</a>
    <?php endif; ?>

</div>

<!--<div class="cabinet-company-statistic">-->
<!--    <div class="cabinet-company-statistic__header">-->
<!--        <h3>Статистика компании</h3>-->
<!--        <a href="#" class="company-static-close"><i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--            свернуть блок статистики</a>-->
<!--    </div>-->
<!--    <div class="cabinet-company-statistic__body">-->
<!--        <div class="cabinet-company-statistic__body--left">-->
<!--            <h4>Охват аудитории</h4>-->
<!--            <p>Количество посетителей <b>--><?//= $statistics['allViews'] ?><!--</b></p>-->
<!--            <p>Количество <span>уникальных</span> посетителей-->
<!--                <b>--><?//= $statistics['uniqueViews'] ?><!--</b></p>-->
<!--            --><?php //if (!empty($statistics['allViews'])) : ?>
<!--                <h5>География </h5>-->
<!--                <table style="width: 95%">-->
<!--                    <thead>-->
<!--                    <tr>-->
<!--                        <td>Город</td>-->
<!--                        <td>Общие</td>-->
<!--                        <td>Уникальные</td>-->
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                    </tbody>-->
<!--                </table>-->
<!--            --><?php //endif; ?>
<!--        </div>-->
<!--        <div class="cabinet-company-statistic__body--right" id="piechart">-->
<!--            --><?php //if (!empty($statistics['allViews'])) {
//                echo Highcharts::widget($statistics['optionsCV']);
//                echo Highcharts::widget($statistics['optionsCVR']);
//            } ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
