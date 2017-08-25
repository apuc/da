<?php
/**
 * @var $adsFields
 */

//\common\classes\Debug::prn($adsFields);

if($adsFields[0]->ads_fields_type->type == 'text'){?>
    <div class="form-line field-ads-<?= $adsFields[0]->name; ?>">
        <div class="form-line">
            <?= \yii\helpers\Html::label($adsFields[0]->label, 'name',['class' => 'label-name'])?>

            <?= \yii\helpers\Html::textInput('AdsField[' . $adsFields[0]->name . ']', null, ['class' => 'input-name jsHint']) ?>
            <div class="error"><div class="help-block"></div></div>
            <div class="memo"><span class="info-icon"></span><span class="triangle-left"></span><?= $adsFields[0]->hint; ?></div>
        </div>
    </div>
    <?php


}

if($adsFields[0]->ads_fields_type->type == 'select'){
    $arr = [];
    foreach ($adsFields[0]->ads_fields_default_value as $item) {
        $arr[$item->id] = $item->value;
    }

    ?>
    <div class="form-line field-ads-<?= $adsFields[0]->name; ?>">
        <div class="form-line">
            <?= \yii\helpers\Html::label($adsFields[0]->label, 'name1',['class' => 'label-name'])?>

            <?= \yii\helpers\Html::dropDownList('AdsField[' . $adsFields[0]->name . ']', null, $arr, ['class' => 'input-name jsHint',  'prompt' => 'Выберите']) ?>
            <div class="error"><div class="help-block"></div></div>
            <div class="memo"><span class="info-icon"></span><span class="triangle-left"></span><?= $adsFields[0]->hint; ?></div>
        </div>
    </div>
    <?php
}