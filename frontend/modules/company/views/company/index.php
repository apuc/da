<?php
/**
 * @var $organizations CategoryCompany
 * @var $meta_title \common\models\db\KeyValue
 * @var $meta_descr \common\models\db\KeyValue
 * @var $wrc array
 * @var $positions array
 */
use common\classes\WordFunctions;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use frontend\modules\company\widgets\CategoryMenu;
use yii\helpers\Url;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);

$this->registerJsFile('/js/company_ajax.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
    <section class="business">

        <div class="container">

            <div class="business__wrapper">

                <div class="business__content">

                    <h3 class="business__title">Предприятия</h3>
                    <?php $pos = 0;
                    $wrc_count = 0; ?>
                    <?php while ($pos < 12): ?>
                        <?php if (in_array($pos, $positions, true)): ?>
                            <?php $company = isset($wrc[$wrc_count]) ? $wrc[$wrc_count] : $organizations[$pos] ?>
                            <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>"
                               class="business__big-item">

                                <div class="business__sm-item--img">

                                    <div class="recommend">
                                        <span class="recommend__star"></span>
                                        Рекомендуем
                                    </div>

                                    <img src="<?= $company->photo ?>" alt="">
                                </div>

                                <p class="business__sm-item--title">
                                    <?= $company->name ?>
                                </p>

                                <p class="business__sm-item--address">
                                    <span>Адрес:</span>
                                    <span><?= $company->address ?></span>
                                </p>

                                <?php $phone = explode(' ', $company->phone) ?>
                                <ul class="business__sm-item--numbers">
                                    <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                    <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                                </ul>

                                <ul class="business__sm-item--numbers">
                                    <li><?= isset($phone[2]) ? $phone[2] : '' ?></li>
                                    <li> <?= isset($phone[3]) ? $phone[3] : '' ?></li>
                                </ul>

                                <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                                <p class="business__sm-item--views"><?= $company->views ?></p>

                            </a>
                            <?php $pos += 2;
                            $wrc_count++; ?>
                        <?php else: ?>
                            <a href="<?= Url::to(['/company/company/view', 'slug' => $organizations[$pos]->slug]) ?>"
                               class="business__sm-item">

                                <div class="business__sm-item--img">
                                    <img src="<?= $organizations[$pos]->photo ?>" alt="">
                                </div>

                                <p class="business__sm-item--title">
                                    <?= $organizations[$pos]->name ?>
                                </p>

                                <p class="business__sm-item--address">
                                    <span>Адрес:</span>
                                    <span><?= $organizations[$pos]->address ?></span>
                                </p>
                                <?php $phone = explode(' ', $organizations[$pos]->phone) ?>
                                <ul class="business__sm-item--numbers">
                                    <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                    <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                                </ul>

                                <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                                <p class="business__sm-item--views"><?= $organizations[$pos]->views ?></p>

                            </a>
                            <?php $pos++; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <span id="more-company-box"></span>
                    <div class="more-block">
                        <a href="#" data-step="1" id="load-more-company" class="show-more">загрузить еще</a>
                    </div>
                </div>

                <?= CategoryMenu::widget() ?>
            </div>
        </div>
    </section>

<?= \frontend\modules\company\widgets\Feedbacks::widget() ?>