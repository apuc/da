<?php
/**
 * @var $model \frontend\modules\shop\models\Products
 */

use common\classes\GeobaseFunction;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\modules\shop\widgets\StarsRating;

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
?>

<div class="breadcrumbs-wrap">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumbs'],
    ]); ?>
</div>
<div class="shop__shop-reviews">

    <div class="shop__shop-reviews-wrap">

        <h2 class="shop__reviews-title"><?= $model['title'] ?></h2>

        <div class="rating-stars">
            <?= StarsRating::widget([
                    'rating' => $model->getMiddleRating()
            ])?>

            <a href="#">
                <span> <?= $model->getRatesCount() ?> </span> голоса(ов))
            </a>
            <a href="#">
                199 заказа(ов)
            </a>
        </div>

        <hr>

        <?= \frontend\modules\shop\widgets\ReviewsProducts::widget([
            'productId' => $model->id,
            'reviews' => $model['reviews'],
        ]); ?>

    </div>


</div>
<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['slug']]) ?>">
    <div class="shop__reviews-sidebar" id="shop-reviews-sidebar">
        <div class="shop__reviews-bar-wrap">
            <h3 class="shop__reviews-bar-title">Просматриваемый товар</h3>

            <div class="shop__reviews-bar-img">
                <?php
                if (!empty($model['cover'])): ?>
                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['cover']); ?>"
                         alt="<?= $model['title']; ?>">
                <?php else: ?>

                    <?php if (!empty($model['images'][0]->img_thumb)): ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage('/' . $model['images'][0]->img_thumb); ?>">
                    <?php else: ?>
                        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['cover']); ?>"
                             alt="<?= $model['title']; ?>">
                    <?php endif; ?>
                <?php endif; ?>
            </div>

            <p class="shop__reviews-bar-desk">
                <?= $model['title'] ?>
            </p>

            <span class="price-sail"><?= $model['price'] ?> руб. / шт.</span>

            <a href="#" class="button-basket" id="add-cart-btn">Добавить в корзину</a>

            <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['slug']]) ?>" class="product-desc-btn">Описание товара</a>
        </div>
        <a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['slug']]) ?>" class="review-sidebar-btn">Вернуться на страницу товара</a>
    </div>
</a>