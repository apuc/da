<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 12:38
 * @var $postersList array
 * @var $topSlider array
 */
use kartik\select2\Select2;
use yii\helpers\Html;

$this->title = "Верхнйи слайдер на странице афиш";
?>

<h2><?= $this->title ?></h2>

<?= Html::beginForm('', 'post') ?>
<?= Html::label('Афиши', null, ['class' => 'control-label']) ?>
<?= Select2::widget([
    'name' => 'posters',
    'data' => $postersList,
    'value' => $topSlider,
    'options' => ['multiple' => true, 'prompt' => 'Выбрать', 'required'=>true],
]);
?>
<br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?= Html::endForm() ?>

