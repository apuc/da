<?php

?>
<div class="commercial__content-sidebar">

    <form id="filterform" class="commercial__sidebar-filter" method="get" action="<?= \yii\helpers\Url::to(['search'])?>">

        <span class="commercial__sidebar-filter--children-category">
            <?php if(!empty($cat)):?>
                <?php
                echo \yii\helpers\Html::label('Подкатегория');
                echo \yii\helpers\Html::dropDownList(
                    'idCat[]',
                    (!empty($get['idCat'][0])) ? $get['idCat'][0] : null,
                    \yii\helpers\ArrayHelper::map($cat, 'id', 'name'),
                    [
                        'class' => 'childrenCategorySelect',
                        'prompt' => 'Выберите...'
                    ]
                );
                ?>
            <?php endif; ?>

            <?php if(!empty($catChildren)):?>
                <?php
                echo \yii\helpers\Html::label('Подкатегория');
                echo \yii\helpers\Html::dropDownList(
                    'idCat[]',
                    $get['idCat'][1],
                    \yii\helpers\ArrayHelper::map($catChildren, 'id', 'name'),
                    [
                        'class' => 'childrenCategorySelect',
                        'prompt' => 'Выберите...'
                    ]
                );
                ?>
            <?php endif; ?>
            <?php if(!empty($adsFields)): ?>
                <?= $adsFields ?>
            <?php endif; ?>
        </span>
        <div class="commercial__sidebar-filter--type">

            <h3 class="title">Тип:</h3>

            <div class="line-type">
                <input id="type-2" name="private" <?= (Yii::$app->request->get('private')) ? 'checked' : ''?> type="checkbox" class="input-checkbox">
                <label for="type-2" class="label-checkbox"></label>
                <p class="text-type">частные</p>
            </div>

            <div class="line-type">
                <input id="type-3" name="business" <?= (Yii::$app->request->get('business')) ? 'checked' : ''?> type="checkbox" class="input-checkbox">
                <label for="type-3" class="label-checkbox"></label>
                <p class="text-type">бизнес</p>
            </div>

        </div>

        <div class="ad-charasteristics-form-priece">

            <h3 class="ad-charasteristics-form-type-title">Стоимость:</h3>

            <div id="options">
                <label for="price">
                    от
                    <input type="text" selprice="2" name="minPrice" value="2" id="price" maxlength="10">
                </label>
                <label for="price2">
                    до
                    <input type="text" selprice="2147483647" name="maxPrice" value="2147483647"
                           id="price2" maxlength="10">
                </label>
                <div id="slider_price"
                     class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                    <div class="ui-slider-range ui-corner-all ui-widget-header"
                         style="left: 0%; width: 100%;"></div>
                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                          style="left: 0%;"></span>
                    <span tabindex="0"class="ui-slider-handle ui-corner-all ui-state-default"
                          style="left: 100%;"></span>
                </div>

            </div>
        </div>


        <input type="hidden" name="regionFilter" value="<?= (isset($get['regionFilter'])) ? $get['regionFilter'] : ''?>">
        <input type="hidden" name="cityFilter" value="<?= (isset($get['cityFilter'])) ? $get['cityFilter'] : ''?>">
        <input type="hidden" name="mainCat" value="<?= (isset($get['mainCat'])) ? $get['mainCat'] : ''?>">
        <input type="hidden" name="textFilter" value="<?= (isset($get['textFilter'])) ? $get['textFilter'] : ''?>">

        <input class="commercial__sidebar-filter--submit" type="submit" value="применить">

    </form>

</div>