<?php
/**
 * @var $records
 */

?>

<table>
    <tr>
        <th>Имя</th>
        <th>Дата рождения</th>
        <th>Город</th>
    </tr>
    <?php
    foreach ($records as $record) { ?>
        <tr>
            <td><?= $record->FIO ?></td>
            <td><?= $record->date_of_birth ?></td>
            <td><?= \common\models\db\GeobaseCity::findOne($record->city_id)->name ?></td>
        </tr>
    <?php
    }
    ?>
</table>