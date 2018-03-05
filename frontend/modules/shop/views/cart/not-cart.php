<?php
/**
 * @var $cart array
 */

use common\classes\GeobaseFunction;
use common\models\UploadPhoto;
use yii\helpers\Url;


$this->registerJsFile('/js/raw/products.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<h1 class="shop__top-title">
    Ваша корзина <span>(<?= Yii::$app->cart->count; ?> товар)</span>
    <img src="/theme/portal-donbassa/img/icons/cheak.svg" alt="">
</h1>

<div class="shop__content">

    Корзина пустая

    <a href="">Продолжить покупки</a>
</div>

