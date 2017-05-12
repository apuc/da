<?php
/**
 * @var $companySmall array
 * @var $companyBig \common\models\db\Company
 */
use yii\helpers\Url;

?>
<div class="home-content__wrap_enterprises">
    <div class="title">
        <h3 class="main-title">Где отдохнуть</h3>
        <a href=""><span class="add-icon"></span>Зарегистрировать заведение</a>
    </div>
    <div class="enterprises__wrap">
        <?php $i = 1; ?>
        <?php foreach ($companySmall as $item): ?>
            <?php if ($i <= 4): ?>
                <a href="<?= Url::to(['/company/company/view', 'slug' => $item->slug]) ?>" class="item-small">
                    <div class="thumb">
                        <img src="<?= $item->photo; ?>" alt="">
                    </div>
                    <div class="content">
                        <h4><?= $item->name; ?></h4>
                        <!--<p>--><? //= $item->address;?><!--</p>-->
                        <p><?= explode(';', $item->phone)[0]; ?></p>
                    </div>
                </a>
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $companyBig->slug]) ?>" class="item-large">
            <div class="thumb">
                <img src="<?= $companyBig->photo; ?>" alt="">
            </div>
            <div class="content">
                <h4><?= $companyBig->name; ?></h4>
                <!--<p>--><? //= $companyBig->address;?><!--</p>-->
                <p><?= explode(';', $companyBig->phone)[0]; ?></p>
            </div>
        </a>
        <!-- close item -->
        <a href="<?= Url::to(['/company/company']) ?>" class="show-enterprises">смотреть все заведения<span
                    class="red-arrow"></span></a>
    </div>
</div>