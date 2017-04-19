<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 16:57
 * @var $wrc array
 * @var $wrcList
 */

use kartik\select2\Select2;
use yii\helpers\Html;

$this->title = "Рекомендуем компании";
?>

    <h2><?= $this->title ?></h2>

<?= Html::beginForm('', 'post') ?>
<?= Html::label('Компании', null, ['class' => 'control-label']) ?>
<?= Select2::widget([
    'name' => 'wrc',
    'data' => $wrcList,
    'value' => $wrc,
    'options' => ['multiple' => true, 'prompt' => 'Выбрать', 'required'=>true],
]);
?>
    <br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?= Html::endForm() ?>