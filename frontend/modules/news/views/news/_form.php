<?php

use common\models\db\CategoryNews;
use common\models\db\Lang;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(
    [
        'options' => [
            'class' => 'cabinet__add-company-form',
            'enctype' => 'multipart/form-data',
        ],
    ]);
?>

    <div class="cabinet__add-company-form--wrapper">
        <p class="cabinet__add-company-form--title">Категория</p>
       <?php
       $items= ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title');
       $param = ['class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию'];
       echo $form->field($model, 'categoryId[]')->dropDownList($items, $param)->label(false);
       /*= Html::dropDownList(
            'categoryId[]',
            null,
            ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title'),
            ['class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию']

        )*/
        ?>
        <a href="#" class="cabinet__add-pkg addCategAddNewsUser"></a>
        <span class="error_cat"></span>
    </div>

    <span class="addSelectCateg"></span>

    <!--<div class="cabinet__add-company-form--hover-wrapper" data-count="1">

    </div>-->

    <p class="cabinet__add-company-form--title">Заголовок новости</p>
    <?= $form->field( $model, 'title' )->textInput(['maxlength' => true, 'class' => 'cabinet__add-company-form--field'])->label(false); ?>

    <div class="cabinet__add-company-form--block"></div>



    <p class="cabinet__add-company-form--title">Обложка новости</p>
        <?php
        if (empty($model->photo)) {
            echo $form->field($model, 'photo', [
                'template' => '<label class="cabinet__add-company-form--add-foto">
                                    <span class="button"></span>
                                    {input}
                                    <img id="blah" src="" alt="" width="160px">
                                    </label>'
            ])->label(false)->fileInput();
        } else {
            echo $form->field($model, 'photo', [
                'template' => '{label}<div class="selectAvatar">
                                    <span>Нажмите для выбора</span>
                                    <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                    {input}</div>'
            ])->label(false)->fileInput();
        }
        ?>







    <!--<label class="cabinet__add-company-form--add-foto">
        <span class="button"></span>
        <input class="input-file" type="file">
    </label>-->

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Текст новости</p>

    <?php echo $form->field( $model, 'content' )->widget( CKEditor::className(), [
            /*'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                'preset' => 'base',
                'inline' => false,
                'path' => 'frontend/web/media/upload/users/' . Yii::$app->user->getId(),
           ]),*/
    ] )->label(false); ?>

<?= Html::submitButton( $model->isNewRecord ? Yii::t( 'news', 'Create' ) : Yii::t( 'news', 'Update' ), [ 'class' => 'cabinet__add-company-form--submit' ] ) ?>
<?php ActiveForm::end(); ?>