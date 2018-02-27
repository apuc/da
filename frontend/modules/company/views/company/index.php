<?php
/**
 * @var $organizations CategoryCompany
 * @var $meta_title \common\models\db\KeyValue
 * @var $meta_descr \common\models\db\KeyValue
 * @var $wrc array
 * @var $positions array
 * @var $company \common\models\db\Company
 */

use common\classes\GeobaseFunction;
use common\classes\WordFunctions;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use frontend\modules\company\widgets\CategoryMenu;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);

$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company_ajax.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = 'Все предприятия';

?>
<?= \frontend\modules\company\widgets\ShowMenuCategory::widget(); ?>

    <section class="business">

        <div class="container">

            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'options' => ['class' => 'breadcrumbs']
            ]) ?>

            <div class="business__wrapper">

                <div class="business__content new-business">

                    <h1 class="business__title">Предприятия</h1>
                    <?php $pos = 0;
                    $wrc_count = 0; ?>
                    <?php while ($pos < 16): ?>
                        <?php
                        if (empty($organizations[$pos])) {
                            break;
                        }
                        ?>
                        <?php if (in_array($pos, $positions, true)): ?>
                            <?php $company = isset($wrc[$wrc_count]) ? $wrc[$wrc_count] : $organizations[$pos] ?>
                            <a href="<?= Url::to(['/company/company/view', 'slug' => $company->slug]) ?>"
                               class="business__big-item <?= ($company->recommended == 1) ? 'favorite' : '' ?>">
                                <div class="recommend">
                                    <span class="recommend__star"></span>
                                    Рекомендуем
                                </div>
                                <div class="business__sm-item--img">
                                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($company->photo); ?>"
                                         alt="<?= !empty($company->alt) ? $company->alt : $company->name ?>">
                                </div>

                                <p class="business__sm-item--title">
                                    <?= $company->name ?>
                                </p>
                                <?php if ($company->verifikation == 1): ?>
                                    <span class="business__sm-item--label">
                                    <img src="/theme/portal-donbassa/img/icons/ver.png"
                                         alt="<?= !empty($company->alt) ? $company->alt : $company->name ?>">
                                </span>
                                <?php endif; ?>

                                <p class="business__sm-item--address">
                                    <span>Адрес:</span>
                                    <?php
                                    if ($company->region_id != 0) {
                                        $address = GeobaseFunction::getRegionName($company->region_id) . ', ' . GeobaseFunction::getCityName($company->city_id) . ', ' . $company->address;
                                    } else {
                                        $address = $company->address;
                                    }
                                    ?>
                                    <span><?= $address ?></span>
                                </p>

                                <?php if (!empty($company->phone)): ?>
                                    <?php $phone = explode(' ', $company->phone) ?>
                                    <ul class="business__sm-item--numbers">
                                        <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                        <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                                    </ul>

                                    <ul class="business__sm-item--numbers">
                                        <li><?= isset($phone[2]) ? $phone[2] : '' ?></li>
                                        <li> <?= isset($phone[3]) ? $phone[3] : '' ?></li>
                                    </ul>

                                <?php elseif (!empty($company->allPhones)): ?>
                                    <ul class="business__sm-item--numbers">
                                    <?php foreach ($company->allPhones as $key => $phones): ?>
                                        <?php if ($key == 2): ?>
                                            </ul><ul class="business__sm-item--numbers">
                                        <?php endif; ?>
                                        <li><?= $phones->phone ?></li>
                                        <?php if ($key == 4) break; ?>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>

                                <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                                <p class="business__sm-item--views"><?= $company->views ?></p>

                            </a>
                            <?php $pos++;
                            $wrc_count++; ?>
                        <?php else: ?>
                            <a href="<?= Url::to(['/company/company/view', 'slug' => $organizations[$pos]->slug]) ?>"
                               class="business__sm-item <?= ($organizations[$pos]->recommended == 1) ? 'favorite' : '' ?>">
                                <div class="recommend">
                                    <span class="recommend__star"></span>
                                    Рекомендуем
                                </div>
                                <div class="business__sm-item--img">
                                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($organizations[$pos]->photo); ?>"
                                         alt="<?= !empty($organizations[$pos]->alt) ? $organizations[$pos]->alt : $organizations[$pos]->name ?>">
                                </div>

                                <p class="business__sm-item--title">
                                    <?= $organizations[$pos]->name ?>
                                </p>
                                <?php if ($organizations[$pos]->verifikation == 1): ?>
                                    <span class="business__sm-item--label">
                                    <img src="/theme/portal-donbassa/img/icons/ver.png"
                                         alt="<?= !empty($organizations[$pos]->alt) ? $organizations[$pos]->alt : $organizations[$pos]->name ?>">
                                </span>
                                <?php endif; ?>
                                <p class="business__sm-item--address">
                                    <span>Адрес:</span>
                                    <?php
                                    if ($organizations[$pos]->region_id != 0) {
                                        $address = GeobaseFunction::getRegionName($organizations[$pos]->region_id) . ', ' . GeobaseFunction::getCityName($organizations[$pos]->city_id) . ', ' . $organizations[$pos]->address;
                                    } else {
                                        $address = $organizations[$pos]->address;
                                    }
                                    ?>
                                    <span><?= $address ?></span>
                                </p>

                                <?php if (!empty($organizations[$pos]->phone)): ?>
                                    <?php $phone = explode(' ', $organizations[$pos]->phone) ?>
                                    <ul class="business__sm-item--numbers">
                                        <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                        <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                                    </ul>

                                    <ul class="business__sm-item--numbers">
                                        <li><?= isset($phone[2]) ? $phone[2] : '' ?></li>
                                        <li> <?= isset($phone[3]) ? $phone[3] : '' ?></li>
                                    </ul>

                                <?php elseif (!empty($organizations[$pos]->allPhones)): ?>
                                    <ul class="business__sm-item--numbers">
                                    <?php foreach ($organizations[$pos]->allPhones as $key => $phones): ?>
                                        <?php if ($key == 2): ?>
                                            </ul><ul class="business__sm-item--numbers">
                                        <?php endif; ?>
                                        <li><?= $phones->phone ?></li>
                                        <?php if ($key == 1) break; ?>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>


                                <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                                <p class="business__sm-item--views"><?= $organizations[$pos]->views ?></p>

                            </a>
                            <?php $pos++; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    <span id="more-company-box"></span>
                    <div class="wrapper-company-load">
                        <a href="#" data-step="1" id="load-more-company" class="show-more">загрузить еще</a>
                    </div>
                </div>

                <? /*= CategoryMenu::widget() */ ?>
            </div>
        </div>
    </section>

<?= \frontend\modules\company\widgets\Feedbacks::widget() ?>