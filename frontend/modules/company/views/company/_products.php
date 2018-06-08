<?php
/**
 * @var $products \frontend\modules\shop\models\Products
 * @var $product \frontend\modules\shop\models\Products
 * @var $categories \common\models\db\CategoryCompany
 */

use common\classes\Debug;
use yii\widgets\Pjax;
$this->registerJsFile('/js/raw/company_ajax.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>


<div id="shop-company" class="business__tab-content--wrapper">

    <div class="business__company">
        <?php
        /**
         * TODO удалить коментированный код 08.06.2018
         */

        /*foreach ($products as $product): */ ?><!--
            <a href="<? /*= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $product->slug])*/ ?>" class="business__company-item">
                <div class="business__company-img">
                    <?php
        /*                    if (!empty($product->cover)): */ ?>
                        <img src="<? /*= \common\models\UploadPhoto::getImageOrNoImage( $product->cover); */ ?>" alt="<? /*= $product->title; */ ?>">
                    <?php /*else: */ ?>
                        <?php /*if(!empty($product->images[0]->img_thumb)): */ ?>
                            <img src="<? /*= \common\models\UploadPhoto::getImageOrNoImage('/'. $product->images[0]->img_thumb); */ ?>">
                        <?php /*else:*/ ?>
                            <img src="<? /*= \common\models\UploadPhoto::getImageOrNoImage( $product->cover); */ ?>" alt="<? /*= $product->title; */ ?>">
                        <?php /*endif; */ ?>
                    <?php /*endif; */ ?>
                </div>
                <div class="business__company-desc">
                    <? /*= $product->title; */ ?>
                </div>
                <div class="business__company-view"><span class="view"><? /*= $product->view; */ ?> просмотров</span> <span class="heart"></span></div>
                <div class="business__company-price">
                    <div class="price-label"><? /*= number_format($product->price, 0, '.', ' '); */ ?> руб. / шт.</div>
                    <div class="price-date"><? /*= date('d.m.Y', $product->dt_update)*/ ?></div>
                </div>
                <button class="business__company-btn">Добавить в корзину</button>
            </a>
        --><?php /*endforeach; */ ?>
        <?php if ($categories): ?>

            <ul class="shop__main--categories">
                <li class="<?= !Yii::$app->request->get('category')? 'active' : '' ?>"><a href="<?=\yii\helpers\Url::to(['/company/company/view', 'slug' => $slug, 'place' => 'products'])?>">Все</a></li>
                <?php foreach ($categories as $category) : ?>
                    <li class="<?= Yii::$app->request->get('category') == $category->id ? 'active' : '' ?>"><a href="?category=<?=$category->id?>"><?= $category->name?></a></li>
                <?php endforeach; ?>
            </ul>

        <?php endif ?>
        <?php Pjax::begin(); ?>
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
        ]) ?>

        <?php Pjax::end(); ?>
    </div>


</div>
