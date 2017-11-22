<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 17.11.2017
 * Time: 17:10
 */
/** @var string $title */

use yii\helpers\Url;
?>

<h1><?= $title ?></h1>
<div class="e-content__header">
    <div class="e-content__header__left">
        <ul>
            <li><a href="#">Регион |</a></li>
            <li><a href="">Банки |</a></li>
            <li><a href="">ЦРБ |</a></li>
            <li><a href="">Разные</a></li>
        </ul>
    </div>
    <div class="e-content__header__right">
        <ul>
            <li><a href="<?= Url::to(['/currency']) ?>">Валюта</a></li>
            <li><a href="<?= Url::to(['/currency', 'type' => 'metal']) ?>">Металлы</a></li>
            <li><a href="#">Новости</a></li>
            <li><a href="<?= Url::to(['/currency', 'type' => 'coin']) ?>">Криптовалюта</a></li>
            <li><a href="<?= Url::to(['/currency/converter']) ?>">Конвертер</a></li>
        </ul>
    </div>
</div>

