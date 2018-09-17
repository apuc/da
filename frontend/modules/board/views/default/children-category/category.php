<?php
echo \yii\helpers\Html::label('Подкатегория');
echo \yii\helpers\Html::dropDownList(
    'idCat[]',
    null,
    \yii\helpers\ArrayHelper::map($cat, 'id', 'name'),
    [
        'class' => 'childrenCategorySelect',
        'prompt' => 'Выберите...'
    ]
);