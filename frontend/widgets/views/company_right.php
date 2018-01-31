<?php
/** @var array $companies
 * @var common\models\db\Company $company
 */

use yii\helpers\Url;

?>

<div class="promotions-sidebar" id="promotion-sidebar">
    <h3 class="main-title">Рекомендуем</h3>
    <div class="recommended">
        <?php foreach ($companies as $company): ?>
            <div class="img">
                <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>">
                    <img src="<?= $company->photo; ?>" alt="">
                </a>
            </div>
            <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>" class="title">
                <?= $company->name; ?>
            </a>
            <div class="desc">
                <?php if (!empty($company->phone)): ?>
                    <?php $phone = explode(' ', $company->phone) ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>">
                        <?= isset($phone[0]) ? $phone[0] : '' ?>
                    </a>
                <?php elseif (!empty($company->allPhones)): ?>
                    <?php foreach ($company->allPhones as $key => $phones): ?>
                        <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>">
                            <?= $phones->phone ?>
                        </a>
                        <?php if ($key == 0) break; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div>
                    <span class="review"><?= $company->views; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>