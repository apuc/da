<?php

use Classes\Wrapper\Wrapper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Wrapper/GoodsItem */

$this->title = $model->name . ' #' . $model->id;
$this->params['breadcrumbs'][] = [ 'label' => 'Товары' , 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    DetailView::widget(array(
        'model' => $model ,
        'attributes' => array(
            'id' ,
            'sid' ,
            'uid' ,
            'name' ,
            'stuff' ,
            'size' ,
            [
                'attribute' => 'img' ,
                'value' => $model->img ,
                'format' => [ 'image' ] ,
            ] ,
            'image_title' ,
            'image_alt' ,
            'slug' ,
            'price' ,
            'price_max' ,
            'max_qty' ,
            'min_qty' ,
            'date_info.min_date' ,
            'date_info.max_date' ,
            'date_info.is_paid' ,
            'qty_rules_data.on' ,
            'modifier_value' ,
            'pluralNameFormat' ,
            'inBoxPluralNameFormat' ,
            'balancePluralNameFormat' ,
            'price_per_square_meter' ,
            'price_per_linear_meter' ,
            'currency' ,
            'created_at' ,
            'updated_at' ,
            'updated_item_at' ,
            'minimum_order_quantity' ,
            'min_sum_for_free_delivery' ,
            'package_volume' ,
            'product_volume' ,
            'box_volume' ,
            'unit_id' ,
            'weight' ,
            'width' ,
            'height' ,
            'in_box' ,
            'in_set' ,
            'depth' ,
            'is_disabled' ,
            'is_hit' ,
            'is_licensed' ,
            'is_price_fixed' ,
            'is_exclusive' ,
            'is_motley' ,
            'is_adult' ,
            'is_protected' ,
            'is_free_delivery' ,
            'is_gift' ,
            'is_boxed' ,
            'is_paid_delivery' ,
            'is_loco' ,
            'category_id' ,
            'parent_item_id' ,
            'country_id' ,
            'trademark_id' ,
            'modifier_id' ,
            'certificate_type_id' ,

        ) ,
    ));
    ?>
</div>
