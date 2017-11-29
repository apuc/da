<?php
/**
 * @var $organizations \common\models\db\Company
 * @var $positions array
 * @var $categ CategoryCompany
 */
use common\classes\GeobaseFunction;
use common\classes\WordFunctions;
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use frontend\modules\company\widgets\CategoryMenu;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $categ->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $categ->meta_descr,
]);

$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company_ajax.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$mainCategory = CategoryCompany::find()->where(['id' => $categ->parent_id])->one();

$this->params['breadcrumbs'][] = ['label' => 'Все предприятия', 'url' => Url::to(['/company/company'])];
if(!empty($mainCategory->title)) {
    $this->params['breadcrumbs'][] = ['label' => $mainCategory->title, 'url' => Url::to(['/company/company/view-category', 'slug' => $mainCategory->slug])];

}
$this->params['breadcrumbs'][] = $categ->title;

?>


<?= \frontend\modules\company\widgets\ShowMenuCategory::widget(); ?>
<section class="business">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
        <div class="business__wrapper">

            <div class="business__content">

                <h1 class="business__title">
                    <a href="<?= Url::to(['/company/company']) ?>">Предприятия</a> / <?= $categ->title ?></h1>
                <?php foreach ($organizations as $organization): ?>
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $organization->slug]) ?>" class="business__sm-item">

                        <div class="business__sm-item--img">
                            <img src="<?= $organization->photo ?>" alt="">
                        </div>

                        <p class="business__sm-item--title">
                            <?= $organization->name ?>
                        </p>

                        <p class="business__sm-item--address">
                            <span>Адрес:</span>
                            <?php
                            if($organization->region_id != 0){
                                $address = GeobaseFunction::getRegionName($organization->region_id) . ', ' .GeobaseFunction::getCityName($organization->city_id) . ', ' . $organization->address ;
                            }
                            else{
                                $address = $organization->address;
                            }
                            ?>
                            <span><?= $address ?></span>
                        </p>
                        <?php if (!empty($organization->phone)): ?>
                            <?php $phone = explode(' ', $organization->phone) ?>
                            <ul class="business__sm-item--numbers">
                                <li><?= isset($phone[0]) ? $phone[0] : '' ?></li>
                                <li> <?= isset($phone[1]) ? $phone[1] : '' ?></li>
                            </ul>

                        <?php elseif(!empty($organization->allPhones)):?>
                            <ul class="business__sm-item--numbers">
                            <?php foreach ($organization->allPhones as $key => $phones):?>
                                <?php if ($key == 2) break;?>
                                <li><?= $phones->phone?></li>

                            <?php endforeach;?>
                            </ul>
                        <?php endif; ?>

                        <!-- <span class="business__sm-item&#45;&#45;views-icon"></span>-->
                        <p class="business__sm-item--views"><?= $organization->views ?></p>

                    </a>
                <?php endforeach; ?>
                <span id="more-company-box"></span>
                <!--<div class="wrapper-company-load">
                    <a href="#" data-step="1" id="load-more-company" class="show-more">загрузить еще</a>
                </div>-->

            </div>

            <?/*= CategoryMenu::widget() */?>
        </div>
    </div>
</section>

<?= \frontend\modules\company\widgets\Feedbacks::widget(['categoryId' => $categ->id]) ?>