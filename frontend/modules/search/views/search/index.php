<?php
?>

<section class="search-panel">

    <div class="container">

        <form action="" class="search-panel__form">

            <h1>Результаты поиска</h1>

            <input class="search-panel__field" type="text" placeholder="Крым">
            <input type="submit" id="search-form-submit" class="search-panel__submit" value="Найти">

        </form>

        <div class="search-panel__result">

            <p><span>По запросу "крым" найдено <span class="counter"><?= $dataProvider->getTotalCount(); ?></span> результатов. Показывать результаты</span>
                <a href="#" class="js-search-option">за неделю</a>
                <span class="search-panel__result--option">
                    <a href="#">за год</a>
                    <a href="#">за месяц</a>
                    <a href="#">за неделю</a>
                    <a href="#">за день</a>
                 </span>
                <span class="triangle"></span>
            </p>

        </div>

    </div>

</section>

<section class="search-content">

    <div class="container">

        <div class="search-content__wrapper">

            <ul class="search-content__breadcrumbs">
                <li><a href="#">Все материалы <span>4034</span></a></li>
                <li><a href="#">Блог <span>1026</span></a></li>
                <li><a href="#">Документ <span>7</span></a></li>
                <li><a href="#">Опрос <span>17</span></a></li>
                <li><a href="#">Новости <span>2089</span></a></li>
                <li><a href="#">Эфир <span>895</span></a></li>
            </ul>

            <div class="search-content__items">
                <?= \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_list',

                    'itemOptions' => [
                        'tag' => 'div',
                        'class' => 'search-content__box',
                    ],
                    'emptyText' => 'Поск не дал результатов',
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
        </div>

    </div>

</section>

