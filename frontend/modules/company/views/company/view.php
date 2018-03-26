<?php
/**
 * @var \common\models\db\Company $model
 * @var array $services
 * @var SocAvailable $typeSeti
 * @var SocAvailable $type
 * @var array $socCompany
 * @var array $categoryCompany
 * @var string $slug
 * @var string $page
 * @var array $options
 * @var \common\models\db\Phones $phone
 * @var \common\models\db\Messenger $messenger
 */

use common\classes\DataTime;
use common\classes\GeobaseFunction;
use common\models\db\SocAvailable;
use frontend\modules\company\models\Company;
use frontend\widgets\CompanyRight;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $model->meta_title . " | " . Company::$submenuLabels[$page];
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr . " | " . Company::$submenuLabels[$page],
]);
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company_ajax.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


$this->params['breadcrumbs'][] = ['label' => 'Все предприятия', 'url' => Url::to(['/company/company'])];
if (!empty($categoryCompany['category']['categ']->title)) {
    $this->params['breadcrumbs'][] = ['label' => $categoryCompany['category']['categ']->title, 'url' => Url::to(['/company/company/view-category', 'slug' => $categoryCompany['category']['categ']->slug])];

}
if (!empty($categoryCompany['category']->title)) {
    $this->params['breadcrumbs'][] = ['label' => $categoryCompany['category']->title, 'url' => Url::to(['/company/company/view-category', 'slug' => $categoryCompany['category']->slug])];
}
$this->params['breadcrumbs'][] = $model->name;

?>

<section class="business">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
        <div class="business__wrapper">

            <div class="business__content business__single-content">

                <h1 class="business__subtitle"><?= $model->name ?>
                    <span class="business__status">
                    </span>
                </h1>

                <div class="business__requisites">
                    <div class="business__requisites--avatar">
                        <img src="<?= $model->photo ?>"
                             alt="<?= !empty($model->alt) ? $model->alt : $model->name ?>">
                    </div>
                    <div class="business__requisites--address">

                        <h3><?= $model->name ?></h3>
                        <?php if ($model->verifikation == 1): ?>
                            <span class="business__sm-item--label">
                                <img src="/theme/portal-donbassa/img/icons/ver.png"
                                     alt="<?= !empty($model->alt) ? $model->alt : $model->name ?>">
                            </span>
                        <?php endif; ?>

                        <?php
                        if ($model->region_id != 0) {
                            $address = GeobaseFunction::getRegionName($model->region_id) . ', ' . GeobaseFunction::getCityName($model->city_id) . ', ' . $model->address;
                        } else {
                            $address = $model->address;
                        }
                        ?>

                        <p class="concreate-adress"><?= $address; ?></p>
                        <div class="companyDtReg">
                            <span>добавлено:</span>
                            <?= DataTime::time($model->dt_add); ?>
                        </div>
                    </div>
                    <?php if (!empty($model->email)): ?>
                        <div class="business__requisites--site">
                            <a href="mailto:<?= $model->email; ?>">email:<br/><?= $model->email; ?></a>
                        </div>
                    <?php endif; ?>
                    <div class="business__requisites--links">
                        <div class="business__requisites--links-w">
                            <span class="views"><?= $model->views; ?> просмотров</span>
                        </div>
                        <?php if (!empty($model->allPhones)): ?>
                            <?php foreach ($model->allPhones as $phone): ?>
                                <div style="display: flex; margin-top: 10px">
                                    <?php foreach ($phone->messengeres as $messenger): ?>
                                        <a target="_blank" href="<?= $messenger->link ?><?= $phone->getClearPhone() ?>">
                                            <img src="<?= $messenger->icon; ?>" alt="<?= $messenger->name; ?>"
                                                 height="20px"
                                                 width="20px" style="margin-right: 3px">
                                        </a>
                                    <?php endforeach; ?>
                                    <a class="phone" href="tel:<?= $phone->phone ?>">
                                        <img src="/theme/portal-donbassa/img/icons/phone-icon-single-company.png"
                                             alt="">
                                        <?= $phone->phone ?></a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (isset($services['group_link']) && $services['group_link'] == 1 && !empty($model->socCompany)):
                            foreach ($model->socCompany as $soc) {
                                /** @var \common\models\db\SocCompany $soc */
                                if (!empty($soc->link)): ?>
                                    <a href="<?= $soc->link ?>" target="_blank"
                                       class="social-wrap__item">
                                        <img style="width: 24px; height: 24px" src="<?= $soc->socType->icon ?>" alt="">
                                    </a>
                                <?php endif;
                            }
                        endif; ?>
                    </div>


                </div>

                <?= $this->render('_submenu', ['model' => $model, 'slug' => $slug, 'page' => $page]); ?>

                <div class="business__tab-content">
                    <?= $this->render("_$page", $options); ?>
                </div>

                <?php if (!empty($model['tagss'])): ?>
                    <div class="content__separator"></div>
                    <section class="hashtag">
                        <div class="hashtag__wrapper">
                            <?php
                            foreach ($model['tagss'] as $tags) { ?>
                                <a href="<?= Url::to(['/search/tag', 'id' => $tags['tagname']->id]) ?>">
                                    <div class="hashtag__wrapper--item"><?= $tags['tagname']->tag; ?></div>
                                </a>
                            <?php } ?>
                        </div>
                    </section>
                <?php endif; ?>

            </div>

            <?= CompanyRight::widget(); ?>

        </div>

    </div>

</section>

<a href="#" class="feedback-btn">
    <div class="pulse1"></div>
    <div class="pulse2"></div>
    <div class="icon-puls-btn"></div>
</a>

<div id="feedback-modal">

    <h2 class="feedback-modal-title">наши контакты</h2>

    <p class="feedback-modal-desk"><b>нажмите на номер</b> чтобы связаться <br> прямо сейчас!</p>

    <?php if (!empty($model->allPhones)): ?>
        <?php foreach ($model->allPhones as $phone): ?>
            <a class="feedback-modal-phone" href="tel:<?= $phone->phone ?>">
                <?= $phone->phone ?></a>
        <?php endforeach; ?>
    <?php endif; ?>

</div>