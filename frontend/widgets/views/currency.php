<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 24.11.2017
 * Time: 10:00
 */

use common\classes\Debug;

/** @var array $rates_title */
/** @var array $rates_body */
/** @var array $title */
?>
<div class="course">
    <table class="course__table">
        <caption><?= $title ?></caption>
        <thead>
        <tr>
            <?php foreach ($rates_title as $rate): ?>
                <th><?= $rate ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($rates_body as $rate): ?>
            <tr><?php foreach ($rate as $value): ?>
                    <td><?= $value ?></td>
                <?php endforeach; ?></tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
