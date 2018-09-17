<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/exchange_rates/default'],'post',['class' => 'form-horizontal']) ?>
<?php echo Html::label('Доллар','dol', ['class'=>'control-label']) ?>
<?php echo Html::textInput('dol', $key_val['exchange_dol'],['class' => 'form-control', 'id'=>'dol']) ?>
<?php echo Html::label('Евро','euro', ['class'=>'control-label']) ?>
<?php echo Html::textInput('euro', $key_val['exchange_euro'],['class' => 'form-control', 'id'=>'euro']) ?>
<?php echo Html::label('Гривна','grn', ['class'=>'control-label']) ?>
<?php echo Html::textInput('grn', $key_val['exchange_grn'],['class' => 'form-control', 'id'=>'grn']) ?>
<br>
<?php echo Html::submitButton('Сохранить', ['class'=>'btn btn-success']) ?>
<?php echo Html::endForm() ?>
