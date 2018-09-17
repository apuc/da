<?php
/**
 * @var array $allTags
 */


use yii\helpers\ArrayHelper;

$this->title = 'Результаты поиска по тегу';

$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Результаты поиска по тегу Поиск по тегам да DA-INFO ',
]);

?>
<section class="search-content">

    <div class="container">

        <h1>Результаты поиска</h1>
        <form action="/search/tag" method="get">
            <?= \kartik\select2\Select2::widget(
                [
                    'name' => 'id[]',
                    'data' => ArrayHelper::map($allTags, 'id', 'tag'),
                    'value' => Yii::$app->request->get('id'),
                    //'data' => ['Донецкая область' => ['1'=>'Don','2'=>'Gorl'], 'Rostovskaya' => ['5'=>'rostov']],
                    'options' => ['placeholder' => 'Начните вводить теги ...', 'multiple' => true],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            )
            ?>
            <input type="submit" id="search-form-submit" class="search-panel__submit" value="Найти">
        </form>

        <div class="search-content__wrapper">
            <div class="search-content__items">
                Ничего не выбрано
            </div>
        </div>

    </div>

</section>

