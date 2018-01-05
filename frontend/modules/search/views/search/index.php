<?php
/**
 * @var $request
 * @var $selectInterval
 * @var $interval
 * @var $countMaterials
 * @var $allCount
 * @var $searchModel \frontend\modules\search\models\Search
 */
use frontend\modules\search\models\Search;
use yii\helpers\Url;

$this->title = 'Результаты поиска по запросу "' . $request['request'] . '" ' . $searchModel::getTypeLabel($interval);

?>

<section class="search-panel">

    <div class="container">

        <form action="" class="search-panel__form">

            <h1>Результаты поиска</h1>

            <input class="search-panel__field" type="text" name="request" placeholder="<?= $request['request']; ?>">
            <input type="submit" id="search-form-submit" class="search-panel__submit" value="Найти">

        </form>

        <div class="search-panel__result">

            <p><span>По запросу "<?= $request['request']; ?>" найдено <span class="counter"><?= $dataProvider->getTotalCount(); ?></span> результатов. Показывать результаты</span>
                <span class="search-panel__result--wrapper">
                    <a href="#" class="js-search-option"><?= $searchModel::getTypeLabel($interval)?></a>
                    <span class="search-panel__result--option">
                        <a href="<?= Url::to(['/search/search/index', 'request' => $request['request'], 'interval' => 'year'])?>">за год</a>
                        <a href="<?= Url::to(['/search/search/index', 'request' => $request['request'], 'interval' => 'month'])?>">за месяц</a>
                        <a href="<?= Url::to(['/search/search/index', 'request' => $request['request'], 'interval' => 'week'])?>">за неделю</a>
                        <a href="<?= Url::to(['/search/search/index', 'request' => $request['request'], 'interval' => 'day'])?>">за день</a>
                     </span>
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
                <li><a href="<?= Url::to(['/search/search/index', 'request' => $request['request'], 'interval' => $interval])?>">Все материалы <span><?= $allCount; ?></span></a></li>
                <?php foreach ($countMaterials as $key => $value): ?>
                    <li>
                        <a href="<?= Url::to(['/search/search/index', 'request' => $request['request'], 'interval' => $interval, 'type' => $key])?>">
                            <?= Search::getTypeLabel($key); ?>
                            <span><?= $value; ?></span>
                        </a>
                    </li>

                <?php endforeach; ?>



               <!-- <li><a href="#">Блог <span>1026</span></a></li>
                <li><a href="#">Документ <span>7</span></a></li>
                <li><a href="#">Опрос <span>17</span></a></li>
                <li><a href="#">Новости <span>2089</span></a></li>
                <li><a href="#">Эфир <span>895</span></a></li>-->
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
                        'class' => 'no-result'
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

