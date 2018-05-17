<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 16:57
 * @var $photo
 */

use kartik\select2\Select2;
use mihaildev\elfinder\InputFile;
use yii\helpers\Html;

$this->title = 'Баннер';
?>


<h2><?= $this->title; ?></h2>

<?= Html::beginForm('', 'post') ?>
<div class="imgUpload">
    <div class="media__upload_img">
        <?php if (!$model->isNewRecord): ?>
                <img src="<?= $photo ?>" alt="" width="100px">
        <?php endif; ?>
    </div>
    <?php
    echo InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder',
        // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',
        // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
        'name' => 'photo',
        'id' => 'photo',
        'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => $photo,
        'buttonName' => 'Выбрать',
    ]);
    ?>
</div>
<br>
<?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
<?= Html::endForm() ?>
