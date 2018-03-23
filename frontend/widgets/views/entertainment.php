<?php
/**
 * @var $companySmall array
 * @var $companyBig \common\models\db\Company
 * @var $item \common\models\db\Company
 * @var $phones \common\models\db\Phones
 */

use yii\helpers\Url;

?>
<div class="home-content__wrap_enterprises">
    <div class="title">
        <h3 class="main-title">Где отдохнуть</h3>
        <a href="<?= Url::to(['/company/company/create']); ?>"><span class="add-icon"></span>Зарегистрировать заведение</a>
    </div>
    <div class="enterprises__wrap">
        <?php $i = 1; ?>
        <?php foreach ($companySmall as $item): ?>
            <?php if ($i <= 4): ?>
                <?php if ($i <= 3): ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $item->slug]) ?>" class="item-small">
                        <div class="thumb">
                            <img src="<?= $item->photo . '?width=300' ?>" alt="">
                        </div>
                        <div class="item-small__content">
                            <h4><?= $item->name; ?></h4>
                            <?php if (!empty($item->allPhones)): ?>
                                <ul class="business__sm-item--numbers">
                                    <?php foreach ($item->allPhones as $key => $phones): ?>
                                        <li><?= $phones->phone ?></li>
                                        <?php if ($key == 1) {
                                            break;
                                        } ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </a>
                <?php else: ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $item->slug]) ?>" class="item-large">
                        <div class="thumb">
                            <img src="<?= $item->photo . '?width=300' ?>" alt="">

                        </div>
                        <div class="item-small__content">
                            <h4><?= $item->name; ?></h4>
                            <span>
                                Адрес: <?= $item->address; ?>
                            </span>
                            <?php if (!empty($item->allPhones)): ?>
                                <ul class="business__sm-item--numbers">
                                    <?php foreach ($item->allPhones as $key => $phones): ?>
                                        <li><?= $phones->phone ?></li>
                                        <?php if ($key == 1) {
                                            break;
                                        } ?>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
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
                <img src="<?= $companyBig->photo . '?width=300' ?>" alt="">

            </div>
            <div class="item-small__content">
                <h4><?= $companyBig->name; ?></h4>
                <span>
                                Адрес: <?= $companyBig->address; ?>
                            </span>
                <?php if (!empty($companyBig->allPhones)): ?>
                    <ul class="business__sm-item--numbers">
                        <?php foreach ($companyBig->allPhones as $key => $phones): ?>
                            <li><?= $phones->phone ?></li>
                            <?php if ($key == 2) {
                                break;
                            } ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </a>

        <!-- close item -->
        <a href="<?= Url::to(['/company/company']) ?>" class="show-enterprises">смотреть все заведения<span
                    class="red-arrow"></span></a>
    </div>
</div>