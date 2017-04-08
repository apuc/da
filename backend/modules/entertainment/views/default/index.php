<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/entertainment/default'], 'post', ['class' => 'form-horizontal']) ?>

<?php echo Html::label('Главая: Развлечения', 'main_entertainment', ['class' => 'control-label']) ?>
<?php //echo Html::textInput('main_page_meta_title', $key_val['main_page_meta_title'],['class' => 'form-control', 'id'=>'main_page_meta_title']) ?>
<?php //echo Html::dropDownList('main_entertainment', [], $companyList,
//    [
//        'class' => 'form-control',
//        'id' => 'main_entertainment',
//        'multiple' => true,
//        'style' => 'height:600px;',
//    ]) ?>
<?php echo \kartik\select2\Select2::widget([
    'name' => 'main_entertainment',
    'data' => $companyList,
    'value'=>$main_entertainment->main_entertainments,
    'options' => ['multiple' => true, 'prompt' => 'Выбрать'],
]);
echo '<br/>';
echo \kartik\select2\Select2::widget([
    'name' => 'main_entertainments_big',
    'data' => $companyList,
    'value'=>$main_entertainment->main_entertainments_big,
    'options' => ['prompt' => 'Выбрать'],
]);
?>
<?php //echo Html::dropDownList('main_entertainment_big', [], $companyList,
//    [
//        'class' => 'form-control',
//        'id' => 'main_entertainment',
//        'prompt' => 'Выбрать',
//    ]) ?>

<br>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>
