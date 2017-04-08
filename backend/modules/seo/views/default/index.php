<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>

<?php echo Html::beginForm(['/seo/default'],'post',['class' => 'form-horizontal']) ?>

<?php echo Html::label('Главая: meta title','main_page_meta_title', ['class'=>'control-label']) ?>
<?php echo Html::textInput('main_page_meta_title', $key_val['main_page_meta_title'],['class' => 'form-control', 'id'=>'main_page_meta_title']) ?>
<?php echo Html::label('Главая: meta descr','main_page_meta_descr', ['class'=>'control-label']) ?>
<?php echo Html::textInput('main_page_meta_descr', $key_val['main_page_meta_descr'],['class' => 'form-control', 'id'=>'main_page_meta_descr']) ?>

<?php echo Html::label('Новости: meta title','news_page_meta_title', ['class'=>'control-label']) ?>
<?php echo Html::textInput('news_page_meta_title', $key_val['news_page_meta_title'],['class' => 'form-control', 'id'=>'news_page_meta_title']) ?>
<?php echo Html::label('Новости: meta descr','news_page_meta_descr', ['class'=>'control-label']) ?>
<?php echo Html::textInput('news_page_meta_descr', $key_val['news_page_meta_descr'],['class' => 'form-control', 'id'=>'news_page_meta_descr']) ?>

<?php echo Html::label('Компании: meta title','company_page_meta_title', ['class'=>'control-label']) ?>
<?php echo Html::textInput('company_page_meta_title', $key_val['company_page_meta_title'],['class' => 'form-control', 'id'=>'company_page_meta_title']) ?>
<?php echo Html::label('Компании: meta descr','company_page_meta_descr', ['class'=>'control-label']) ?>
<?php echo Html::textInput('company_page_meta_descr', $key_val['company_page_meta_descr'],['class' => 'form-control', 'id'=>'company_page_meta_descr']) ?>

<?php echo Html::label('Афиша: meta title','poster_page_meta_title', ['class'=>'control-label']) ?>
<?php echo Html::textInput('poster_page_meta_title', $key_val['poster_page_meta_title'],['class' => 'form-control', 'id'=>'poster_page_meta_title']) ?>
<?php echo Html::label('Афиша: meta descr','poster_page_meta_descr', ['class'=>'control-label']) ?>
<?php echo Html::textInput('poster_page_meta_descr', $key_val['poster_page_meta_descr'],['class' => 'form-control', 'id'=>'poster_page_meta_descr']) ?>

<?php echo Html::label('Консалтинг: meta title','consulting_page_meta_title', ['class'=>'control-label']) ?>
<?php echo Html::textInput('consulting_page_meta_title', $key_val['consulting_page_meta_title'],['class' => 'form-control', 'id'=>'consulting_page_meta_title']) ?>
<?php echo Html::label('Консалтинг: meta descr','consulting_page_meta_descr', ['class'=>'control-label']) ?>
<?php echo Html::textInput('consulting_page_meta_descr', $key_val['consulting_page_meta_descr'],['class' => 'form-control', 'id'=>'consulting_page_meta_descr']) ?>

<br>
<?php echo Html::submitButton('Сохранить', ['class'=>'btn btn-success']) ?>
<?php echo Html::endForm() ?>
