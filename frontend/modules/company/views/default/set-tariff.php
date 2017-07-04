<?php
?>


<div class="cabinet__inner-box">

    <h3>Подключение тарифа</h3>

    <div class="cabinet__packages">

        <h3 class="cabinet__packages--title">Выберите интересующий <span>тариф</span> для вашей компании</h3>

        <?php
        $count = 0;
        foreach ($tariff as $item): ?>
            <div class="cabinet__packages--item <?= ($count == 2) ? 'top' : ''?>">

                <p><?= $item->title; ?></p>

                <h3>тариф <br><?= $item->name?></h3>

                <span class="icon">
                            <img src="<?= $item->icon; ?>" alt="">
                        </span>

                <p>ХОТИТЕ УЗНАТЬ <a href="#">ПОДРОБНЕЕ?</a></p>

                <!--<a href="#" class="cabinet__packages&#45;&#45;buy">КУПИТЬ</a>-->

            </div>
        <?php $count++; endforeach; ?>




    </div>

</div>
