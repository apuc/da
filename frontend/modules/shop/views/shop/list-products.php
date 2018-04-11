<?php
/**
 * @var $this yii\web\View
 * @var $categoryInfo \frontend\modules\shop\models\CategoryShop
 * @var $products \frontend\modules\shop\models\Products
 * @var $categoryTreeArr
 * @var $ollCategory
 * @var $categoryList
 */

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->params['breadcrumbs'][] = ['label' => 'Все категории', 'url' => Url::to(['/shop/shop/index'])];
$categoryList = array_reverse($categoryList);
//\common\classes\Debug::dd($categoryList);
if(isset($categoryList[1])){
    $this->params['breadcrumbs'][] =
        [
            'label' => $categoryList[0]->name,
            'url' => Url::to(['/shop/shop/category', 'category' => [$categoryList[0]->slug]]) ];
}
if(isset($categoryList[2])){
    $this->params['breadcrumbs'][] =
        [
            'label' => $categoryList[1]->name,
            'url' => Url::to(['/shop/shop/category', 'category' => [$categoryList[0]->slug, $categoryList[1]->slug]]) ];
}
$this->params['breadcrumbs'][] = $categoryInfo->name;

$this->registerJsFile('/js/raw/filter.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div class="breadcrumbs-wrap">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumbs']
    ]); ?>
</div>

<?= \frontend\modules\shop\widgets\ShowFilterLeftProducts::widget(
        [
            'categoryId' => $categoryInfo->id,
        ]
);
?>


<div class="shop__filter-content">

    <?= \frontend\modules\shop\widgets\ShowFilterTopProducts::widget(); ?>

    <!--<div class="shop__top-sales-elements">-->
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $products,
            'itemView' => '_list',
            'options' => ['class' => 'shop__top-sales-elements'],
            'itemOptions' => [
                'tag' => false,
                //'class' => 'shop__top-sales-elements--item',
            ],
            'emptyText' => '<div class="cabinet__add-element"><p>Раздел пока пуст</p></div>',
            'emptyTextOptions' => [
                'tag' => 'div',
            ],
            'layout' => "{items}<div class=\"pagination\">{pager}</div>",
            'pager' => [
                'options' => [
                    'class' => '',
                ],
                'prevPageCssClass' => 'pagination-prew',
                'nextPageCssClass' => 'pagination-next',
                'prevPageLabel' => '',
                'nextPageLabel' => '',
                'activePageCssClass' => 'active',
                'maxButtonCount' => 5,
            ],
        ])?>


    <!--</div>-->
</div>