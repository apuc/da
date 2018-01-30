<?php
/**
 * @var $services array
 * @var $model \common\models\db\Company
 * @var $img \common\models\db\CompanyPhoto
 */

use yii\helpers\StringHelper;

?>
<div id="about-company" class="business__tab-content--wrapper">
    <?php if (!empty($img)): ?>
        <div class="business__photos">
            <?php foreach ($img as $item): ?>
                <a href="<?= $item->photo ?>" data-fancybox="gallery"
                   class="business__photos--slide">
                    <img src="<?= $item->photo ?>" alt="">
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <div class="business__descr">
        <?php if (isset($services['count_text']) && $services['count_text'] != '-'): ?>
            <?= StringHelper::truncate($model->descr, $services['count_text']); ?>
        <?php else: ?>
            <?= $model->descr; ?>
        <?php endif; ?>
    </div>
</div>
