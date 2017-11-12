<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\comments\models\Comments */
/* @var $form yii\widgets\ActiveForm */
/* @var $news \common\models\db\News */
/* @var $user \dektrium\user\models\User */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'post_type')->dropDownList(['news' => 'Новости', 'page' => 'Страницы', 'vk_post' => 'ВК']) ?>

    <?= $form->field($model, 'post_id')->hiddenInput()->label(false); ?>

   <!-- --><?/*= $form->field($model, 'user_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($user, 'id', 'username'),
        ['prompt' => 'Гость']
    ) */?>

    <?= $form->field($model, 'user_id')->widget(\kartik\select2\Select2::className(),
        [
            'data' => \yii\helpers\ArrayHelper::map($user, 'id', 'username'),
            'options' => ['placeholder' => 'Начните вводить login ...', 'multiple' => false],
            'pluginOptions' => [
                'allowClear' => true
            ],

        ]
    );
    ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parent_id')->textInput() ?>

    <?= $form->field($model, 'moder_checked')->dropDownList(['0' => 'Не отмечено', '1' => 'Отмечено']) ?>

    <?= $form->field($model, 'published')->dropDownList(['0' => 'Не опубликовано', '1' => 'Опубликовано']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('comments', 'Create') : Yii::t('comments', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
