<?php

use common\models\db\GeobaseCity;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\classes\WordFunctions;

/** @var $cities GeobaseCity[] */
?>
<link href="/css/raw/search-missing-person.css" rel="stylesheet">

<div class="search-people-form" action="<?= Url::to(['']) ?>" method="get">
    <div class="search-people-form__headerBlock">
        <div>
            <h3>Оперативное оповещение о пропавших</h3>
            <p class="search-people-form__header">
                Центр поиска пропавших людей - ежедневно публикуется информация о
                разыскиваемых лицах, а также правовая информация и полезные советы по
                безопасности.
            </p>
        </div>
        <div class="search-people-form__headerBlock-button">
            <button id="reportMissing">Сообщить о пропаже</button>
        </div>
    </div>
    <div class="search-people-form__form-telegram">
        <form class="search-people-form__form" action="/missing-person/search" method="get">
            <div class="search-people-form__inputSelects">
                <div class="inputSelect">
                    <?=
                    Select2::widget(
                        [
                            'name' => 'age_category_id',
                            'attribute' => 'age_category_id',
                            'data' => [
                                0 => 'Любой',
                                1 => 'Дети до 5 лет',
                                2 => 'Дети от 5 до 18 лет',
                                3 => 'Люди старше 18 лет'
                            ],
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'placeholder' => 'Возраст',
                                'class' => 'select_place-select select2-hidden-accessible',
                            ],
                        ]
                    );
                    ?>
                </div>
                <div class="inputSelect">
                    <?=
                    Select2::widget(
                        [
                            'name' => 'city_id',
                            'attribute' => 'city_id',
                            'data' => \yii\helpers\ArrayHelper::map($cities, 'id', 'name'),
                            'theme' => Select2::THEME_BOOTSTRAP,
                            'options' => [
                                'placeholder' => 'Выберите город',
                                'class' => 'select_place-select select2-hidden-accessible',
                            ],
                        ]
                    );
                    ?>
                </div>
            </div>
            <div class="search-people-form__input-button">
                <div class="search-people-form__text-input">
                    <input type="text" placeholder="Введите ФИО" class="search_people_fio"/>
                </div>
                <button type="submit">Поиск</button>
            </div>
        </form>
        <div class="search-people-form__telegram">
            <a href="https://t.me/prosmi_dnr" target="blank">
                <img src="img/forms/search-missing-person/telegram.png"/>
            </a>
            <h4>Максимальный результат</h4>
            <p>
                Подписка на уведомления - Оставайтесь всегда в курсе новых объявлений!
            </p>
        </div>
    </div>
    <p class="search-people-form__footer">
        Все, кто ищет родных и близких людей или помогает их искать, кто потерял
        связь с однополчанами, близкими, родными - размещайте информацию,
        <span>будем искать вместе.</span>
    </p>
    <?= \frontend\modules\mainpage\widgets\PostMissingPeopleModal::widget() ?>
</div>
