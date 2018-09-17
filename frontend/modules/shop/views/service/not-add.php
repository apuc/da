<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Добавить товар';
?>


<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3><?= Html::encode($this->title) ?></h3>

    <div class="right">
        <div class="blanket__content">
            <div class="blanket__content__wrap">
                <img src="/theme/portal-donbassa/img/blanket/ban.png" alt="">
                <h2>У Вас нет приедприятий для
                    добавления товаров</h2>
            </div>
            <a href="<?= Url::to(['/company/company/create']) ?>">Добавить предприятие</a>
            <p>или подключите тариф к компании</p>
        </div>

    </div>

</div>


