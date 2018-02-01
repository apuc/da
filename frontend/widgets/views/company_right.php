<?php
/** @var array $companies
 * @var common\models\db\Company $company
 */

use yii\helpers\Url;

?>

<div class="promotions-sidebar" id="promotion-sidebar">
    <h3 class="main-title">рекомендуем</h3>
    <?php foreach ($companies as $company): ?>
        <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>">
            <div href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>" class="company-sidebar">
                <div class="company-sidebar__img">
                    <img src="<?= $company->photo; ?>" alt="">
                </div>
                <h2 class="company-sidebar__title"><?= $company->name; ?></h2>
                <div class="company-sidebar__desc">
                    <div class="company-sidebar__link">
                        <?php if (!empty($company->phone)): ?>
                            <?php $phone = explode(' ', $company->phone) ?>
                            <a href="tel:<?= isset($phone[0]) ? $phone[0] : '' ?>">
                                <?= isset($phone[0]) ? $phone[0] : '' ?>
                            </a>
                            <a href="tel:<?= isset($phone[1]) ? $phone[1] : '' ?>">
                                <?= isset($phone[1]) ? $phone[1] : '' ?>
                            </a>
                        <?php elseif (!empty($company->allPhones)): ?>
                            <?php foreach ($company->allPhones as $key => $phones): ?>
                                <a href="tel:<?= $phones->phone ?>">
                                    <?= $phones->phone ?>
                                </a>
                                <?php if ($key == 1) break; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <div class="company-sidebar__view">
                        <span><?= $company->views; ?></span>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>