<div class="shop__filter-content shop-search">

    <div class="shop__filter-search">

        <div class="shop__filter-search--price">
            цена
            <a href="#" class="filter-price-min">мин</a>
            -
            <a href="#" class="filter-price-max">макс</a>
        </div>

        <div class="rating-stars">
            <ul id="stars">
                <li class="star selected" title="Poor" data-value="1">
                    <i class="fa fa-star fa-fw"></i>
                </li>
                <li class="star selected" title="Fair" data-value="2">
                    <i class="fa fa-star fa-fw"></i>
                </li>
                <li class="star selected" title="Good" data-value="3">
                    <i class="fa fa-star fa-fw"></i>
                </li>
                <li class="star selected" title="Excellent" data-value="4">
                    <i class="fa fa-star fa-fw"></i>
                </li>
                <li class="star" title="WOW!!!" data-value="5">
                    <i class="fa fa-star fa-fw"></i>
                </li>
            </ul>
        </div>

        <div class="shop__filter-search--check">
            <label class="sale-filter">Товары со скидкой
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>

        <div class="shop__filter-search--select">
            <label for="select">Сортировать по:</label>
            <select id="select">
                <option>по умолчанию</option>
                <option>новые</option>
                <option>по цене</option>
                <option>по дате</option>
            </select>
        </div>
        <div class="shop__filter-search--check">
            <label class="sale-filter">Показывать только новые
                <input type="checkbox">
                <span class="checkmark"></span>
            </label>
        </div>

    </div>

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