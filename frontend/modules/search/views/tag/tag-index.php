<?php
/**
 * @var $tag
 * @var $dataProvider
 * @var $randTags
 */
use frontend\modules\search\models\Search;
use yii\helpers\Url;

$this->title = 'Результаты поиска по тегу "' . $tag . '" ';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Результаты поиска по тегу "' . $tag . '"' . ' Поиск по тегам да DA-INFO ' . $randTags,
]);

?>
<section class="search-content">

    <div class="container">

        <h1>Результаты поиска</h1>


        <div class="search-content__wrapper">
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

