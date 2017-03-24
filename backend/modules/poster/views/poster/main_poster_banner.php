<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>
<div class="main_poster-form container">
    <?php echo Html::beginForm(['/poster/poster/main-poster'], 'post', ['class' => 'form-horizontal']) ?>

    <?php echo Html::label('Баннер: Афиша', 'main_poster', ['class' => 'control-label']) ?>

    <div class="imgUpload">
        <div class="media__upload_img">
            <?php if (!empty($mainBannerPoster->poster_image)): ?>
                <img src="<?= $mainBannerPoster->poster_image; ?>" width="100px">
            <?php else: ?>
                <img src="" width="100px">
            <?php endif; ?>
        </div>
        <?php
        echo \mihaildev\elfinder\InputFile::widget([
            'language' => 'ru',
            'controller' => 'elfinder',
            // вставляем название контроллера, по умолчанию равен elfinder
            'filter' => 'image',
            // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-con..
            'name' => 'poster_image',
            'id' => 'gist1',
            'template' => '<div class="input-group form-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg2', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $mainBannerPoster->poster_image,
            'buttonName' => 'Выбрать изображение',
            'multiple' => false,
        ]);
        ?>
    </div>
    <?php echo Html::label('Заголовок', 'main_poster_title', ['class' => 'control-label']) ?>
    <?= Html::textInput('main_poster_title', $mainBannerPoster->main_poster_title, ['class' => 'form-control']); ?>
    <?php echo Html::label('Подзаголовок', 'main_poster_subtitle', ['class' => 'control-label']) ?>
    <?= Html::textInput('main_poster_subtitle', $mainBannerPoster->main_poster_subtitle, ['class' => 'form-control']); ?>
    <?php echo Html::label('Подложка', 'main_poster_substrate', ['class' => 'control-label']) ?>
    <?= Html::textInput('main_poster_substrate', $mainBannerPoster->main_poster_substrate, ['class' => 'form-control']); ?>
    <br>
    <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php echo Html::endForm() ?>
</div>