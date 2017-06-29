<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
?>

<div class="cabinet__add-company-form--hover-wrapper" >
    <p class="cabinet__add-company-form--title">Категория</p>
    <?= Html::dropDownList(
        'categoryId[]',
        null,
        ArrayHelper::map($category, 'id', 'title'),
        ['class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию']

    )?>
    <a href="#" class="cabinet__remove-pkg delselectCateg"></a>
    <p class="cabinet__add-company-form--notice"></p>
</div>
<br />
