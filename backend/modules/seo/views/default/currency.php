<?php
/**
 * @var $key_val array
 */
$this->title = 'Настройка заголовков для сайта';

use backend\modules\key_value\models\KeyValue;
use common\classes\Debug;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php echo Html::beginForm(['/seo/default/currency'], 'post', ['class' => 'form-horizontal']) ?>

<div class="row">
    <div class="col-md-4">
        <h2>Заголовки страниц</h2>
        <div>
            <h3>Валюты:</h3>
            <?php echo Html::label('meta title', 'currency_title_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_title_page', $key_val['currency_title_page'], ['class' => 'form-control', 'id' => 'currency_title_page']) ?>
            <?php echo Html::label('meta desc', 'currency_desc_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_desc_page', $key_val['currency_desc_page'], ['class' => 'form-control', 'id' => 'currency_desc_page']) ?>
            <br/>
        </div>
        <div>
            <h3>Криптовалюты:</h3>
            <?php echo Html::label('meta title', 'currency_coin_title_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_coin_title_page', $key_val['currency_coin_title_page'], ['class' => 'form-control', 'id' => 'currency_coin_title_page']) ?>
            <?php echo Html::label('meta desc', 'currency_coin_desc_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_coin_desc_page', $key_val['currency_coin_desc_page'], ['class' => 'form-control', 'id' => 'currency_coin_desc_page']) ?>
            <br/>
        </div>
        <div>
            <h3>Драгметаллы:</h3>
            <?php echo Html::label('meta title', 'currency_metal_title_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_metal_title_page', $key_val['currency_metal_title_page'], ['class' => 'form-control', 'id' => 'currency_metal_title_page']) ?>
            <?php echo Html::label('meta desc', 'currency_metal_desc_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_metal_desc_page', $key_val['currency_metal_desc_page'], ['class' => 'form-control', 'id' => 'currency_metal_desc_page']) ?>
            <br/>
        </div>
        <div>
            <h3>Конвертер валют:</h3>
            <?php echo Html::label('meta title', 'currency_converter_title_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_converter_title_page', $key_val['currency_converter_title_page'], ['class' => 'form-control', 'id' => 'currency_converter_title_page']) ?>
            <?php echo Html::label('meta desc', 'currency_converter_desc_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_converter_desc_page', $key_val['currency_converter_desc_page'], ['class' => 'form-control', 'id' => 'currency_converter_desc_page']) ?>
            <br/>
        </div>
        <div>
            <h3>Валютный рынок:</h3>
            <?php echo Html::label('meta title', 'currency_title_all', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_title_all', $key_val['currency_title_all'], ['class' => 'form-control', 'id' => 'currency_title_all']) ?>
            <?php echo Html::label('meta desc', 'currency_desc_all', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_desc_all', $key_val['currency_desc_all'], ['class' => 'form-control', 'id' => 'currency_desc_all']) ?>
            <br/>
        </div>
        <div>
            <h3>Нефтяные фьючерсы:</h3>
            <?php echo Html::label('meta title', 'currency_petroleum_title_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_petroleum_title_page', $key_val['currency_petroleum_title_page'], ['class' => 'form-control', 'id' => 'currency_petroleum_title_page']) ?>
            <?php echo Html::label('meta desc', 'currency_petroleum_desc_page', ['class' => 'control-label']) ?>
            <?php echo Html::textInput('currency_petroleum_desc_page', $key_val['currency_petroleum_desc_page'], ['class' => 'form-control', 'id' => 'currency_petroleum_desc_page']) ?>
            <br/>
        </div>
    </div>
    <div class="col-md-8">
        <h2>Описание внизу страниц</h2>
        <div>
            <h3>Валюты:</h3>
            <?= Html::label('Описание') ?>
            <?= Html::textarea('currency_bottom_description', $key_val['currency_bottom_description'],
                [
                    'class' => 'form-control',
                    'id' => 'currency_bottom_description',
                    'rows' => 8
                ]) ?>
            <br/>
        </div>
        <div>
            <h3>Криптовалюты:</h3>
            <?= Html::label('Описание') ?>
            <?= Html::textarea('currency_coin_bottom_description', $key_val['currency_coin_bottom_description'],
                [
                    'class' => 'form-control',
                    'id' => 'currency_coin_bottom_description',
                    'rows' => 8
                ]) ?>
            <br/>
        </div>
        <div>
            <h3>Металлы:</h3>
            <?= Html::label('Описание') ?>
            <?= Html::textarea('currency_metal_bottom_description', $key_val['currency_metal_bottom_description'],
                [
                    'class' => 'form-control',
                    'id' => 'currency_metal_bottom_description',
                    'rows' => 8
                ]); ?>
            <br/>
        </div>
        <div>
            <h3>ГСМ:</h3>
            <?= Html::label('Описание') ?>
            <?= Html::textarea('currency_gsm_bottom_description', $key_val['currency_gsm_bottom_description'],
                [
                    'class' => 'form-control',
                    'id' => 'currency_gsm_bottom_description',
                    'rows' => 8
                ]); ?>
            <br/>
        </div>
        <div>
            <h3>Конвертер:</h3>
            <?= Html::label('Описание') ?>
            <?= Html::textarea('currency_converter_bottom_description', $key_val['currency_converter_bottom_description'],
                [
                    'class' => 'form-control',
                    'id' => 'currency_converter_bottom_description',
                    'rows' => 8
                ]) ?>
            <br/>
        </div>
    </div>
</div>
<br/>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>


