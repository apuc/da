<?php
$this->title = "Выбор тарифа для компании";
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
                <h3><span>тариф</span><span><?= $item->name?></span></h3>


                <span class="icon">
                            <img src="<?= $item->icon; ?>" alt="">
                        </span>

                <p>ХОТИТЕ УЗНАТЬ
                    <a href="#stock<?= $item->id; ?>" class="cabinet__packages--about">ПОДРОБНЕЕ?</a></p>

                <a href="#" class="cabinet__packages--buy">заказать</a>

            </div>

        <?php $count++; endforeach; ?>

        <?php foreach ($tariff as $item): ?>
            <div id="stock<?= $item->id; ?>" class="cabinet__packages--hover-block">

                <h3>Подключив тариф <span><?= $item->name; ?></span> вы получите:</h3>
                <?php
                   $services =  \common\models\db\TariffServicesRelations::find()
                       ->where(['tariff_id' => $item->id])
                        ->with('services')
                        ->all();
                //\common\classes\Debug::prn($services);

                ?>


                <ul>
                    <?php foreach ($services as $val): ?>
                        <li><span class="descr"><?= $val['services']->name?></span><span class="val"><?= $val['services']->price?></span></li>
                    <?php endforeach; ?>

                    <li><span class="descr">Цена тарифа</span><span class="val"><?= $item->price; ?> руб/мес</span></li>
                </ul>

                <a href="<?= \yii\helpers\Url::to(
                    [
                        '/company/default/to-order',
                        'companyId' => Yii::$app->request->get('id'),
                        'tariffId' => $item->id,
                    ])
                ?>"
                   class="cabinet__packages--buy">заказать</a>

            </div>

        <?php endforeach; ?>


    </div>
</div>


