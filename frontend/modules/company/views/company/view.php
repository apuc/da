<?php
/**
 * @var $model \common\models\db\Company
 * @var $stock \common\models\db\Stock
 * @var $feedback \common\models\db\CompanyFeedback
 * @var $img \common\models\db\CompanyPhoto
 * @var $categoryCompany
 * @var $uniqueViews
 */

use common\classes\GeobaseFunction;
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
/*\common\classes\Debug::prn($categoryCompany);
die();*/

$this->params['breadcrumbs'][] = ['label' => 'Все предприятия', 'url' => Url::to(['/company/company'])];
if(!empty($categoryCompany['category']['categ']->title)){
    $this->params['breadcrumbs'][] = ['label' => $categoryCompany['category']['categ']->title, 'url' => Url::to(['/company/company/view-category', 'slug' => $categoryCompany['category']['categ']->slug])];

}
if(!empty($categoryCompany['category']->title)){
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
                    <span class="views"><?= $model->views; ?> просмотров</span>
                    </span>
                </h1>

                <div class="business__requisites">
                    <div class="business__requisites--avatar">
                        <img src="<?= $model->photo ?>" alt="">
                    </div>
                    <div class="business__requisites--address">

                        <h3><?= $model->name ?></h3>
                        <?php if($model->verifikation == 1): ?>
                            <span class="business__sm-item--label">
                                <img src="/theme/portal-donbassa/img/icons/ver.png" alt="">
                            </span>
                        <?php endif; ?>
                        <!--<p><?/*= $model['meta_descr'] */?></p>-->

                        <?php
                            if($model->region_id != 0){
                                $address = GeobaseFunction::getRegionName($model->region_id) . ', ' .GeobaseFunction::getCityName($model->city_id) . ', ' . $model->address ;
                            }
                            else{
                                $address = $model->address;
                            }
                        ?>

                        <p class="concreate-adress"><?= $address;  ?></p>
                        <div class="companyDtReg">
                            <span>добавлено:</span>
                            <?= \common\classes\DataTime::time($model->dt_add); ?>
                        </div>
                    </div>
                    <?php if(!empty($model->email)):?>
                        <div class="business__requisites--site">

                            <a href="" target="_blank"><span><?= $model->email; ?></span>
                                <span><!--<img src="/theme/portal-donbassa//img/icons/golink-icon.png" alt="">--></span>
                            </a>
                            <!--<p>Описание этой ссылки,
                                подробности</p>-->

                        </div>
                    <?php endif;?>
                    <div class="business__requisites--links">
                        <a class="phone" href="tel:+380667778540">
                            <?php if (isset($model->allPhones[0]->phone)): ?>
                                <?= $model->allPhones[0]->phone ?>
                            <?php elseif (isset($model->getPhones()[0])): ?>
                                <?= $model->getPhones()[0] ?>
                            <?php endif; ?>
                        </a>
                        <a class="phone" href="tel:+380667778540">
                            <?php if (isset($model->allPhones[1]->phone )): ?>
                                <?= $model->allPhones[1]->phone  ?>
                            <?php elseif (isset($model->getPhones()[1])): ?>
                                <?= $model->getPhones()[1] ?>
                            <?php endif; ?>
                        </a>

                        <?php if(isset($services['group_link']) && $services['group_link'] == 1 && !empty($socCompany)):

                                foreach ($typeSeti as $type){
                                    if(isset($socCompany[$type->id]->link)):
                                ?>
                                    <a href="<?= $socCompany[$type->id]->link?>" target="_blank" class="social-wrap__item vk">
                                        <img src="<?= $type->icon ?>" alt="">
                                    </a>
                                <?php
                                    endif;

                                }

                        endif; ?>
                    </div>


                </div>

                <ul class="business__tab-links">
                    <li class="tab"><a href="#about-company" class="active">О компании</a></li>
                    <li class="tab"><a href="#reviews">Отзывы</a></li>
                    <li class="tab"><a href="#stocks">Акции</a></li>
                </ul>


                <div class="business__tab-content">

                    <div id="about-company" class="business__tab-content--wrapper">

                        <?php if (!empty($img)): ?>
                            <div class="business__photos">

                                <?php foreach ($img as $item): ?>

                                    <a href="<?= $item->photo ?>" data-fancybox="gallery" class="business__photos--slide">
                                        <img src="<?= $item->photo ?>" alt="">
                                    </a>

                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>

                        <div class="business__descr">
                            <?php if(isset($services['count_text']) && $services['count_text'] != '-'):?>
                                <?= \yii\helpers\StringHelper::truncate($model->descr, $services['count_text']); ?>
                            <?php else: ?>
                                <?= $model->descr; ?>
                            <?php endif; ?>
                        </div>

                    </div>

                    <div id="reviews" class="business__tab-content--wrapper">
                        <div class="business__reviews">

                            <?php if (!empty($feedback)): ?>

                                <?php foreach ($feedback as $item): ?>
                                    <div class="business__reviews--item">
                                        <?// \common\classes\Debug::prn($item['user_id']) ?>

                                        <div class="business__reviews--avatar">
                                            <?= \common\classes\UserFunction::getUser_avatar_html($item['user_id']); ?>
                                        </div>

                                        <div class="descr">

                                            <span class="date"><?= date('H:i d-m-Y', $item->dt_add) ?></span>

                                            <h3><?= \common\classes\UserFunction::getUserName($item['user_id']) ?></h3>

                                            <!--<p><?/*= $model->meta_descr */?></p>-->

                                            <p class="full"><?= $item->feedback ?></p>

                                        </div>

                                        <!--<div class="links">

                                            <a href="#" class="links__more">Читать весь отзыв</a>


                                        </div>-->
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <div class="what-say__servises">
                                <?php if (!Yii::$app->user->isGuest): ?>
                                    <a href="#" id="add-review"
                                       data-id="<?= $model->id?>"
                                       data-name="<?= $model->name?>"
                                    ><span class="comments-icon"></span>Написать свой отзыв</a>
                                <?php
                                    else:
                                ?>
                                    <a href="<?= \yii\helpers\Url::to(['/user/login'])?>"><span class="comments-icon"></span>Авторизируйтесь чтобы оставить отзыв</a>
                                <?php endif; ?>
                                <!--<form action="" class="business__form">

                                    <textarea class="business__form&#45;&#45;textarea" placeholder="Текст сообщения"></textarea>

                                    <input class="show-more" type="submit" value="отправит">

                                </form>-->

                            </div>
                        </div>
                    </div>
                    
                    <div class="business__tab-content--wrapper" id="stocks">
                        <h3 class="section-title">Наши акции</h3>
                        <div class="business__stocks--box">
                        <?php if (!empty($stock)): ?>
                            <?php foreach ($stock as $item): ?>
                                <div class="stock__sm-item">
                                    <div class="stock__sm-item--img">

                                        <img src="<?= $item->photo ?>" alt="">
                                    </div>
                                    <div class="stock__sm-item--descr">
                                        <span class="views"><?= $item->view?> просмотров</span>
                                        <p><?= $item->title ?></p>
                                    </div>
                                    <div class="stock__sm-item--time">
                                        <p><?= $item->dt_event ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>

                <?php if(!empty($model['tagss'])): ?>
                    <div class="content__separator"></div>
                    <section class="hashtag">
                        <div class="hashtag__wrapper">
                            <?php
                            foreach ($model['tagss'] as $tags){ ?>
                                <a href="<?= Url::to(['/search/tag', 'id' => $tags['tagname']->id])?>">
                                    <div class="hashtag__wrapper--item"><?= $tags['tagname']->tag; ?></div>
                                </a>
                            <?php } ?>
                        </div>
                    </section>
                <?php endif; ?>




                <div class="business__location">

                    <div id="map"></div>

                </div>

            </div>

            <?/*= \frontend\modules\company\widgets\HotStock::widget() */?>
            <?= \frontend\widgets\ShowRightRecommend::widget(); ?>

        </div>

    </div>

</section>