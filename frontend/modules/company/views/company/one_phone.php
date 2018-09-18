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
        <?= Html::label('Телефон', 'Phones', ['class' => 'label-name']) ?>
        <?=MaskedInput::widget([
            'name' => 'Phones['.$iterator.'][phone]',
            'mask' => '999-999-9999',
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
            <div class="">Номер телефона лица, которое отвечает за работу с клиентами.</div>
        </div>

    </div>
    <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">

        <?php if (!empty($messengers)): ?>
            <div style="display: flex; justify-content: space-around; width: 100%; margin-top: 5px;">
                <?php foreach ($messengers as $id => $name): ?>
                    <label>
                        <input type="checkbox" name="messengeresArray[<?= $iterator ?>][]"
                               value="<?= $id ?>">
                        <?= $name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>


