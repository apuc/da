<?php

use kartik\select2\Select2;

?>

<link href="/css/raw/search-missing-person-index.css" rel="stylesheet">

<div class="form">
    <div class="form__header">
        <div class="form__text">
            <h3>Оперативное оповещение о пропавших</h3>
            <p>
                Центр поиска пропавших людей - ежедневно публикуется информация о
                разыскиваемых лицах, а также правовая информация и полезные советы по
                безопасности.
            </p>
        </div>
        <button class="form__button" id="reportMissing">Сообщить о пропаже</button>
    </div>
    <div class="form__content">
        <div class="form__content-left">
            <form method="post" action="#" class="form__form-block">
                <div class="form__inputSelects">
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
                <div class="form__down-block">
                    <div class="form__inputName">
                        <input type="text" placeholder="Введите ФИО" />
                    </div>
                    <button type="submit">Поиск</button>
                </div>
                <div class="g-recaptcha" data-sitekey="К"></div>
            </form>
        </div>
        <div class="form__content-right">
            <div class="form__i-block">
                <a href="https://t.me/prosmi_dnr" target="blank">
                    <img src="/img/forms/search-missing-person/i.png"/>
                </a>
            </div>
            <div class="form__text-block">
                <p class="form__info">
                    <span>В министерствах и ведомствах Донецкой Народной Республики</span>
                    создано несколько баз данных, с помощью которых происходит поиск
                    пропавших без вести людей в связи с боевыми действиями.
                </p>
                <h5>для звонков:</h5>
                <h3>277</h3>
                <h3>+38 062 303 27 72</h3>
                <h3>+38 071 099 72 77</h3>
                <h3>+7 863 318 25 44</h3>
                <p class="form__source">Источник: https://mzdnr.ru/poisk © mzdnr.ru</p>
            </div>
        </div>
    </div>
   <?= \frontend\modules\mainpage\widgets\PostMissingPeopleModal::widget() ?>
</div>
<script src="https://www.google.com/recaptcha/api.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.age-select').select2({
            selectionCssClass: 'up-selects',
            width: 'resolve'
        })
        $('.select_place-select').select2({
            selectionCssClass: 'up-selects'
        })
        $('b[role="presentation"]').hide()
    })

    // Модальное окно

    const modal = document.querySelector('.form__modal')

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = 'none'
        }
    }

    // Кнопка закрытия модального окна

    const modalOkButton = document.getElementById('modalOkButton')

    modalOkButton.addEventListener('click', (event) => {
        event.preventDefault()
        modal.style.display = 'none'
    })

    // Нажатие на кнопку "Сообщить о пропаже" на форме search-people-form

    const reportMissing = document.getElementById('reportMissing')

    reportMissing.addEventListener('click', (event) => {
        modal.style.display = 'block'
    })
</script>