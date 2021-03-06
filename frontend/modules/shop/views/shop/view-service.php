<?php
/**
 * @var $model \frontend\modules\shop\models\Products
 * @var $reservations \common\models\db\ServiceReservation[]
 */

use common\classes\GeobaseFunction;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use \common\models\db\ServicePeriods;

$this->registerJsFile('/theme/portal-donbassa/js/jquery.zoom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/star-rating.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/products.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/service.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/css/star-rating.min.css');

$this->params['breadcrumbs'][] = ['label' => 'Все категории', 'url' => Url::to(['/shop/shop/index'])];
$categoryList = array_reverse($categoryList);
$categoryList = ArrayHelper::toArray($categoryList);
foreach ($categoryList as $key => $item) {
    $url = '';
    if ($key == 1) {
        $url = $categoryList[$key - 1]['slug'];
    }
    if ($key == 2) {
        $url = $categoryList[$key - 2]['slug'] . '/' . $categoryList[$key - 1]['slug'];
    }
    $this->params['breadcrumbs'][] =
        [
            'label' => $item['name'],
            'url' => Url::to(['/shop/shop/category', 'category' => [$url, $item['slug']]]),
        ];

}

$this->params['breadcrumbs'][] = $model->title;

$region = GeobaseFunction::getRegionName($model['company']->region_id);

$this->title = $model->title . ', ' . $model['company']->name . ', ' . $region;
?>

<div class="breadcrumbs-wrap">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumbs'],
    ]); ?>
</div>
<div class="single-shop__detail">
    <div class="single-shop__gallery">

        <div class="single-shop__slider-nav">
            <?php foreach ($model['images'] as $item): ?>
                <div class="single-shop__nav-item">
                    <img src="<?= $item->img_thumb; ?>" alt="<?= $model->title ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="single-shop__slider">

            <?php foreach ($model['images'] as $item): ?>
                <a href="<?= $item->img; ?>" class="single-shop__slider-item" data-fancybox="shop">
                    <img src="<?= $item->img; ?>" alt="<?= $model->title ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="single-shop__info">
        <div class="single-shop__info-header">
            <h2 class="single-shop__product-title"><?= $model->title ?></h2>

            <?php
            $rating = 0;
            $summArr = ArrayHelper::getColumn($model['reviews'], 'rating');
            if (!empty($summArr)) {
                $rating = array_sum($summArr) / count($model['reviews']);
            }

            ?>
            <div class='rating-stars'>
                <input id="input-2-xs" data-step="0.1" value="<?= $rating; ?>">

                <a href="#">
                    <span> <?= round($rating, 2); ?> </span> голоса(ов)
                </a>

            </div>
        </div>
        <div class="single-shop__info-content">
            <?= $this->render('_price', ['model' => $model]); ?>
            <?php if ($model->durability != 0): ?>
                <div class="single-shop__info-item">
                    <div>Бронирование</div>
                    <div>
                        <div class="single-shop__info-content--counter">
                            <?= \yii\jui\DatePicker::widget(['attribute' => 'from_date',
                                'language' => 'ru',
                                'dateFormat' => 'php:d-m-YY',
                                'options' => [
                                    'class' => 'reservation_date',
                                    'data-id' => $model->id,
                                    'data-count' => 0,
                                    'data-user-id' => isset(Yii::$app->user->id) ? Yii::$app->user->id : 0
                                ]
                            ]) ?>
                        </div>
                    </div>

                </div>
            <?php endif ?>
            <div class="single-shop__info-item service-blocks">
                <div class="container-lg-3">
                    <?php if ($model->durability === 0): ?>
                        <div class='container-lg-3'></div>

                    <?php elseif ($period = $model->getServicePeriodByWeekDay(ServicePeriods::getWeekDayLabel()[date("w", time())])): ?>
                        <?php
                        $dayDuration = $period->getDayDuration();
                        $Duration = $model->durability;
                        $count = $dayDuration / $Duration; ?>
                        <div class='container-lg-3'>
                            <?php for ($i = 0; $i < $count; $i++): ?>
                                <?php if ($period->checkReservation($i, $Duration, time(), $model->id)): ?>
                                    <button data-id="<?= $i ?>"
                                            class="btn btn-warning service-reserve"><?= $period->getButtonLabel($i, $Duration) ?></button>
                                <?php else: ?>
                                    <button data-id="<?= $i ?>"
                                            class="btn btn-info service-reserve"><?= $period->getButtonLabel($i, $Duration) ?></button>
                                <?php endif ?>
                            <?php endfor ?>
                        </div>
                    <?php else: ?>
                        <div class='container-lg-3'>В этот день услуга не предоставляется, но вы можете выбрать другой
                            день.
                        </div>
                    <?php endif ?>
                </div>
            </div>
            <?php if ($model->durability != 0): ?>
            <div class="single-shop__info-item person_count_block">
            </div>
            <div class="single-shop__info-item">
                <div>Общая стоимость</div>
                <div>
                    <span class="total-cost">
                       0руб. / 0 шт.
                </div>
                <div class="single-shop__info-item" id="error_message"></div>
            </div>
            <div class="single-shop__info-item">

                <button class="button-basket reserve-service" data-id="<?= $model->id; ?>">
                    Зарезервировать
                </button>

            </div>
            <?php endif ?>
        </div>
        <div class="single-shop__info-footer">
            <?php
            if ($model['company']->region_id != 0) {
                $address = $region . ', ' . GeobaseFunction::getCityName($model['company']->city_id) . ', ' . $model['company']->address;
            } else {
                $address = $model['company']->address;
            }
            ?>
            <a href="#" class="single-shop__desires add-product-like <?= !$like ?: 'active' ?>"
               data-id="<?= $model->id; ?>">Добавить в мои желания</a>
        </div>
    </div>
</div>
<div class="single-shop__store-info" id="store-info">
    <div class="single-shop__seller">
        <h4 class="single-shop__store-info--title">Продавец</h4>
        <div class="all-actions__company">
            <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $model['company']->slug]) ?> ">
                <div class="all-actions__company--img">
                    <img src="<?= $model['company']->photo ?>" alt="">
                </div>
                <h3 class="all-actions__company--title"><?= $model['company']->name ?></h3>
                <div class="all-actions__company--addres"><?= $address ?></div>
            </a>
        </div>
        <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $model['company']->slug]) ?>"
           class="company-page-btn">Перейти на страницу компании</a>
    </div>
</div>
<div class="single-shop__main-content">
    <div class="single-shop__tabs">
        <ul class="single-shop__tab-links">
            <li>Описание товара</li>
            <li>Отзывы <span>(<?= count($model['reviews']) ?>)</span></li>
            <li>Доставка и оплата</li>
            <li class="feedback">Связаться с продавцом</li>
        </ul>
        <div class="single-shop__tab-content">

            <div class="single-shop__tab-item">
                <h2 class="single-shop__tab-title">Характеристики товара</h2>
                <div class="single-shop__characteristics-wrap">
                    <ul>
                        <?php foreach ($model['productFieldsValues'] as $item): ?>
                            <li><?= $item['field']->label ?>:<span> <?= $item->value ?></span></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <h2 class="single-shop__tab-title">Описание товара</h2>
                <div class="single-shop__characteristics-wrap">
                    <div class="single-shop__description-img">
                        <?php if (!empty($model['images'][0]->img)): ?>
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['images'][0]->img); ?>">
                        <?php endif; ?>
                    </div>
                    <div class="single-shop__description">
                        <?= $model->description; ?>
                    </div>
                </div>
            </div>

            <div class="single-shop__tab-item">
                <a href="<?= \yii\helpers\Url::to(['/shop/shop/product-reviews', 'slug' => $model->slug]) ?>"
                   class="read-all-btn">Читать все отзывы</a>
                <?= \frontend\modules\shop\widgets\ReviewsProducts::widget([
                    'productId' => $model->id,
                    'reviews' => $model['reviews'],
                ]); ?>


            </div>

            <div class="single-shop__tab-item">
                <h2 class="single-shop__tab-title">Доставка и оплата</h2>

                <?php
                if (empty($model->delivery)) {
                    echo $model['company']->delivery;
                } else {
                    echo $model->delivery;
                }
                echo "<br />";
                ?>

                <?php
                if (empty($model->payment)) {
                    echo $model['company']->payment;
                } else {
                    echo $model->payment;
                }
                ?>

            </div>

            <div>
                <h4>Адрес</h4>
                <?= $address; ?>
                <h4>E-mail:</h4>
                <?= $model['company']->email; ?>
                <h4>Телефоны</h4>
                <?php if (!empty($model['company']->allPhones)): ?>
                    <?php foreach ($model['company']->allPhones as $phone): ?>
                        <a class="feedback-modal-phone" href="tel:<?= $phone->phone ?>">
                            <?= $phone->phone ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <?= \frontend\modules\shop\widgets\ShowProductCompany::widget(
        ['productId' => $model->id,
            'companyId' => $model->company_id,]
    ) ?>
    <div class="social-wrapper-shop">

        <a href="#" target="_blank" class="social-wrap__item vk">
            <img src="/theme/portal-donbassa/img/soc/vk.png" alt="vk">
        </a>

        <a href="#" target="_blank" class="social-wrap__item fb">
            <img src="/theme/portal-donbassa/img/soc/fb.png" alt="fb">
        </a>

        <a href="#" target="_blank" class="social-wrap__item ok">
            <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="ok">
        </a>

        <a href="#" target="_blank" class="social-wrap__item insta">
            <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="instagramm">
        </a>

        <a href="#" target="_blank" class="social-wrap__item google">
            <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="google">
        </a>

        <a href="#" target="_blank" class="social-wrap__item twitter">
            <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="twitter">
        </a>

    </div>
</div>

<div id="modal-add-cart">

    <h1 class="modalAdd-cartTitle">Товар был добавлен в корзину. <span> Товаров в Вашей корзине: <span
                    class="modal-count-cart">1</span></span></h1>

    <a href="<?= Url::to(['/shop/cart']) ?>" class="go-cart">Перейти к корзине</a>

    <button class="close-cart" id="modal_close">Вернуться на сайт</button>


</div>