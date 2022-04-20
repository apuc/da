<?php

use yii\helpers\Url;
use common\classes\WordFunctions;
?>

<link rel="stylesheet" href="css/raw/search-missing-person.css">
<form class="search-people-form" action="#" method="post">
    <h3>Оперативное оповещение о пропавших</h3>
    <p class="search-people-form__header">
        Центр поиска пропавших людей - ежедневно публикуется информация о
        разыскиваемых лицах, а также правовая информация и полезные советы по
        безопасности.
    </p>
    <div class="search-people-form__form-telegram">
        <div class="search-people-form__form">
            <div class="search-people-form__radiobuttons-selects">
                <div class="search-people-form__radiobuttons">
                    <input id="radio-1" type="radio" name="radio" value="1" checked/>
                    <label for="radio-1">Пропал</label>
                    <input id="radio-2" type="radio" name="radio" value="2"/>
                    <label for="radio-2">Ищу</label>
                </div>
                <div class="search-people-form__selects">
                    <div class="search-people-form__select">
                        <select>
                            <option value="до 5 лет">Дети до 5 лет</option>
                            <option value="от 5 до 18 лет">Дети от 5 до 18 лет</option>
                            <option value="более 18 лет">Люди старше 18 лет</option>
                        </select>
                    </div>
                    <div class="search-people-form__select">
                        <select class="search-people-form__place-select">
                            <option value="" disabled selected>
                                Выберите местоположение
                            </option>
                            <option value="Донецк">Донецк</option>
                            <option value="Макеевка">Макеевка</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="search-people-form__input-button">
                <div class="search-people-form__text-input">
                    <input type="text" placeholder="Введите ФИО"/>
                </div>
                <button type="submit">Поиск</button>
            </div>
        </div>
        <div class="search-people-form__telegram">
            <a href="https://telegram.org" target="blank"
            ><img src="img/forms/search-missing-person/telegram.png"
                /></a>
            <h4>Максимальный результат</h4>
            <p>
                Подписка на уведомления - Оставайтесь всегда в курсе новых объявлений!
            </p>
        </div>
    </div>
    <p class="search-people-form__footer">
        Все кто ищет родных и близких людей, или помогает их искать, кто потерял
        связь с однополчанами, близкими, родными - размещайте информацию,
        <span>будем искать вместе.</span>
    </p>
</form>