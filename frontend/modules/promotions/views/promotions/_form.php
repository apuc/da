<?php

use common\models\db\Stock;
use common\models\db\Lang;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\company\models\Company;
use common\classes\Debug;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */
/* @var $form yii\widgets\ActiveForm */
?>

<?php if ($beforeCreate): ?>
    <?php

    $form = ActiveForm::begin(
        [
            'options' => [
                'class' => 'cabinet__add-company-form',
                'enctype' => 'multipart/form-data',
            ],
        ]);
    ?>

    <?php
    /*
    if($beforeCreate)
    {

        echo Html::dropDownList(
            'Stock[company_id]',
            null,
            ArrayHelper::map(Company::find()->where(['in', 'id', $company_id])->all(),'id','name'),
            ['class'=>'cabinet__add-company-form--field', 'id'=>'promotions', 'prompt' => 'Выберите предприятие']
        );
    }*/

    $company_id = array_keys($beforeCreate);
    ?>


    <p class="cabinet__add-company-form--title">Ваши предприятия</p>
    <?= $form->field($model, 'company_id')->dropDownList(
        ArrayHelper::map(Company::find()->where(['in', 'id', $company_id])->all(), 'id', 'name'),
        ['class' => 'cabinet__add-company-form--field', 'id' => 'promotions', 'prompt' => 'Выберите предприятие'])
        ->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Заголовок акции</p>

    <?= $form->field($model, 'title')->textInput([
        'maxlength' => true,
        'class' => 'cabinet__add-company-form--field',
    ])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Ссылка</p>
    <?= $form->field($model, 'link')->textInput([
        'maxlength' => true,
        'class' => 'cabinet__add-company-form--field',
    ])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Дата акции</p>
    <?= $form->field($model, 'dt_event')->textInput([
        'maxlength' => true,
        'class' => 'cabinet__add-company-form--field',
    ])->label(false) ?>

    <div class="cabinet__add-company-form--block"></div>

    <p class="cabinet__add-company-form--title">Фото акции</p>

    <?php echo $form->field($model, 'photo', [
        'template' => '<label class="cabinet__add-company-form--add-foto">
                                        <span class="button"></span>
                                        {input}
                                        <img id="blah" src="" alt="" width="160px">
                                        </label>',
    ])->label(false)->fileInput();
    ?>

    <!--<label class="cabinet__add-company-form--add-foto">
        <span class="button"></span>
        <input id="news-photo" class="input-file" type="file">
        <img id="blah" src="" alt="" width="160px">
    </label>-->

    <div class="cabinet__add-company-form--block"></div>


    <!--<p class="cabinet__add-company-form--title">Сайт компании</p>

    <input class="cabinet__add-company-form--field" type="text">

    <div class="cabinet__add-company-form--block"></div>-->

    <!-- <p class="cabinet__add-company-form--title">Соц. сети</p>

     <div class="cabinet__add-company-form--social">
         <a href="" class="social-wrap__item vk">
             <img src="img/soc/vk.png" alt="">
         </a>
         <a href="" class="social-wrap__item fb">
             <img src="img/soc/fb.png" alt="">
         </a>
         <a href="" class="social-wrap__item ok">
             <img src="img/soc/ok-icon.png" alt="">
         </a>
         <a href="" class="social-wrap__item vk">
             <img src="img/soc/vk.png" alt="">
         </a>
         <a href="" class="social-wrap__item fb">
             <img src="img/soc/fb.png" alt="">
         </a>
         <a href="" class="social-wrap__item ok">
             <img src="img/soc/ok-icon.png" alt="">
         </a>
     </div>-->


    <!-- <div class="cabinet__add-company-form--wrapper">

         <p class="cabinet__add-company-form--title">Телефон</p>

         <input class="cabinet__add-company-form--field" name="mytext[]" type="text">

     </div>-->
    <div class="cabinet__add-company-form--block"></div>
    <div class="cabinet__add-company-form--hover-wrapper" data-count="1"></div>

    <p class="cabinet__add-company-form--title">Подробное описание</p>
    <textarea id="poster-descr" class="cabinet__add-company-form--text" name="Stock[descr]"
              aria-invalid="false"></textarea>

    <?php /*echo $form->field($model, 'descr')->widget(CKEditor::className(), [
//        'editorOptions' => \mihaildev\elfinder\ElFinder::ckeditorOptions('elfinder', [
//            'preset' => 'full',
//            'inline' => false,
//            'path' => 'frontend/web/media/upload',
//        ]),
])->label(false); */ ?>


    <?= Html::submitButton('Сохранить', ['class' => 'cabinet__add-company-form--submit']) ?>
    <?php ActiveForm::end(); ?>
<?php else: ?>
    <div class="blanket__content">
        <div class="blanket__content__wrap">
            <img src="/theme/portal-donbassa/img/blanket/ban.png" alt="">
            <h2>У Вас нет приедприятий для
                добавления акции</h2>
        </div>
        <a href="<?= \yii\helpers\Url::to(['/company/company/create']) ?>">Добавить предприятие</a>
        <p>После прохождения модерации вашей компании, вы сможете добавить новые акции</p>
    </div>
<?php endif; ?>
