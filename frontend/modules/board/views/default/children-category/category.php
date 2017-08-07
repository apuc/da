<?php
echo \yii\helpers\Html::dropDownList(
    'childrenCategory[]',
    null,
    \yii\helpers\ArrayHelper::map($cat, 'id', 'name'),
    [
        'class' => 'childrenCategorySelect',
        'prompt' => 'Выберите...'
    ]
);