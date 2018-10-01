<?php
/**
 * @var $messengers array
 * @var $iterator integer
 */
use yii\helpers\Html;
use yii\widgets\MaskedInput;
?>
<div class="phones__wrap">
    <div class="input__wrap" style="position: relative; width: 100%;">
        <?= Html::label('Телефон:', 'Phones', ['class' => 'label-name']) ?>
        <?=MaskedInput::widget([
            'name' => 'mytext[]',
            'mask' => '+99-999-999-9999',
            'id' => 'phone'.$iterator,
            'options'=>[
                'class' => 'input-name jsHint',
            ],
            'clientOptions' => [
                'clearIncomplete' => true
            ]
        ]);
        ?>
        <button type="button" class="cabinet__remove-pkg company__remove-phone"
                style="position: absolute; top: 11px; right: 5px; border: none;"></button>

        <div class="memo" style="display: none">
            <span class="info-icon" style="background-image: url(/theme/portal-donbassa/img/icons/info.png)"></span>
            <span class="triangle-left"></span>
            <div class="">Номер телефона лица, которое отвечает за общение с заинтересованными пользователями портала.</div>
        </div>

    </div>

</div>


