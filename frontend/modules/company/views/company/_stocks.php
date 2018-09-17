<?php
/**
 * @var $stock \common\models\db\Stock
 */

use yii\helpers\Url;

?>
<div class="business__tab-content--wrapper" id="stocks">
    <h3 class="section-title">Наши акции</h3>
    <div class="business__stocks--box">
        <?php if (!empty($stock)): ?>
            <?php foreach ($stock as $item): ?>
                <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>">
                    <div class="stock__sm-item">
                        <div class="stock__sm-item--img">
                            <img src="<?= $item->photo ?>" alt="">
                        </div>
                        <div class="stock__sm-item--descr">
                            <span class="views"><?= $item->view ?> просмотров</span>
                            <p><?= $item->title ?></p>
                        </div>
                        <div class="stock__sm-item--time">
                            <p><?= $item->dt_event ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>