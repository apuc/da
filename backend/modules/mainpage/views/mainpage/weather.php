<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/mainpage/mainpage/weather'], 'post', ['class' => 'form-horizontal']) ?>

<?= Html::label('Погода в шапке:', 'header_img'); ?>

<?= Html::dropDownList('header_img', $weather->header_img, $weatherItems, ['class' => 'form-control']); ?>

<?= Html::label('Погода в шапке:', 'header_temp'); ?>

<?= Html::textInput('header_temp', $weather->header_temp, ['class' => 'form-control']); ?>

<br>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>

