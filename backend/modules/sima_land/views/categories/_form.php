<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\sima_land\models\SearchCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="query-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'path')->textInput()->hint('Фильтр потомков категории') ?>
    <?= $form->field($model, 'level')->textInput()->hint('Фильтр по уровню категории') ?>

    <div class="form-group">
        <?= Html::a('Выполнить запрос' ,
            [ 'index' , 'id' => $model['path'] , 'path' => $model['level'] ] ,
            [ 'class' => 'btn btn-success' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
