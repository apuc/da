<div class="promotions-sidebar" id="promotion-sidebar">
    <?= $this->render('_currency_chart', ['count_day' => 14]); ?>
    <br>

    <?= $this->render('_coin_chart', ['count_day' => 14]); ?>
    <br>

    <?= $this->render('_metal_chart', ['count_day' => 14]); ?>
    <br>

    <?= $this->render('_oil_chart', ['count_day' => 14]); ?>
    <br>

    <?= $this->render('_gas_chart', ['count_day' => 14]); ?>
    <br>

</div>