<?php

use backend\modules\category_faq\models\CategoryFaq;
use common\models\db\Company;
use common\models\db\Consulting;
use common\models\db\Faq;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\faq\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field( $model, 'question' )->textInput( [ 'maxlength' => true ] ) ?>

    <!--    --><? //= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>
    <?php echo $form->field( $model, 'answer' )->widget( CKEditor::className(), [
        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions( 'elfinder', [
            'preset' => 'full',
            'inline' => false,
            'path'   => 'frontend/web/media/upload',
        ] ),
    ] ); ?>
    <!--    --><? //= $form->field($model, 'dt_add')->textInput() ?>

    <!--    --><? //= $form->field($model, 'dt_update')->textInput() ?>

    <!--    --><? //= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'views')->textInput() ?>

    <!--    --><? //= $form->field($model, 'user_id')->textInput() ?>
    <?= $form->field( $model, 'user_id' )->dropDownList( ArrayHelper::map( User::find()->all(), 'id', 'username' ), [ 'prompt' => 'Нет' ] ) ?>

    <!--    --><? //= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>


    <?= $form->field( $model, 'company_id' )->dropDownList( ArrayHelper::map( Company::find()->all(), 'id', 'name' ), [ 'prompt' => 'Нет' ] ) ?>

    <?= $form->field( $model, 'type' )->dropDownList( ArrayHelper::map( Consulting::find()->all(), 'slug', 'title' ), [ 'prompt' => 'Нет' ] ) ?>


    <?php if ( Yii::$app->controller->action->id == 'update' ) { ?>
        
        <?= $form->field( $model, 'cat_id' )->dropDownList( ArrayHelper::map( CategoryFaq::find()->where( [ 'type' =>  $model->type] )->all(), 'id', 'title' ) )->label( 'Категория' ) ?>
    
    <?php } else { ?>

        <?= $form->field( $model, 'cat_id' )->dropDownList( [ ], [ 'style' => 'display:none' ] )->label( 'Категория' ,['style'=>'display:none']) ?>

    <?php }; ?>
    <?php if ( empty( $model->sort_order ) ): ?>

        <?= $form->field( $model, 'sort_order' )->textInput( [

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
