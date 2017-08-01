<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'cabinet__add-company-form',
            'enctype' => 'multipart/form-data',
        ],
    ]);
?>

<div class="cabinet__add-company-form--hover-wrapper" >
    <p class="cabinet__add-company-form--title">Категория</p>
    <?php $items= ArrayHelper::map($category, 'id', 'title');
    $param = ['class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию'];
    echo $form->field($model, 'categoryId[]')->dropDownList($items, $param)->label(false); ?>
    <a href="#" class="cabinet__remove-pkg delselectCateg"></a>
    <p class="cabinet__add-company-form--notice"></p>
</div>
<br />
