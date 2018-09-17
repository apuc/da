<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\geobase_ip\models\GeobaseIp */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geobase-ip-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ip_begin')->textInput() ?>

    <?= $form->field($model, 'ip_end')->textInput() ?>

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->widget(\kartik\select2\Select2::className(),
        [
            'data' => \yii\helpers\ArrayHelper::map(\common\models\db\GeobaseCity::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Выберите'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
