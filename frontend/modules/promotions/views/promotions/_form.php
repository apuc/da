<?php

use kartik\datetime\DateTimePicker;
use kartik\file\FileInput;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use frontend\modules\company\models\Company;
use \mihaildev\elfinder\ElFinder;

/* @var $this yii\web\View */
/* @var $model frontend\modules\promotions\models\Stock */
/* @var $form yii\widgets\ActiveForm */
/* @var $beforeCreate array */

$this->registerCssFile('/css/board.min.css');
//$this->registerJsFile('/js/board.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/board.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="right">
    <?php if ($beforeCreate): ?>

        <?php $form = ActiveForm::begin([
            'id' => 'add_ads',
            'options' =>
                [
                    'enctype' => 'multipart/form-data',
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

        ]); ?>
        <div class="content-forma">
            <?php $company_id = array_keys($beforeCreate); ?>

            <?= $form->field($model, 'company_id')->widget(Select2::className(), [
                'attribute' => 'state_2',
                'data' => ArrayHelper::map(Company::find()->where(['in', 'id', $company_id])->all(), 'id', 'name'),
                'options' => ['placeholder' => 'Выбери компанию...'],
                'pluginOptions' => [
                    'allowClear' => true,
                ],
                'pluginEvents' => [
                    "select2:open" => "function() { $('.memo:first').show(); }",
                    "select2:close" => "function() { $('.memo:first').hide(); }",
                ],
            ])->hint('Компания, которая планирует проводить акцию.');
            ?>

            <?= $form->field($model, 'title')->textInput(['maxlength' => 70])
                ->hint('Название предложения, которое будет отображено в списке акций компании. В заголовке запрещено размещать контактную информацию, а также использовать заглавные буквы (кроме аббревиатур).')
                ->label('Заголовок:'); ?>

            <?= $form->field($model, 'link')->textInput()
                ->hint('Ссылка на внешние ресурсы компании, включая страницы в социальных сетях.')
                ->label('Ссылка:'); ?>

            <?= $form->field($model, 'dt_event')->widget(DateTimePicker::class, [
                'options' => ['placeholder' => 'Выбери дату начала акции...','class'=>'jsHint'],

                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ],
                'pluginEvents' => [
                    "show" => "function(e) { $(this).parent().find('.memo').show();  }",
                    "hide" => "function(e) { $(this).parent().find('.memo').hide();  }",
                ]
            ])->hint("Дата и время старта акции."); ?>

            <?= $form->field($model, 'dt_event_end')->widget(DateTimePicker::class, [
                'options' => ['placeholder' => 'Выбери дату окончания акции...','class'=>'jsHint'],

                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ],
                'pluginEvents' => [
                    "show" => "function(e) { $(this).parent().find('.memo').show();  }",
                    "hide" => "function(e) { $(this).parent().find('.memo').hide();  }",
                ]
            ])->hint("Дата и время окончания акции."); ?>

            <?= $form->field($model, 'dt_event_description')->textInput()
                ->hint('Условия преждевременного окончания акции.')
                ->label('Особые условия:'); ?>

            <?php

            echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                "name"=>'Stock','options' => ['accept' => 'image/*','class'=>'jsHint'],
            ])->hint('Разрешение изображения – не менее 800х600 пикселей. Размер – не более двух мегабайт. Формат – jpg
        или png. Стандартное соотношение сторон 3х4. Иллюстрации с нешаблонными пропорциями
        автоматически обрезаются.')->label("Иллюстрация:");
            ?>

            <p class="file-hint">
                Как правильно подобрать иллюстрацию?
                <a target="_blank" href="http://da-info.pro/page/kak-pravilno-podobrat-izobrazenie-dla-stati-na-sajte-da-info-pro">Читать.</a>
            </p>

<!--            <div class="cabinet__add-company-form--block"></div>-->
<!--            <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>-->

            <div style="float: none; clear: both; width: 525px" class="field-stock-descr">
                <p class="text-editor-label">Подробное описание</p>
                <?php echo $form->field($model, 'descr')->widget(CKEditor::className(), [

                    "options"=>["class"=>"jsHint"]])->hint("Подробное описание деталей и достоинств акции с указанием дополнительных программ лояльности, если такие
предусмотрены.")->label(false) ?>
            </div>
        </div>


        <div class="content-forma">
            <?= Html::submitButton('Добавить акцию',
                ['class' => 'cabinet__add-company-form--submit place-ad_publish publish place-ad__publish', 'id' => 'saveInfo']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    <?php else: ?>
        <div class="blanket__content">
            <div class="blanket__content__wrap">
                <img src="/theme/portal-donbassa/img/blanket/ban.png" alt="">
                <h2>У Вас нет приедприятий для
                    добавления акции или Вы исчермали лимит акций</h2>
            </div>
            <a href="<?= Url::to(['/company/company/create']) ?>">Добавить предприятие</a>
            <p>После прохождения модерации вашей компании, вы сможете добавить новые акции</p>
        </div>
    <?php endif; ?>
</div>
