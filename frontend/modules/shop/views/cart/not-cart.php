<?php
/**
 * @var $cart array
 */

use common\classes\GeobaseFunction;
use common\models\db\ProductMark;
use common\models\UploadPhoto;
use yii\helpers\Url;

$this->registerJsFile('/js/raw/products.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>


<div class="shop__empty-cart">Ваша Корзина пуста <span>Начните покупать сейчас!</span></div>

<?= \frontend\modules\shop\widgets\ShowEmptyCartProds::widget()?>


