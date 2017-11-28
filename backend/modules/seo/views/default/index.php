<?php
/**
 * @var $key_val array
 */
$this->title = 'Настройка заголовков для сайта';

use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/seo/default'], 'post', ['class' => 'form-horizontal']) ?>

<div>
    <b>Главная:</b><br>
    <?php echo Html::label('meta title', 'main_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('main_page_meta_title', $key_val['main_page_meta_title'], ['class' => 'form-control', 'id' => 'main_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'main_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('main_page_meta_descr', $key_val['main_page_meta_descr'], ['class' => 'form-control', 'id' => 'main_page_meta_descr']) ?>
    <br>
</div>
<div>
    <b>Новости:</b><br>
    <?php echo Html::label('meta title', 'news_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('news_page_meta_title', $key_val['news_page_meta_title'], ['class' => 'form-control', 'id' => 'news_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'news_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('news_page_meta_descr', $key_val['news_page_meta_descr'], ['class' => 'form-control', 'id' => 'news_page_meta_descr']) ?>
    <br>
</div>
<div>
    <b>Компании:</b><br>
    <?php echo Html::label('meta title', 'company_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('company_page_meta_title', $key_val['company_page_meta_title'], ['class' => 'form-control', 'id' => 'company_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'company_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('company_page_meta_descr', $key_val['company_page_meta_descr'], ['class' => 'form-control', 'id' => 'company_page_meta_descr']) ?>
    <br>
</div>
<div>
    <b>Афиша:</b><br>
    <?php echo Html::label('meta title', 'poster_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('poster_page_meta_title', $key_val['poster_page_meta_title'], ['class' => 'form-control', 'id' => 'poster_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'poster_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('poster_page_meta_descr', $key_val['poster_page_meta_descr'], ['class' => 'form-control', 'id' => 'poster_page_meta_descr']) ?>
    <br>
</div>
<div>
    <b>Консалтинг:</b><br>
    <?php echo Html::label('meta title', 'consulting_page_meta_title', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('consulting_page_meta_title', $key_val['consulting_page_meta_title'], ['class' => 'form-control', 'id' => 'consulting_page_meta_title']) ?>
    <?php echo Html::label('meta descr', 'consulting_page_meta_descr', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('consulting_page_meta_descr', $key_val['consulting_page_meta_descr'], ['class' => 'form-control', 'id' => 'consulting_page_meta_descr']) ?>
    <br>
</div>
<div>
    <b>В соцсетях:</b><br>
    <?php echo Html::label('meta title', 'stream_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('stream_title_page', $key_val['stream_title_page'], ['class' => 'form-control', 'id' => 'stream_title_page']) ?>
    <?php echo Html::label('meta desc', 'stream_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('stream_desc_page', $key_val['stream_desc_page'], ['class' => 'form-control', 'id' => 'stream_desc_page']) ?>
    <br>
</div>

<div>
    <b>Объявления:</b><br>
    <?php echo Html::label('meta title', 'board_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('board_title_page', $key_val['board_title_page'], ['class' => 'form-control', 'id' => 'board_title_page']) ?>
    <?php echo Html::label('meta desc', 'board_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('board_desc_page', $key_val['board_desc_page'], ['class' => 'form-control', 'id' => 'board_desc_page']) ?>
    <br>
</div>
<div>
    <b>Валюты:</b><br>
    <?php echo Html::label('meta title', 'currency_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_title_page', $key_val['currency_title_page'], ['class' => 'form-control', 'id' => 'currency_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_desc_page', $key_val['currency_desc_page'], ['class' => 'form-control', 'id' => 'currency_desc_page']) ?>
    <br>
</div>
<div>
    <b>Криптовалюты:</b><br>
    <?php echo Html::label('meta title', 'currency_coin_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_coin_title_page', $key_val['currency_coin_title_page'], ['class' => 'form-control', 'id' => 'currency_coin_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_coin_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_coin_desc_page', $key_val['currency_coin_desc_page'], ['class' => 'form-control', 'id' => 'currency_coin_desc_page']) ?>
    <br>
</div>
<div>
    <b>Драгметаллы:</b><br>
    <?php echo Html::label('meta title', 'currency_metal_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_metal_title_page', $key_val['currency_metal_title_page'], ['class' => 'form-control', 'id' => 'currency_metal_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_metal_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_metal_desc_page', $key_val['currency_metal_desc_page'], ['class' => 'form-control', 'id' => 'currency_metal_desc_page']) ?>
    <br>
</div>
<div>
    <b>Конвертер валют:</b><br>
    <?php echo Html::label('meta title', 'currency_converter_title_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_converter_title_page', $key_val['currency_converter_title_page'], ['class' => 'form-control', 'id' => 'currency_converter_title_page']) ?>
    <?php echo Html::label('meta desc', 'currency_converter_desc_page', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_converter_desc_page', $key_val['currency_converter_desc_page'], ['class' => 'form-control', 'id' => 'currency_converter_desc_page']) ?>
    <br>
</div>
<div>
    <b>Валютный рынок:</b><br>
    <?php echo Html::label('meta title', 'currency_title_all', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_title_all', $key_val['currency_title_all'], ['class' => 'form-control', 'id' => 'currency_title_all']) ?>
    <?php echo Html::label('meta desc', 'currency_desc_all', ['class' => 'control-label']) ?>
    <?php echo Html::textInput('currency_desc_all', $key_val['currency_desc_all'], ['class' => 'form-control', 'id' => 'currency_desc_all']) ?>
    <br>
</div>
<br>
<?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?php echo Html::endForm() ?>
