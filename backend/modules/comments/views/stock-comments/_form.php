<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\StockComments */
/* @var $form yii\widgets\ActiveForm */
/* @var $users array */
?>

<div class="stock-comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stock_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->widget(\kartik\select2\Select2::className(),
        [
            'data' => \yii\helpers\ArrayHelper::map($users, 'id', 'username'),
            'options' => ['placeholder' => 'Начните вводить login ...', 'multiple' => false],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]
    );
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dt_add')->textInput() ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'moder_checked')->dropDownList(['0' => 'Не отмечено', '1' => 'Отмечено']) ?>

    <?= $form->field($model, 'published')->dropDownList(['0' => 'Не опубликовано', '1' => 'Опубликовано']) ?>

    <?= $form->field($model, 'verified')->dropDownList(['0' => 'Не проверено', '1' => 'Проверено']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('comments', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
