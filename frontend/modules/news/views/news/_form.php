<?php

use common\models\db\CategoryNews;
use common\models\db\Company;
use common\models\db\Lang;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $form yii\widgets\ActiveForm */


$this->registerCssFile('/css/board.min.css');
$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>


<?php $form = ActiveForm::begin(
    [
        'id' => 'create_news',
        'options' =>
            [
                'class' => 'content-forma',
                'enctype' => 'multipart/form-data',
                'id'=>'add_news_form'
            ],
        'fieldConfig' => [
            'template' => '<div class="form-line">{label}{input}<div class="memo-error"><p>{error}</p></div><div class="memo"><span class="info-icon"></span><span class="triangle-left"></span>{hint}</div></div>',
            'inputOptions' => ['class' => 'input-name jsHint'],
            'labelOptions' => ['class' => 'label-name'],
            'errorOptions' => ['class' => 'error'],

            'options' => ['class' => 'form-line'],
            'hintOptions' => ['class' => ''],

        ],
        'errorCssClass' => 'my-error',
    ]);
?>

    <div class="cabinet__add-company-form--wrapper">

        <?php
        $items = ArrayHelper::map(CategoryNews::find()->where(['lang_id' => 1])->all(), 'id', 'title');
        $param = ['class' => 'input-name jsHint selectCateg', 'prompt' => 'Выберите категорию'];
        echo $form->field($model, 'categoryId[]')
            ->dropDownList($items, $param)
            ->hint('<b>Доступен одновременный выбор не более трех категорий, в которых отобразится опубликованная статья.</b>')
            ->label('Категория<span>*</span>');
        ?>
        <a href="#" style="position: absolute; top: 16px; right: -30px; z-index: 1;"
           class="cabinet__add-pkg addCategAddNewsUser"></a>

        <div class="memo-error errorJS"><p></p>
            <div class="error">Необходимо заполнить «Категория».</div>
            <p></p></div>
    </div>

    <span class="addSelectCateg"></span>


<?= $form->field($model, 'title')
    ->textInput(['maxlength' => true])
    ->hint('<b>Приемлемая длина заголовка – не более 70 символов. Запрещено размещать ссылки на какие-либо ресурсы (сайты, аккаунты и группы в социальных сетях).</b>')
    ->label('Заголовок чтива<span>*</span>'); ?>


<?= $form->field($model, 'company_id')->widget(Select2::className(),
    [
        'data' => \yii\helpers\ArrayHelper::map(Company::find()->with('news')->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Начните вводить компанию ...', 'class' => 'form-control'],
        'pluginOptions' => [
            'allowClear' => true
        ],
        'pluginEvents' => [
            "select2:open" => "function() { $('.memo:eq(2)').show(); }",
            "select2:close" => "function() { $('.memo:eq(2)').hide(); }",
        ],
    ]
)->hint('Предприятие, на странице которого появится опубликованная статья. Если текст имеет нейтральную тематику, тогда нужно оставить поле пустым. ')->label('Относится к компании'); ?>




    <!-- <p class="cabinet__add-company-form--title">Обложка чтива</p>-->
<?php

echo $form->field($model, 'photo')->widget(FileInput::classname(), [
    'options' => ['accept' => 'image/*','class'=>'jsHint'],
])->hint('Разрешение изображения – не менее 800х600 пикселей. Размер – не более двух мегабайт. Формат – jpg
        или png. Стандартное соотношение сторон 3х4. Иллюстрации с нешаблонными пропорциями
        автоматически обрезаются.')->label("Обложка чтива");


//if (empty($model->photo)) {
//    echo $form->field($model, 'photo', [
//        'template' => '<label class="cabinet__add-company-form--add-foto">
//                                    <span class="button"></span>
//                                    {input}
//                                    <img id="blah" src="" alt="" width="160px">
//                                    </label>'
//    ])->label('Обложка чтива')->fileInput();
//} else {
//    echo $form->field($model, 'photo', [
//        'template' => '{label}<div class="selectAvatar">
//                                    <span>Нажмите для выбора</span>
//                                    <img id="blah" src="' . $model->photo . '" alt="" width="160px">
//                                    {input}</div>'
//    ])->label('Обложка чтива')->fileInput();
//}

?>





    <p class="cabinet__add-company-form--title">Текст чтива</p>

<?php echo $form->field($model, 'content')->widget(CKEditor::className(), [

"options"=>["class"=>"jsHint"]])->hint('Размер текста неограничен. Допускается наличие в статье не более трех иллюстраций форматом jpg или png. Материал должен содержать полезную для читателя информацию. Запрещено размещение рекламы и необоснованных ссылок (адреса интернет-ресурсов необходимо прикреплять к тексту публикации при помощи функции редактора, то есть привязывать к отдельным словам или словосочетаниям).')->label(false); ?>

<?= Html::submitButton($model->isNewRecord ? Yii::t('news', 'Create') : Yii::t('news', 'Update'), ['class' => 'cabinet__add-company-form--submit']) ?>
<?php ActiveForm::end(); ?>