

    <div class="cabinet__pkg-descr">

        <div class="cabinet__like-block--company-photo">
            <img src="<?= $model['photo']?>" alt="">
        </div>

        <h3 class="cabinet__like-block--company-name"><?= $model['name']; ?></h3>

        <a href="#" class="cabinet__like-block--company-edit">редактировать</a>
        <a href="#" class="cabinet__like-block--company-remove">удалить </a>

        <p class="cabinet__like-block--company-address"><?= $model['address']; ?></p>

        <p class="cabinet__like-block--company-views">Количество посетителей

            <span class="views"><?= $model['views']; ?></span>
            <!--<span class="date">30 дней:</span>-->
        </p>



    </div>

    <div class="cabinet__pkg-block">

        <?php if($model['status'] == 1): ?>
            <h3>Предприятие <span>на модерации</span></h3>
            <p class="notice">Ваше предприятие будет
                опубликована как только пройдет
                модерацию</p>
        <?php endif; ?>

        <?php if($model['status'] == 0): ?>
            <p class="cabinet__pkg-block--type"><?= $model['tariff']->name?></p>

            <!--<p class="cabinet__pkg-block--period">до <span>23.05.2015 (еще 1 месяц)</span></p>-->

            <a href="<?= \yii\helpers\Url::to(['/company/default/set-tariff-company', 'id' => $model['id']])?>" class="cabinet__like-block--company-edit">сменить тариф</a>
        <?php endif; ?>

    </div>



<!--<div class="cabinet__like-block">

    <div class="cabinet__pkg-descr">

        <div class="cabinet__like-block--company-photo">
            <img src="img/cabinet/cabinet-logo.png" alt="">
        </div>

        <h3 class="cabinet__like-block--company-name">Министерство доходов и сборов ДНР</h3>

        <a href="#" class="cabinet__like-block--company-edit">редактировать</a>
        <a href="#" class="cabinet__like-block--company-remove">удалить</a>

        <p class="cabinet__like-block--company-address">г. Донецк, ул. Артёма, 114</p>

        <p class="cabinet__like-block--company-views">Количество посетителей

            <span class="views">3 000</span>
            <!--<span class="date">30 дней:</span>
        </p>

    </div>

    <div class="cabinet__pkg-block">

        <h3>Предприятие <span>на модерации</span></h3>

        <p class="cabinet__pkg-block--type">Пакет Базовый</p>

        <p class="cabinet__pkg-block--period">до <span>23.05.2015 (еще 1 месяц)</span></p>

        <a href="#" class="cabinet__like-block--company-edit">сменить тариф</a>

        <p class="notice">Ваше предприятие будет
            опубликована как только пройдет
            модерацию</p>

    </div>

</div>-->