<?php
/**
 * @var $key_val array
 */
$this->title = 'Настройка заголовков для сайта';

use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/seo/default'], 'post', ['class' => 'form-horizontal']) ?>

<div>
    <h3>Главная:</h3>
    <?php echo Html::label('meta title', 'main_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('main_page_meta_title', $key_val['main_page_meta_title'], ['class' => 'form-control', 'id' => 'main_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'main_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('main_page_meta_descr', $key_val['main_page_meta_descr'], ['class' => 'form-control', 'id' => 'main_page_meta_descr']) ?>
    <br>
</div>
<div>
    <h3>Новости:</h3>
    <?php echo Html::label('meta title', 'news_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('news_page_meta_title', $key_val['news_page_meta_title'], ['class' => 'form-control', 'id' => 'news_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'news_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('news_page_meta_descr', $key_val['news_page_meta_descr'], ['class' => 'form-control', 'id' => 'news_page_meta_descr']) ?>
    <br>
</div>
<div>
    <h3>Компании:</h3>
    <?php echo Html::label('meta title', 'company_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('company_page_meta_title', $key_val['company_page_meta_title'], ['class' => 'form-control', 'id' => 'company_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'company_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('company_page_meta_descr', $key_val['company_page_meta_descr'], ['class' => 'form-control', 'id' => 'company_page_meta_descr']) ?>
    <br>
</div>
<div>
    <h3>Афиша:</h3>
    <?php echo Html::label('meta title', 'poster_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('poster_page_meta_title', $key_val['poster_page_meta_title'], ['class' => 'form-control', 'id' => 'poster_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'poster_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('poster_page_meta_descr', $key_val['poster_page_meta_descr'], ['class' => 'form-control', 'id' => 'poster_page_meta_descr']) ?>
    <br>
</div>
<div>
    <h3>Консалтинг:</h3>
    <?php echo Html::label('meta title', 'consulting_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('consulting_page_meta_title', $key_val['consulting_page_meta_title'], ['class' => 'form-control', 'id' => 'consulting_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'consulting_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('consulting_page_meta_descr', $key_val['consulting_page_meta_descr'], ['class' => 'form-control', 'id' => 'consulting_page_meta_descr']) ?>
    <br>
</div>
<div>
    <h3>В соцсетях:</h3>
    <?php echo Html::label('meta title', 'stream_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('stream_title_page', $key_val['stream_title_page'], ['class' => 'form-control', 'id' => 'stream_title_page']) ?>
    <?php echo Html::label('meta desc', 'stream_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('stream_desc_page', $key_val['stream_desc_page'], ['class' => 'form-control', 'id' => 'stream_desc_page']) ?>
    <br>
</div>

<div>
    <h3>Объявления:</h3>
    <?php echo Html::label('meta title', 'board_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('board_title_page', $key_val['board_title_page'], ['class' => 'form-control', 'id' => 'board_title_page']) ?>
    <?php echo Html::label('meta desc', 'board_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('board_desc_page', $key_val['board_desc_page'], ['class' => 'form-control', 'id' => 'board_desc_page']) ?>
    <br>
</div>
<div>
    <h3>Страница ДНР:</h3>
    <?php echo Html::label('meta title', 'dnr_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('dnr_title_page', $key_val['dnr_title_page'], ['class' => 'form-control', 'id' => 'board_title_page']) ?>
    <?php echo Html::label('meta desc', 'dnr_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('dnr_desc_page', $key_val['dnr_desc_page'], ['class' => 'form-control', 'id' => 'board_desc_page']) ?>
    <br>
</div>
<div>
    <h3>Валюты:</h3>
    <?php echo Html::label('meta title', 'currency_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_title_page', $key_val['currency_title_page'], ['class' => 'form-control', 'id' => 'currency_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_desc_page', $key_val['currency_desc_page'], ['class' => 'form-control', 'id' => 'currency_desc_page']) ?>
    <br>
</div>
<div>
    <h3>Криптовалюты:</h3>
    <?php echo Html::label('meta title', 'currency_coin_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_coin_title_page', $key_val['currency_coin_title_page'], ['class' => 'form-control', 'id' => 'currency_coin_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_coin_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_coin_desc_page', $key_val['currency_coin_desc_page'], ['class' => 'form-control', 'id' => 'currency_coin_desc_page']) ?>
    <br>
</div>
<div>
    <h3>Драгметаллы:</h3>
    <?php echo Html::label('meta title', 'currency_metal_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_metal_title_page', $key_val['currency_metal_title_page'], ['class' => 'form-control', 'id' => 'currency_metal_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_metal_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_metal_desc_page', $key_val['currency_metal_desc_page'], ['class' => 'form-control', 'id' => 'currency_metal_desc_page']) ?>
    <br>
</div>
<div>
    <h3>Конвертер валют:</h3>
    <?php echo Html::label('meta title', 'currency_converter_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_converter_title_page', $key_val['currency_converter_title_page'], ['class' => 'form-control', 'id' => 'currency_converter_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_converter_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_converter_desc_page', $key_val['currency_converter_desc_page'], ['class' => 'form-control', 'id' => 'currency_converter_desc_page']) ?>
    <br>
</div>
<div>
    <h3>Валютный рынок:</h3>
    <?php echo Html::label('meta title', 'currency_title_all', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_title_all', $key_val['currency_title_all'], ['class' => 'form-control', 'id' => 'currency_title_all']) ?>
    <?php echo Html::label('meta desc', 'currency_desc_all', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_desc_all', $key_val['currency_desc_all'], ['class' => 'form-control', 'id' => 'currency_desc_all']) ?>
    <br>
</div>
<div>
    <h3>Нефтяные фьючерсы:</h3>
    <?php echo Html::label('meta title', 'currency_petroleum_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_petroleum_title_page', $key_val['currency_petroleum_title_page'], ['class' => 'form-control', 'id' => 'currency_petroleum_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_petroleum_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_petroleum_desc_page', $key_val['currency_petroleum_desc_page'], ['class' => 'form-control', 'id' => 'currency_petroleum_desc_page']) ?>
    <br>
</div>
<br>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>
