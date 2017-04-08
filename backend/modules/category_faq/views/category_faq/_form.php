<?php

use common\models\db\CategoryFaq;
use common\models\db\Consulting;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_faq\models\CategoryFaq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>

    <!--    --><? //= $form->field($model, 'parent_id')->textInput() ?>
    <?= $form->field( $model, 'parent_id' )->dropDownList( ArrayHelper::map( CategoryFaq::find()->all(), 'id', 'title' ), [ 'prompt' => 'Нет' ] ) ?>

    <!--    --><? //= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'dt_add')->textInput() ?>

    <!--    --><? //= $form->field($model, 'dt_update')->textInput() ?>

    <!--    --><? //= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field( $model, 'type' )->dropDownList( ArrayHelper::map( Consulting::find()->all(), 'slug', 'title' ), [ 'prompt' => 'Нет' ] ) ?>
    <?php if ( empty( $model->sort_order ) ): ?>

        <?= $form->field( $model, 'sort_order' )->textInput( [
            //'value' => CategoryFaq::find()->orderBy( 'order DESC' )->one()->order + 1
            'value' =>  10
        ] )->label( 'Приоритет сортироки' ); ?>

    <?php else: ?>

        <?= $form->field( $model, 'sort_order' )->textInput()->label( 'Приоритет сортироки' ); ?>

    <?php endif; ?>

    <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'meta_descr')->textInput(['maxlength' => true]) ?>
    
    <div class="form-group">
        <?= Html::submitButton( $model->isNewRecord ? Yii::t( 'faq', 'Create' ) : Yii::t( 'faq', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
