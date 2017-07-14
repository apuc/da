<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;

?>
<div class="main_poster-form container">
    <?php echo Html::beginForm(['/poster/poster/main-premiere'], 'post', ['class' => 'form-horizontal']) ?>

    <?php echo Html::label('Главая: Премьера', 'main_poster', ['class' => 'control-label']) ?>

    <div class="imgUpload">
        <div class="media__upload_img">
            <?php if (!empty($main_posters->main_posters)):
                $photos = explode(',', $main_posters->main_posters);
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
            'name' => 'poster_images[]',
            'id' => 'gist1',
            'template' => '<div class="input-group form-group">{input}<span class="span-btn">{button}</span></div>',
            'options' => ['class' => 'form-control itemImg2', 'maxlength' => '255'],
            'buttonOptions' => ['class' => 'btn btn-primary'],
            'value' => $main_posters->main_posters,
            'buttonName' => 'Выбрать изображение',
            'multiple' => true,
        ]);
        ?>
    </div>
    <?php echo Html::label('Описание', 'main_poster', ['class' => 'control-label']) ?>
    <?= Html::textarea('description', $main_posters->description, ['class' => 'form-control']); ?>
    <br>

    <?php echo Html::label('Выберите афишу', 'main_poster', ['class' => 'control-label']) ?>
    <?php
        echo \kartik\select2\Select2::widget(
            [
                'name' => 'afisha_id',
                'value' => $main_posters->afisha_id,
                'data' => \yii\helpers\ArrayHelper::map(\common\models\db\Poster::find()->all(), 'id', 'title'),
                'options' => ['placeholder' => 'Выберите афишу'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ])
    ?>
    <br>
    <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php echo Html::endForm() ?>
</div>