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

$fl= 0;
?>

<?= $form->field($model, 'slug')->hiddenInput()->label(false); ?>
    <input type="hidden" name="photo" id="" value="<?= $model->photo; ?>">

    <?php   if(!empty($selectCat)):?>
    <? foreach ($selectCat as $item):?>
        <? if(count($selectCat) == 1):?>
    <div class="cabinet__add-company-form--wrapper">
        <p class="cabinet__add-company-form--title">Категория</p>
        <?php
        $items= ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title');
        $param = ['options' =>[ $item->id => ['Selected' => true]],'class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию',];
        echo $form->field($model, 'categoryId[]')->dropDownList($items, $param)->label(false);

        ?>
        <a href="#" class="cabinet__add-pkg addCategAddNewsUser"></a>
        <span class="error_cat"></span>
    </div>
        <? elseif ($fl == 0):?>
            <div class="cabinet__add-company-form--wrapper">
                <p class="cabinet__add-company-form--title">Категория</p>
                <?php
                $items= ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title');
                $param = ['options' =>[ $item->id => ['Selected' => true]],'class' => 'cabinet__add-company-form--field selectCateg disabled', 'prompt' => 'Выберите категорию'];
                echo $form->field($model, 'categoryId[]')->dropDownList($items, $param)->label(false);

               ?>
                <a href="#" class="cabinet__add-pkg addCategAddNewsUser"></a>
                <span class="error_cat"></span>
            </div>
        <?elseif ($fl == (count($selectCat)-1)):?>

            <div class="cabinet__add-company-form--hover-wrapper">
                <p class="cabinet__add-company-form--title">Категория</p>
                <?php
                $items= ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title');
                $param = ['options' =>[ $item->id => ['Selected' => true]],'class' => 'cabinet__add-company-form--field selectCateg', 'prompt' => 'Выберите категорию'];
                echo $form->field($model, 'categoryId[]')->dropDownList($items, $param)->label(false);?>
                <a href="#" class="cabinet__remove-pkg delselectCateg"></a>
                <p class="cabinet__add-company-form--notice"></p>
                <span class="error_cat"></span>
            </div>
            <?else:?>
            <div class="cabinet__add-company-form--hover-wrapper">
                <p class="cabinet__add-company-form--title">Категория</p>
                <?php
                $items= ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title');
                $param = ['options' =>[ $item->id => ['Selected' => true]],'class' => 'cabinet__add-company-form--field selectCateg disabled', 'prompt' => 'Выберите категорию'];
                echo $form->field($model, 'categoryId[]')->dropDownList($items, $param)->label(false);
                ?>
                <a href="#" class="cabinet__remove-pkg delNewsSelectCateg"></a>
                <p class="cabinet__add-company-form--notice"></p>
                <span class="error_cat"></span>
            </div>
            <?endif;?>
        <? $fl++; ?>

        <? endforeach; $fl = 0; ?>
    <span class="addSelectCateg"></span>
    <? endif; ?>


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

        } echo $form->field($model, 'photo', [
    'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="' . $model->photo . '" alt="" width="160px">
                                        </label>'
])->label(false)->fileInput();
        ?>



    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Текст новости</p>

    <?php echo $form->field( $model, 'content' )->widget( CKEditor::className(), [
            /*'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
                'preset' => 'base',
                'inline' => false,
                'path' => 'frontend/web/media/upload/users/' . Yii::$app->user->getId(),
           ]),*/
    ] )->label(false); ?>

<?= Html::submitButton( $model->isNewRecord ? Yii::t( 'news', 'Create' ) : Yii::t( 'news', 'Сохранить' ), [ 'class' => 'cabinet__add-company-form--submit' ] ) ?>
<?php ActiveForm::end(); ?>