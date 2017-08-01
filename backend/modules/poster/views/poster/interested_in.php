<?php
/**
 * @var $key_val array
 */
use yii\helpers\Html;
$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="interested_in-form">
    <?= Html::beginForm(['/poster/poster/interested-in'], 'post', ['class' => 'form-horizontal']) ?>
    <?= Html::tag('h2', 'Могут заинтересовать: Афиши'); ?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <?php if (!empty($interestedInPosters)) : ?>
            <?php foreach ($interestedInPosters as $key => $interestedInPoster) : ?>
                <div class="panel panel-primary">
                    <div class="panel-heading" role="tab" id="heading<?= $key; ?>">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion"
                               href="#collapse<?= $key; ?>" aria-expanded="true" aria-controls="collapse<?= $key; ?>">
                                <?= $interestedInPoster->title; ?>
                                ( <?= $interestedInPoster->count; ?> )
                            </a>
                        </h4>
                    </div>
                    <div id="collapse<?= $key; ?>" class="panel-collapse collapse" role="tabpanel"
                         aria-labelledby="heading<?= $key; ?>">
                        <div class="panel-body">
                            <?= Html::label('Название категории', null, ['class' => 'control-label']) ?>
                            <?= Html::textInput('interested_in['.$key.'][title]', $interestedInPoster->title, ['class' => 'form-control','required'=>true]); ?>
                            <?= Html::label('Миниатюра категории', null, ['class' => 'control-label']) ?>
                            <?= \mihaildev\elfinder\InputFile::widget([
                                'language' => 'ru',
                                'controller' => 'elfinder',
                                'filter' => 'image',
                                'name' => 'interested_in['.$key.'][thumb]',
                                'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
                                'options' => ['class' => 'form-control itemImg2', 'maxlength' => '255', 'required'=>true],
                                'buttonOptions' => ['class' => 'btn btn-primary'],
                                'value' => $interestedInPoster->thumb,
                                'buttonName' => 'Выбрать изображение',
                                'multiple' => false,
                            ]);
                            ?>
                            <?= Html::label('Афиши', null, ['class' => 'control-label']) ?>
                            <?= \kartik\select2\Select2::widget([
                                'name' => 'interested_in['.$key.'][posters]',
                                'data' => $postersList,
                                'value' => $interestedInPoster->posters,
                                'options' => ['multiple' => true, 'prompt' => 'Выбрать', 'required'=>true],
                            ]);
                            ?>
                        </div>
                        <div class="panel-footer">
                            <?= Html::button('Удалить', ['class' => 'btn btn-danger js-interested-in-delete']); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?= Html::tag('h3', 'Добавить новую категорию'); ?>
    <?= Html::label('Название категории', null, ['class' => 'control-label']) ?>
    <?= Html::textInput('interested_in['.count($interestedInPosters).'][title]', '', ['class' => 'form-control']); ?>
    <?= Html::label('Миниатюра категории', null, ['class' => 'control-label']) ?>
    <?= \mihaildev\elfinder\InputFile::widget([
        'language' => 'ru',
        'controller' => 'elfinder',
        'filter' => 'image',
        'name' => 'interested_in['.count($interestedInPosters).'][thumb]',
        'template' => '<div class="input-group">{input}<span class="span-btn">{button}</span></div>',
        'options' => ['class' => 'form-control itemImg2', 'maxlength' => '255'],
        'buttonOptions' => ['class' => 'btn btn-primary'],
        'value' => '',
        'buttonName' => 'Выбрать изображение',
        'multiple' => false,
    ]);
    ?>
    <?= Html::label('Афиши категории', null, ['class' => 'control-label']) ?>
    <?= \kartik\select2\Select2::widget([
        'name' => 'interested_in['.count($interestedInPosters).'][posters]',
        'data' => $postersList,
        'value' => '',
        'options' => ['multiple' => true, 'prompt' => 'Выбрать'],
    ]);
    ?>
    <br>
    <?php echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    <?php echo Html::endForm() ?>
</div>