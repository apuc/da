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
        <a href="<?= Url::to(['/site/design']);?>"><span class="add-icon"></span>Зарегистрировать заведение</a>
    </div>
    <div class="enterprises__wrap">
        <?php $i = 1; ?>
        <?php foreach ($companySmall as $item): ?>
            <?php if($i <= 4):?>
                <?php if ($i <= 3): ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $item->slug]) ?>" class="item-small">
                        <div class="thumb">
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
                        </div>
                        <div class="item-small__content">
                            <h4><?= $item->name; ?></h4>
                            <!--<p>--><? //= $item->address;?><!--</p>-->
                            <p><?= explode(';', $item->phone)[0]; ?></p>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $item->slug]) ?>" class="item-large">
                        <div class="thumb">
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($item->photo); ?>" alt="">
                            <h4><?= $item->name; ?></h4>
                        </div>
                        <div class="item-small__content">
                            <span>
                                Адрес: <?= $item->address;?>
                            </span>
                            <?php $phone = explode(' ', $item->phone); ?>

                            <p>
                                <?= isset($phone[0]) ? $phone[0] : '' ?>
                            </p>
                            <p>
                                <?= isset($phone[1]) ? $phone[1] : '' ?>
                            </p>
                        </div>

                    </a>

                <?php endif; ?>
            <?php endif; ?>
            <?php $i++; ?>
        <?php endforeach; ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $companyBig->slug]) ?>" class="item-large">
            <div class="recommend">
                <span class="recommend__star"></span>
                Рекомендуем
            </div>
            <div class="thumb">
                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($companyBig->photo); ?>" alt="">
                <h4><?= $companyBig->name; ?></h4>
            </div>
            <div class="item-small__content">
                            <span>
                                Адрес: <?= $companyBig->address;?>
                            </span>
                <?php $phone = explode(' ', $companyBig->phone); ?>

                <p>
                    <?= isset($phone[0]) ? $phone[0] : '' ?>
                </p>
                <p>
                    <?= isset($phone[1]) ? $phone[1] : '' ?>
                </p>
            </div>

        </a>

        <!-- close item -->
        <a href="<?= Url::to(['/company/company']) ?>" class="show-enterprises">смотреть все заведения<span
                    class="red-arrow"></span></a>
    </div>
</div>