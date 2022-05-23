<?php

use common\models\db\GeobaseCity;
use frontend\modules\mainpage\widgets\ShowSearchMissingPeopleFormForIndex;
use frontend\modules\missing_person\models\MissingPerson;

/**
 * @var $records
 * @var $cities GeobaseCity[]
 */

echo ShowSearchMissingPeopleFormForIndex::widget();

?>

<div class="container missing-person__block">
    <?php
    if (count($records) > 0) {
        ?>
        <table class="table">
            <thead>
            <tr>
                <th>ФИО</th>
                <th>Дата рождения</th>
                <th>Город</th>
                <th>Доп. Информация</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($records as $record) { ?>
                <tr>
                    <td><?= $record['FIO'] ?></td>
                    <td><?= date('d.m.Y', $record['date_of_birth']) ?></td>
                    <td><?= GeobaseCity::findOne($record['city_id'])->name ?></td>
                    <td><?= strlen($record['additional_info']) > 0 ? $record['additional_info'] : '—' ?></td>
                </tr>
                <?php
            } ?>
            </tbody>
        </table>
        <?php
    } else { ?>
        <hr class="red-hr">
        <h3 class="nothing-found">По вашему запросу ничего не найдено, попробуйте использовать
            меньше параметров или использовать в поиске
            только Имя/Фамилию
        </h3>
        <hr class="red-hr">
        <?php
    }
    ?>

</div>
