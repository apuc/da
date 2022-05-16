<?php

use kartik\select2\Select2;

?>
<link href="/css/raw/search-missing-person-modal.css" rel="stylesheet">
<form class="form__modal" action="/missing_person/missing-person/create" id="post_missing_person">
    <div class="form__modal-content">
        <div class="form__modal-date">
            <label for="modalInputDate">Дата рождения</label>
            <input id="modalInputDate" name="modalInputDate" type="date" required/>
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
                        'form' => 'post_missing_person',
                    ],
                ]
            );
            ?>
        </div>
        <div class="form__modal-name">
            <label for="modalInputName">ФИО</label>
            <input id="modalInputName" name="FIO" type="text" placeholder="Введите ФИО" required />
        </div>
        <div class="form__modal-additional-information">
            <span><b>Дополнительная информация</b></span>
            <textarea id="additional_info" cols="100" rows="5" name="additional_info"></textarea>
        </div>
        <div class="form__modal-okButton">
            <button id="modalOkButton" type="submit" class="modal_submit_button">Сообщить</button>
        </div>
    </div>
</form>