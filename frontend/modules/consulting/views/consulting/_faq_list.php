<?php use common\classes\WordFunctions;
use yii\helpers\Url;
?>
<div class="faq-item">
    <span class="date"><?=

        date( 'd.m.y', $model['dt_add'] ); ?></span>
    <p class="quastion">
        <?= $model['question']; ?>
    </p>
<!--    <p class="answer">-->
<!--        --><?//= WordFunctions::crop_str_word(strip_tags($model['answer'])); ?>
<!--    </p>-->
    <a href="<?= Url::to( [ '/consulting/consulting/faqv', 'slug' => $model['type'],'faqslug' => $model['slug'] ] ); ?>"
       class="read-answer">Читать ответ</a>
    <span class="consult-views-list"><i class="views-ico fa fa-eye"></i><?= $model['views'];?></span>
</div>