<?php
/**
 * @var $model \frontend\modules\shop\models\Products
 */

use common\classes\GeobaseFunction;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->registerJsFile('/theme/portal-donbassa/js/jquery.zoom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerJsFile('/theme/portal-donbassa/js/slick.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/star-rating.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/raw/products.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->registerCssFile('/css/star-rating.min.css');

$this->params['breadcrumbs'][] = ['label' => 'Все категории', 'url' => Url::to(['/shop/shop/index'])];
$categoryList = array_reverse($categoryList);
//\common\classes\Debug::dd($categoryList);
$categoryList = ArrayHelper::toArray($categoryList);
//\common\classes\Debug::dd($categoryList);
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
//\common\classes\Debug::dd($model);
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
                    <img src="/<?= $item->img_thumb; ?>" alt="<?= $model->title ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <div class="single-shop__slider">

            <?php foreach ($model['images'] as $item): ?>
                <a href="/<?= $item->img; ?>" class="single-shop__slider-item" data-fancybox="shop">
                    <img src="/<?= $item->img; ?>" alt="<?= $model->title ?>">
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="single-shop__info">
        <div class="single-shop__info-header">
            <h2 class="single-shop__product-title"><?= $model->title ?></h2>
            <!--<a href="#" class="single-shop__payment-method">
                Способы оплаты
            </a>
            <a href="#" class="single-shop__deliver">
                Склады в ДНР
            </a>-->
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
                <!--<a href="#">
                    199 заказа(ов)
                </a>-->
            </div>
        </div>
        <div class="single-shop__info-content">
            <?= $this->render('_price', ['model' => $model]); ?>
            <div class="single-shop__info-item">
                <div>Количетсво</div>
                <div>
                    <div class="single-shop__info-content--counter">

                        <div class="numbers">
                            <input type="number" min="1" max="999" value="1"
                                   class="js-product-quantity number count-add-to-cart "
                                   data-type="single" maxlength="999" pattern="[0-9]{3}">
                            <a class="minus update-count"><i class="fa fa-minus" aria-hidden="true"></i></a>
                            <a class="plus update-count"> <i class="fa fa-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="single-shop__info-item">
                <div>Общая стоимость</div>
                <div>
                    <span class="total-cost">
                        <?= number_format((!empty($model->new_price)) ? $model->new_price : $model->price, 0, '.',
                            ' ') ?> руб. / 1 шт.</span>
                </div>
            </div>
            <div class="single-shop__info-item">
                <!--<a href="#" class="button-buy">Купить сейчас</a>-->
                <a href="#" class="button-basket add-to-cart" id="add-cart-btn" data-id="<?= $model->id; ?>"
                   shop-id="<?= $model['company']->id; ?>">
                    Добавить в корзину
                </a>
                <!--<a href="#" class="promotion-seller">
                    <span>Акция продавца</span>
                    Получить купон продавца
                </a>-->
            </div>
        </div>
        <div class="single-shop__info-footer">
            <!-- <div class="all-actions__company">
                <div class="all-actions__company--img">
                    <img src="<? /*= $model['company']->photo */ ?>" alt="">
                </div>
                <h3 class="all-actions__company--title"><? /*= $model['company']->name */ ?></h3>-->
            <?php
            //\common\classes\Debug::dd($model['company']->region_id);
            if ($model['company']->region_id != 0) {
                $address = $region . ', ' . GeobaseFunction::getCityName($model['company']->city_id) . ', ' . $model['company']->address;
            } else {
                $address = $model['company']->address;
            }
            ?>
            <!-- <div class="all-actions__company--addres"><? /*= $address */ ?></div>
            </div>-->

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
        <!--<div class="company-rating">
            <p> Рейтинг компании <span>5.0</span></p>
            <a href="#">
                Посмотреть статистику компании
            </a>
        </div>-->
        <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $model['company']->slug]) ?>"
           class="company-page-btn">Перейти на страницу компании</a>
    </div>
    <!--<div class="single-shop__buy-history">
        <h4 class="single-shop__store-info--title">История покупок</h4>


        <div class="single-shop__buy-history-wrap">
            <div>
                <span class="title">Покупатель</span>
            </div>
            <div>
                <span class="title">Дата покупки</span>
            </div>
            <div>
                <span class="price">p****</span>
                <span class="value">RU</span>
            </div>
            <div>
                <span class="amount">количество 2 шт.</span>
                <span class="date">23 января 2018</span>
            </div>

            <div>
                <span class="price">p****</span>
                <span class="value">RU</span>
            </div>
            <div>
                <span class="amount">количество 2 шт.</span>
                <span class="date">23 января 2018</span>
            </div>

            <div>
                <span class="price">p****</span>
                <span class="value">RU</span>
            </div>
            <div>
                <span class="amount">количество 2 шт.</span>
                <span class="date">23 января 2018</span>
            </div>

        </div>
    </div>-->
    <!--<a href="#" class="call-center">Круглосуточный колл-центр</a>-->
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
                        <?php if(!empty($model['images'][0]->img)): ?>
                            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['images'][0]->img); ?>">
                        <?php /*else:*/?><!--
                            <img src="<?/*= \common\models\UploadPhoto::getImageOrNoImage( $model->cover); */?>" alt="<?/*= $model->title; */?>">-->
                        <?php endif; ?>
                        <!--<img src="/<?/*= $model['images'][0]->img */?>" alt="Описание">-->
                    </div>
                    <div class="single-shop__description">
                        <?= $model->description; ?>
                    </div>
                </div>
            </div>

            <div class="single-shop__tab-item">
                <a href="<?= \yii\helpers\Url::to(['/shop/shop/product-reviews', 'slug' => $model->slug]) ?>" class="read-all-btn">Читать все отзывы</a>
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
            <!-- <span>03</span>-->
        </a>

        <a href="#" target="_blank" class="social-wrap__item fb">

            <img src="/theme/portal-donbassa/img/soc/fb.png" alt="fb">
            <!-- <span>12</span>-->
        </a>

        <a href="#" target="_blank" class="social-wrap__item ok">

            <img src="/theme/portal-donbassa/img/soc/ok-icon.png" alt="ok">
            <!-- <span>05</span>-->
        </a>

        <a href="#" target="_blank" class="social-wrap__item insta">

            <img src="/theme/portal-donbassa/img/soc/insta-icon.png" alt="instagramm">
            <!-- <span>63</span>-->
        </a>

        <a href="#" target="_blank" class="social-wrap__item google">

            <img src="/theme/portal-donbassa/img/soc/google-icon.png" alt="google">
            <!--<span>36</span>-->
        </a>

        <a href="#" target="_blank" class="social-wrap__item twitter">

            <img src="/theme/portal-donbassa/img/soc/twi-icon.png" alt="twitter">
            <!--<span>11</span>-->
        </a>

    </div>
</div>

<div id="modal-add-cart">

    <h1 class="modalAdd-cartTitle">Товар был добавлен в корзину. <span> Товаров в Вашей корзине: <span
                    class="modal-count-cart">1</span></span></h1>

    <a href="<?= Url::to(['/shop/cart']) ?>" class="go-cart">Перейти к корзине</a>

    <button class="close-cart" id="modal_close">Вернуться на сайт</button>


</div>