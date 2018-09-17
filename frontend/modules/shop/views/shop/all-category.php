<?php
$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
?>

<div class="shop__all-categories home-contents">
    <?php
    $count = 0;
    $catArr = [];
    $countAllCat = 0;
    foreach($category as $item):?>
        <div class="shop__categories-item home-content-item" data-id="<?= $item['id'];?>">
            <div class="shop__categories-img">
                <img src="<?= $item['img']; ?>" alt="<?= $item['name']; ?>" title="<?= $item['name']; ?>">
            </div>
            <div class="shop__categories-desk">
               <?= $item['name']; ?>
            </div>
        </div>
        <?php
        $catArr[] = $item['id'];
        $count++;
        if($count == 2 || $countAllCat == count($category)):
            $count = 0;

            if(!empty($catArr)):
                foreach($catArr as $value):
                    ?>
                    <div class="text-about" data-id="<?= $value; ?>">
                        <div class="text-about-title">
                            <a href="<?= \yii\helpers\Url::to(['/shop/shop/category', 'category' => $category[$value]['slug']]); ?>"><b>Смотреть все товары</b> в категории <span><?= $category[$value]['name']?></span></a>
                        </div>
                        <div class="text-about-links">
                            <?php if(isset($category[$value]['childs'])): ?>
                                <?php foreach($category[$value]['childs'] as $childs): ?>
                                    <a class="text-about-link"
                                       href="<?= \yii\helpers\Url::to(['/shop/shop/category/',
                                           'category' => [ $category[$value]['slug'], $childs->slug] ]); ?>"><?= $childs->name; ?></a>
                                <?php endforeach ?>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach;

            endif;
            $catArr = [];
        endif;
    endforeach; ?>
</div>

<h2 class="shop__all-categories-title">Последние добавленные</h2>

<div class="shop__top-sales-home-elements single-shop-carousel shop__all-categories-rec">


    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $products,
        'itemView' => '_list',
        'options' => ['class' => 'shop__top-sales-home-elements single-shop-carousel shop__all-categories-rec'],
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

</div>