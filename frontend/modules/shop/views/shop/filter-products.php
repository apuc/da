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