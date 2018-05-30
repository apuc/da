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

$this->title = $categoryInfo->meta_title;

$this->registerMetaTag([
    'name' => 'description',
    'content' => $categoryInfo->meta_description,
]);

$this->params['breadcrumbs'][] = ['label' => 'Все категории', 'url' => Url::to(['/shop/shop/index'])];
$categoryList = array_reverse($categoryList);
//\common\classes\Debug::dd($categoryList);
if(isset($categoryList[1])){
    $this->params['breadcrumbs'][] =
        [
            'label' => $categoryList[0]->name,
        'url' => Url::to(['/shop/shop/category', 'category' => [$categoryList[0]->slug]]) ];
}
$this->params['breadcrumbs'][] = $categoryInfo->name;
?>

<div class="breadcrumbs-wrap">
    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class' => 'breadcrumbs']
    ]); ?>
   <!-- <ul class="breadcrumbs">
        <li><a href="#">Главная</a></li>
        <li><a href="#">Все категории</a></li>
        <li><a href="#">Телефоны...</a></li>
        <li><a href="#">Женская одежда и аксессуары</a></li>
    </ul>-->
</div>
<h1 class="shop__title"><?= $categoryInfo->name; ?></h1>
<?= $this->render('_left-category',
    [
        'categoryId' => $categoryInfo->id,
        'categoryTreeArr' => $categoryTreeArr,
        'ollCategory' => $ollCategory,
    ]
); ?>
<div class="shop__top-sales">

    <!--<div class="shop__top-sales-nav">

        <h3 class="shop__top-sales-nav--title">Товары из категории</h3>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/payment-method-icon.png" alt=""></span>
            <span class="name">Способы <br> оплаты</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Склады в <br> ДНР</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/warehouse-icon.png" alt=""></span>
            <span class="name">Ликвидация <br> товара</span>
        </a>

        <a href="#" class="shop__top-sales-nav--link">
            <span class="icon"><img src="img/shop/icons/deliver-icon.png" alt=""></span>
            <span class="name">Круглосуточный <br> колл-центр</span>
        </a>

    </div>-->

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




   <!-- </div>-->

</div>