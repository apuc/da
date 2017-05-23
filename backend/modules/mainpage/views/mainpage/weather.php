<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/mainpage/mainpage/weather'], 'post', ['class' => 'form-horizontal']) ?>

<?= Html::label('Иконка сегодня:', 'header_img_today'); ?>

<?= Html::dropDownList('header_img_today',
    \yii\helpers\ArrayHelper::getValue($weather, [strtotime('now 00:00:00'), 'header_img']), $weatherItems,
    ['class' => 'form-control']); ?>

<?= Html::label('Температура  сегодня:', 'header_temp_today'); ?>

<?= Html::textInput('header_temp_today',
    \yii\helpers\ArrayHelper::getValue($weather, [strtotime('now 00:00:00'), 'header_temp']),
    ['class' => 'form-control']); ?>
<br>
<!--завтра-->
<?= Html::label('Иконка завтра:', 'header_img_tomorrow'); ?>

<?= Html::dropDownList('header_img_tomorrow',
    \yii\helpers\ArrayHelper::getValue($weather, [strtotime('+1 day 00:00:00'), 'header_img']), $weatherItems,
    ['class' => 'form-control']); ?>

<?= Html::label('Температура  завтра:', 'header_temp_tomorrow'); ?>

<?= Html::textInput('header_temp_tomorrow',
    \yii\helpers\ArrayHelper::getValue($weather, [strtotime('+1 day 00:00:00'), 'header_temp']),
    ['class' => 'form-control']); ?>
<br>
<!--послезавтра-->
<?= Html::label('Иконка послезавтра:', 'header_img_after_tomorrow'); ?>

<?= Html::dropDownList('header_img_after_tomorrow',
    \yii\helpers\ArrayHelper::getValue($weather, [strtotime('+2 day 00:00:00'), 'header_img']), $weatherItems,
    ['class' => 'form-control']); ?>

<?= Html::label('Температура  завтра:', 'header_temp_after_tomorrow'); ?>

<?= Html::textInput('header_temp_after_tomorrow',
    \yii\helpers\ArrayHelper::getValue($weather, [strtotime('+2 day 00:00:00'), 'header_temp']),
    ['class' => 'form-control']); ?>
<br>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>

