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
                <?if($item->id != 4):?>
                <a href="<?= \yii\helpers\Url::to(
                    [
                        '/company/default/to-order',
                        'companyId' => Yii::$app->request->get('id'),
                        'tariffId' => $item->id,
                        'price' => $item->price,
                    ])
                ?>"
                   class="cabinet__packages--buy">заказать</a>
                <?else:?>
                <a  id="buy4" href="#stock4"
                   class="cabinet__packages--buy cabinet__packages--about">заказать</a>
                <?endif;?>
            </div>

        <?php $count++; endforeach; ?>
        <p class="cabinet__packages--notification">Нет, не нужно, я вооспользуюсь
            <a href="<?= \yii\helpers\Url::to(['/personal_area/user-company'])?>">бесплатным</a>
            размещением</p>
        <?php foreach ($tariff as $item): ?>
            <?php
            $services =  \common\models\db\TariffServicesRelations::find()
                ->where(['tariff_id' => $item->id])
                ->with('services')
                ->all();
            ?>

            <?php /*\common\classes\Debug::prn($services); */?>

            <?php if($item->id != 4): ?>
                <div id="stock<?= $item->id; ?>" class="cabinet__packages--hover-block">
                    <h3>Подключив тариф <span><?= $item->name; ?></span> вы получите:</h3>

                    <ul>
                        <?php foreach ($services as $val): ?>
                            <li><span class="descr"><?= $val['services']->name?></span><span class="val"><?/*= $val['services']->price*/?></span></li>
                        <?php endforeach; ?>

                        <li><span class="descr">Цена тарифа</span><span class="val"><?= $item->price; ?> руб/год</span></li>
                    </ul>
                    <a href="<?= \yii\helpers\Url::to(
                        [
                            '/company/default/to-order',
                            'companyId' => Yii::$app->request->get('id'),
                            'tariffId' => $item->id,
                            'price' => $item->price,
                        ])
                    ?>"
                       class="cabinet__packages--buy">заказать</a>
                </div>
            <?php else: ?>
                <div id="stock<?= $item->id; ?>" class="cabinet__packages--hover-block">

                    <h3>Настройте тариф <span><?= $item->name?></span>:</h3>

                    <ul>
                        <?php foreach ($services as $val): ?>
                        <li>
                            <input
                                service-id="<?= $val['services']->id;?>"
                                price="<?= $val['services']->price;?>"
                                type="checkbox"
                                name="custom-type"
                                id="<?= $val['services']->id;?>"
                                class="checkbox services-select"
                            >
                            <label for="<?= $val['services']->id; ?>" class="forcheck">
                                <span class="checked"></span>
                                <span class="descr"><?= $val['services']->name; ?></span>
                            </label>
                            <span class="val"><?= $val['services']->price; ?> руб.</span>
                        </li>
                        <?php endforeach; ?>
                        <li>
                            <span class="descr">Выбрано услуг</span>
                            <span class="val"><span class="count-select-services">0</span></span>
                            <span class="descr">Цена тарифа</span>
                            <span class="val"><span class="summ-select-services">0</span> руб/год</span>
                        </li>
                    </ul>

                    <a
                        data-href="<?= \yii\helpers\Url::to(
                            [
                                '/company/default/to-order',
                                'companyId' => Yii::$app->request->get('id'),
                                'tariffId' => $item->id,
                            ])
                        ?>"

                        href="#" class="cabinet__packages--buy servise-individual-order">заказать</a>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>


    </div>
</div>


