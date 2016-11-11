<?php use common\classes\WordFunctions;
use yii\helpers\Url;?>
<div class="faq-item">
    <span class="date"><?=

        date( 'd.m.y', $model['dt_add'] ); ?></span>
    <p class="quastion">
        <?= $model['title']; ?>
    </p>
    <p class="answer">
        <?= WordFunctions::crop_str_word(strip_tags($model['content'])); ?>
    </p>
    <a href="<?= Url::to( [ '/consulting/consulting/documentsv', 'slug' => $model['type'],'postslug' => $model['slug'] ] ); ?>"
       class="read-answer">Читать статью</a>
</div>