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
<div class="currency-widget">
    <div class="currency-widget__label">
        <span><?= $title ?></span>
    </div>
    <div class="currency-widget__content">
        <table>
            <thead>
            <tr>
                <?php foreach ($rates_title as $rate): ?>
                    <td><?= $rate ?></td>
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
</div>

