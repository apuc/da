<?php
/**
 * @var $key_val array
 */
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;
?>

<?php echo Html::beginForm(['/rossopt/default'],'post',['class' => 'form-horizontal']) ?>
<?php echo Html::label('meta-title','meta-title', ['class'=>'control-label']) ?>
<?php echo Html::textInput('meta-title', $key_val['meta-title'],['class' => 'form-control', 'id'=>'meta-title']) ?>
<?php echo Html::label('meta-descr','meta-descr', ['class'=>'control-label']) ?>
<?php echo Html::textInput('meta-descr', $key_val['meta-descr'],['class' => 'form-control', 'id'=>'meta-descr']) ?>
<?php //echo Html::label('Логотип','logo', ['class'=>'control-label']) ?>
<?php //echo Html::textInput('logo', $key_val['logo'],['class' => 'form-control', 'id'=>'logo']) ?>
<div class="imgUpload">
    <div class="media__upload_img"><img src="<?= $key_val['logo']; ?>" width="100px"/></div>
    <?php
    echo InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
        'name' => 'logo',
        'id' => 'logo',
        'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => $key_val['logo'],
        'buttonName' => 'Выбрать изображение',
    ]);
    ?>
</div>
<?php echo Html::label('Логотип текст','logo-text', ['class'=>'control-label']) ?>
<?php echo Html::textInput('logo-text', $key_val['logo-text'],['class' => 'form-control', 'id'=>'logo-text']) ?>
<?php echo Html::label('E-mail','mail', ['class'=>'control-label']) ?>
<?php echo Html::textInput('mail', $key_val['mail'],['class' => 'form-control', 'id'=>'mail']) ?>
<?php echo Html::label('Номера телефонов','phones', ['class'=>'control-label']) ?>
<?php echo Html::textInput('phones', $key_val['phones'],['class' => 'form-control', 'id'=>'phones']) ?>
<?php //echo Html::label('Верхний баннер','header-banner', ['class'=>'control-label']) ?>
<?php //echo Html::textInput('header-banner', $key_val['header-banner'],['class' => 'form-control', 'id'=>'header-banner']) ?>
<div class="imgUpload">
    <div class="media__upload_img"><img src="<?= $key_val['header-banner']; ?>" width="100px"/></div>
    <?php
    echo InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image', // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
        'name' => 'header-banner',
        'id' => 'header-banner',
        'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => $key_val['header-banner'],
        'buttonName' => 'Выбрать изображение',
    ]);
    ?>
</div>

<br>
<?php echo Html::submitButton('Сохранить', ['class'=>'btn btn-success']) ?>
<?php echo Html::endForm() ?>
