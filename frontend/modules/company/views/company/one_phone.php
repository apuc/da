<?php

/**
 * @var $messengers array
 * @var $iterator integer
 */

use yii\helpers\Html;

?>
<div class="phones__wrap">
    <div class="input__wrap" style="position: relative; width: 100%;">
        <?= Html::label('Телефон', 'Phones', ['class' => 'label-name']) ?>
        <?= Html::textInput('Phones[phone]', '', ['class' => 'input-name', 'id' => 'Phones']) ?>
        <button type="button" class="cabinet__remove-pkg company__remove-phone"
                style="position: absolute; top: 11px; right: 5px; border: none;"></button>
    </div>
    <div class="messengers-choice" style="display: flex; flex-wrap: wrap; width: 70%; margin-left: auto;">
        <p style="width: 100%; margin-bottom: -1px">Выберите мессенджеры, если у вас привязан к ним телефон</p>
        <?php if (!empty($messengers)): ?>
            <div style="display: flex; justify-content: space-around; width: 100%; margin-top: 5px;">
                <?php foreach ($messengers as $id => $name): ?>
                    <label>
                        <input type="checkbox" name="Phones[new_<?= $iterator ?>][messengeresArray][]"
                               value="<?= $id ?>">
                        <?= $name ?>
                    </label>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>


