<?php
/**
 * @var $adsFields
 */

//\common\classes\Debug::prn(\yii\helpers\ArrayHelper::getValue($adsFields['fields'], 'name'));
?>

<div class="shop__filter">


    <?php

    //\common\classes\Debug::prn($adsFields['fields']->type->type);

    /*if ($adsFields['fields']->type->type == 'text') {
        */ ?><!--
    <div class="form-line field-ads-<? /*= $adsFields['fields']->name; */ ?>">
        <div class="form-line">
            <? /*= \yii\helpers\Html::label($adsFields['fields']->label, 'name', ['class' => 'label-name']) */ ?>

            <? /*= \yii\helpers\Html::textInput('ProductField[' . $adsFields['fields']->name . ']', null,
                ['class' => 'input-name jsHint']) */ ?>
            <div class="error">
                <div class="help-block"></div>
            </div>
            <div class="memo"><span class="info-icon"></span><span
                        class="triangle-left"></span><? /*= $adsFields['fields']->hint; */ ?></div>
        </div>
    </div>
    --><?php
    /*
    }*/

    if ($adsFields['fields']->type->type == 'select' || $adsFields['fields']->type->type == 'checkboxList') {
        $arr = [];
        foreach ($adsFields['fields']->productFieldsDefaultValues as $item) {
            $arr[$item->id] = $item->value;
        }

        ?>

        <div class="shop__filter-title"><?= $adsFields['fields']->label ?>
            <div class="shop__filter-list">
                <?= \yii\helpers\Html::checkboxList(
                        $adsFields['fields']->name,
                    null,
                    $arr,
                    [
                        'itemOptions' =>
                            [
                                'class' => 'filter-search'
                            ]
                    ]
                )
                ?>
            </div>
        </div>
        <?php
    }

    if ($adsFields['fields']->type->type == 'checkbox') {
        //\common\classes\Debug::prn($adsFields);
        ?>

        <div class="shop__filter-title"><?= $adsFields['fields']->label ?>
            <div class="shop__filter-list">
                <?= \yii\helpers\Html::checkbox('ProductField[' . $adsFields['fields']->name . ']', false) ?>
            </div>
        </div>

        <!--<div class="form-line field-ads-<?/*= $adsFields['fields']->name; */?>">
            <div class="form-line">
                <?/*= \yii\helpers\Html::label($adsFields['fields']->label, 'name', ['class' => 'label-name']) */?>

                <?/*= \yii\helpers\Html::hiddenInput('ProductField[' . $adsFields['fields']->name . ']', 0) */?>
                <?/*= \yii\helpers\Html::checkbox('ProductField[' . $adsFields['fields']->name . ']', false,
                    ['class' => 'input-name jsHint']) */?>


                <div class="error">
                    <div class="help-block"></div>
                </div>
                <div class="memo"><span class="info-icon"></span><span
                            class="triangle-left"></span><?/*= $adsFields['fields']->hint; */?></div>
            </div>
        </div>-->
    <?php }

    /*if ($adsFields['fields']->type->type == 'checkboxList') {
        //\common\classes\Debug::prn($adsFields);
        $arr = [];
        foreach ($adsFields['fields']->productFieldsDefaultValues as $item) {
            $arr[$item->id] = $item->value;
        }

        */?><!--
        <div class="form-line field-ads-<?/*= $adsFields['fields']->name; */?>">
            <div class="form-line">
                <?/*= \yii\helpers\Html::label($adsFields['fields']->label, 'name1', ['class' => 'label-name']) */?>

                <?/*= \yii\helpers\Html::checkboxList('ProductField[' . $adsFields['fields']->name . ']',
                    null,
                    $arr,
                    ['class' => 'input-name jsHint']) */?>
                <div class="error">
                    <div class="help-block"></div>
                </div>
                <div class="memo"><span class="info-icon"></span><span
                            class="triangle-left"></span><?/*= $adsFields['fields']->hint; */?></div>
            </div>
        </div>
        --><?php
/*    }*/
    ?>

</div>
