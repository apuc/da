<?php

use yii\helpers\Html;
use common\models\db\ServicePeriods;
use \yii\widgets\MaskedInput;

$two = '0|1|2';
$five = '0|1|2|3|4|5';


?>
<div class="service_add" data-id="<?= $count ?>">
<?php \yii\widgets\Pjax::begin() ?>
    <?= Html::button('-', [
        'class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish button_service_delete',
        'data-id' => $count
    ]) ?>

    <div class='form-line'>
        <?= Html::label('Начало дня<span>*</span>', 'Products[service][' . $count . '][start]', ['class' => 'label-name']) ?>
        <?= MaskedInput::widget([
            'name' => 'Products[service][' . $count . '][start]',
            'mask' => $two . '9' . ':' . $five . '9' . ':' . $five . '9',
            'value' => '00:00:00',
            'options' => [
                'class' => 'input-name jsHint'
            ]
        ]); ?>
    </div>

    <div class='form-line'>
        <?= Html::label('Конец дня<span>*</span>', 'Products[service][' . $count . '][start]', ['class' => 'label-name']) ?>
        <?= MaskedInput::widget([
            'name' => 'Products[service][' . $count . '][end]',
            'mask' => $two . '9' . ':' . $five . '9' . ':' . $five . '9',
            'value' => '00:00:00',
            'options' => [
                'class' => 'input-name jsHint'
            ]
        ]); ?>
    </div>

    <div class='form-line'>
        <?= Html::label('', 'Products[service][' . $count . '][week_days]', ['class' => 'label-name']) ?>

        <?= Html::checkboxList('Products[service][' . $count . '][week_days]',
            null,
            ServicePeriods::getWeekDaysArray()
        ) ?>
    </div>
    <?php \yii\widgets\Pjax::end() ?>

</div>
