<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;
?>

<?php echo Html::beginForm(['/mainpage/mainpage/photos'], 'post', ['class' => 'form-horizontal']) ?>

<?php echo Html::label('Главая: Фотографии', 'main_photos', ['class' => 'control-label']) ?>

<?= Html::textInput('title', $mainPhotos->title, ['class' => 'form-control']); ?>

<?= Html::textarea('description', $mainPhotos->description, ['class' => 'form-control']); ?>

<div class="imgUpload container">
    <div class="media__upload_img">
        <?php if (!empty($mainPhotos->photos_images[0])):
            $photos = explode(',', $mainPhotos->photos_images[0]);

            ?>
            <?php foreach ($photos as $photo):

            ?>
            <img src="<?= $photo; ?>" width="100px">
        <?php endforeach; ?>
        <?php else:
            $photos = [];
            ?>

            <img src="" width="100px">
        <?php endif; ?>
    </div>
    <?php
    $img_array = [];
    echo \mihaildev\elfinder\InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder',
        // вставляем название контроллера, по умолчанию равен elfinder
        'filter' => 'image',
        // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
        'name' => 'photos_images[]',
        'id' => 'photos_images',
        'template' => '<div class="input-group form-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg2', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => $mainPhotos->photos_images[0],
        'buttonName' => 'Выбрать изображение',
        'multiple' => true,
    ]);
    ?>
    <br>
    <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php echo Html::endForm() ?>
