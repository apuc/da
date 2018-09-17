<?php
/**
 * @var $adsFields
 */

//\common\classes\Debug::prn($adsFields);

use yii\helpers\ArrayHelper;
$adsFieldValue = ArrayHelper::index($adsFieldValue, 'ads_fields_name');

if($adsFields[0]->ads_fields_type->type == 'text'){

    if(!empty($adsFieldValue[$adsFields[0]->name]->value)){
        $value = $adsFieldValue[$adsFields[0]->name]->value;
    }else{
        $value = null;
    }
   // \common\classes\Debug::prn($value);
    ?>
    <div class="form-line field-ads-<?= $adsFields[0]->name; ?>">
        <div class="form-line">
            <?= \yii\helpers\Html::label($adsFields[0]->label, 'name',['class' => 'label-name'])?>
<?php// \common\classes\Debug::prn($adsFieldValue);

?>
            <?= \yii\helpers\Html::textInput('AdsField[' . $adsFields[0]->name . ']', $value, ['class' => 'input-name jsHint']) ?>
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

    if(!empty($adsFieldValue[$adsFields[0]->name]->value)){
        $value = $adsFieldValue[$adsFields[0]->name]->value;
    }else{
        $value = null;
    }

    ?>

    <div class="form-line field-ads-<?= $adsFields[0]->name; ?>">
        <div class="form-line">
            <?= \yii\helpers\Html::label($adsFields[0]->label, 'name1',['class' => 'label-name'])?>

            <?= \yii\helpers\Html::dropDownList('AdsField[' . $adsFields[0]->name . ']', $value, $arr, ['class' => 'input-name jsHint',  'prompt' => 'Выберите']) ?>
            <div class="error"><div class="help-block"></div></div>
            <div class="memo"><span class="info-icon"></span><span class="triangle-left"></span><?= $adsFields[0]->hint; ?></div>
        </div>
    </div>
    <?php
}