<?php
/**
 * @var $model \common\models\db\Company
 * @var $stock \common\models\db\Stock
 * @var $feedback \common\models\db\CompanyFeedback
 * @var $img \common\models\db\CompanyPhoto
 */

use common\classes\GeobaseFunction;

$this->title = $model->meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->meta_descr,
]);

$this->registerJsFile('/js/company_ajax.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/company.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//\common\classes\Debug::prn($services);
?>

<section class="business">

    <div class="container">

        <div class="business__wrapper">

            <div class="business__content business__single-content">

                <h3 class="business__subtitle">Предприятия / <?= $model->name ?>
                    <span class="business__status">
                    <span class="views"><?= $model->views; ?> просмотров</span>
                    </span>

                </h3>

                <div class="business__requisites">
                    <div class="business__requisites--avatar">
                        <img src="<?= $model->photo ?>" alt="">
                    </div>
                    <div class="business__requisites--address">

                        <h3><?= $model->name ?></h3>
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

                    </div>
                    <?php if(!empty($model->email)):?>
                        <div class="business__requisites--site">

                            <a href="" target="_blank"><span><?= $model->email; ?></span>
                                <span><img src="/theme/portal-donbassa//img/icons/golink-icon.png" alt=""></span>
                            </a>
                            <!--<p>Описание этой ссылки,
                                подробности</p>-->

                        </div>
                    <?php endif;?>
                    <div class="business__requisites--links">
                        <a class="phone" href="tel:+380667778540">
                            <?= isset($model->getPhones()[0]) ? $model->getPhones()[0] : '' ?>
                        </a>
                        <a class="phone" href="tel:+380667778540">
                            <?= isset($model->getPhones()[1]) ? $model->getPhones()[1] : '' ?>
                        </a>

                        <?php if(isset($services['group_link']) && $services['group_link'] == 1):

                            foreach ($typeSeti as $type){
                            ?>
                                <a href="<?= $socCompany[$type->id]->link?>" target="_blank" class="social-wrap__item vk">
                                    <img src="<?= $type->icon ?>" alt="">
                                </a>
                            <?php
                        }

                        endif; ?>
                    </div>


                </div>

                <ul class="business__scroll-links">
                    <li><a href="#about" class="businessScroll">О компании</a></li>
                    <li><a href="#reviews" class="businessScroll">Отзывы</a></li>
                    <li><a href="#stock" class="businessScroll">Акции</a></li>
                </ul>

                <?php if (!empty($img)): ?>
                    <div class="business__photos">

                        <?php foreach ($img as $item): ?>

                            <a href="<?= $item->photo ?>" data-fancybox="gallery" class="business__photos--slide">
                                <img src="<?= $item->photo ?>" alt="">
                            </a>

                        <?php endforeach; ?>

                    </div>
                <?php endif; ?>

                <div class="business__descr" id="about">
                    <?php if(isset($services['count_text']) && $services['count_text'] != '-'):?>
                        <?= \yii\helpers\StringHelper::truncate($model->descr, $services['count_text']); ?>
                    <?php else: ?>
                        <?= $model->descr; ?>
                    <?php endif; ?>
                </div>
                <?php if (!empty($stock)): ?>
                    <div class="business__stocks" id="stock">

                        <h3 class="section-title">Наши акции</h3>

                        <div class="separator"></div>

                        <div class="business__stocks--box">

                            <?php foreach ($stock as $item): ?>

                                <div class="business__stocks--item">

                                    <div class="business__stocks--img">
                                        <img src="<?= $item->photo ?>" alt="">
                                    </div>

                                    <p><?= $item->title ?></p>
                                    <p><?= $item->dt_event ?></p>

                                </div>

                            <?php endforeach; ?>

                        </div>

                    </div>
                <?php endif; ?>

                <?php if (!empty($feedback)): ?>
                    <div class="business__reviews" id="reviews">

                        <h3 class="section-title">Отзывы о компании</h3>

                        <div class="separator"></div>
                        <?php foreach ($feedback as $item): ?>
                            <div class="business__reviews--item">

                                <div class="business__reviews--avatar">
                                    <img src="img/home-content/what-say-1.png" alt="">
                                </div>

                                <div class="descr">

                                    <span class="date"><?= date('H:i d-m-Y') ?></span>

                                    <h3><?= $model->name ?></h3>

                                    <!--<p><?/*= $model->meta_descr */?></p>-->

                                    <p class="full"><?= $item->feedback ?></p>

                                </div>

                                <div class="links">

                                    <a href="#" class="links__more">Читать весь отзыв</a>

                                    <!--<a href="" class="social-wrap__item vk">
                                        <img src="img/soc/vk.png" alt="">
                                    </a>
                                    <a href="" class="social-wrap__item fb">
                                        <img src="img/soc/fb.png" alt="">
                                    </a>
                                    <a href="" class="social-wrap__item ok">
                                        <img src="img/soc/ok-icon.png" alt="">
                                    </a>
                                    <a href="" class="social-wrap__item insta">
                                        <img src="img/soc/insta-icon.png" alt="">
                                    </a>
                                    <a href="" class="social-wrap__item twitter">
                                        <img src="img/soc/twi-icon.png" alt="">
                                    </a>
                                    <a href="" class="social-wrap__item google">
                                        <img src="img/soc/google-icon.png" alt="">
                                    </a>
                                    <a href="" class="social-wrap__item pinterest">
                                        <img src="img/soc/pinter-icon.png" alt="">
                                    </a>-->

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
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