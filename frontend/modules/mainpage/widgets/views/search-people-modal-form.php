<?php

use kartik\select2\Select2;

?>
<form class="form__modal" action="/missing_person/missing-person/create">
    <div class="form__modal-content">
        <div class="form__modal-date">
            <label for="modalInputDate">Дата рождения</label>
            <input id="modalInputDate" type="date" placeholder="Введите ФИО" />
        </div>
        <div class="form__modal-place">
            <span><b>Местоположение</b></span>
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
        <div class="form__modal-name">
            <label for="modalInputName">ФИО</label>
            <input id="modalInputName" type="text" placeholder="Введите ФИО" />
        </div>
        <div class="form__modal-additional-information">
            <span><b>Дополнительная информация</b></span>
            <textarea cols="100" rows="5"></textarea>
        </div>
        <div class="form__modal-okButton">
            <button id="modalOkButton">Сообщить</button>
        </div>
    </div>
</form>