<?php
/**
 * @var \common\models\db\Company $model
 * @var array $services
 * @var SocAvailable $typeSeti
 * @var array $socCompany
 * @var array $categoryCompany
 * @var string $slug
 * @var array $page
 * @var array $options
 */

use common\classes\DataTime;
use common\classes\GeobaseFunction;
use common\models\db\SocAvailable;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $model->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
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
                        <img src="<?= $model->photo ?>" alt="">
                    </div>
                    <div class="business__requisites--address">

                        <h3><?= $model->name ?></h3>
                        <?php if ($model->verifikation == 1): ?>
                            <span class="business__sm-item--label">
                                <img src="/theme/portal-donbassa/img/icons/ver.png" alt="">
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
                        <a class="phone" href="tel:+380667778540">
                            <?php if (isset($model->allPhones[0]->phone)): ?>
                                <?= $model->allPhones[0]->phone ?>
                            <?php elseif (isset($model->getPhones()[0])): ?>
                                <?= $model->getPhones()[0] ?>
                            <?php endif; ?>
                        </a>
                        <a class="phone" href="tel:+380667778540">
                            <?php if (isset($model->allPhones[1]->phone)): ?>
                                <?= $model->allPhones[1]->phone ?>
                            <?php elseif (isset($model->getPhones()[1])): ?>
                                <?= $model->getPhones()[1] ?>
                            <?php endif; ?>
                        </a>

                        <?php if (isset($services['group_link']) && $services['group_link'] == 1 && !empty($socCompany)):

                            foreach ($typeSeti as $type) {
                                if (isset($socCompany[$type->id]->link)):
                                    ?>
                                    <a href="<?= $socCompany[$type->id]->link ?>" target="_blank"
                                       class="social-wrap__item vk">
                                        <img src="<?= $type->icon ?>" alt="">
                                    </a>
                                <?php
                                endif;

                            }

                        endif; ?>
                    </div>


                </div>

                <?= $this->render('_submenu', ['model' => $model, 'slug' => $slug]); ?>

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

            <?= \frontend\widgets\ShowRightRecommend::widget(); ?>

        </div>

    </div>

</section>