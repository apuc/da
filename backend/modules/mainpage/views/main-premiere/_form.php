<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\mainpage\models\MainPremiere */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="main-premiere-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'region_id')->widget(\kartik\select2\Select2::className(),
        [
            'data' => ArrayHelper::map($region, 'id', 'name'),
            //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
            'options' => ['placeholder' => 'Начните вводить регион ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]) ?>

    <div class="imgUpload container">
        <div class="media__upload_img">
            <?php if (!empty($model->photo)):
                $photos = explode(',', $model->photo);

                ?>
                <?php foreach ($photos as $photo):?>
                <img src="<?= $photo; ?>" width="100px">
            <?php endforeach; ?>
            <?php else:?>
                <img src="" width="100px">
            <?php endif; ?>
        </div>
        <?php
        echo "<br />";
        echo $form->field($model, 'photo')->widget(\mihaildev\elfinder\InputFile::className(),
            [
                'language' => 'ru',
                'controller' => 'elfinder',
                // вставляем название контроллера, по умолчанию равен elfinder
                'filter' => 'image',
                // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
                'name' => 'photos_images[]',
                'id' => 'photos_images',
                'template' => '<div class="input-group form-group">{input}<span class="span-btn">{button}</span></div>',
                'options' => ['class' => 'form-control itemImg2', 'maxlength' => '255'],
                'buttonOptions' => ['class' => 'btn btn-primary'],
                'value' => null,
                'buttonName' => 'Выбрать изображение',
                'multiple' => true,
            ]);
        ?>
        <br>
        <?php
        echo $form->field($model, 'afisha_id')->widget(\kartik\select2\Select2::className(),
            [
                'data' => \yii\helpers\ArrayHelper::map(\common\models\db\Poster::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Выберите афишу'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
