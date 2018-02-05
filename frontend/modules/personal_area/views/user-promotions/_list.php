<a href="" class="cabinet__like-block--section">Акции</a>

<a href="" class="cabinet__like-block--photo">
    <img src="<?= $model['photo']; ?>" alt="">
</a>

<a href="<?= \yii\helpers\Url::to(['/promotions/promotions/view', 'slug' => $model->slug]) ?>" class="cabinet__like-block--comment-descr"><?= $model['title']; ?></a>

<!--<span class="views">></span>-->

<div class="cabinet__pkg-block">

    <?php if($model['status'] == '0'): ?>
        <h3>Акция <span>опубликована</span></h3>
    <?php endif; ?>

    <?php if($model['status'] == '1'): ?>
        <h3>Акция <span>на модерации</span></h3>
    <?php endif; ?>



    <a href="<?= \yii\helpers\Url::to(['/promotions/promotions/update', 'id' => $model['id']])?>" class="cabinet__like-block--company-edit">редактировать</a>
    <a data-method="post" href="<?= \yii\helpers\Url::to(['/promotions/promotions/delete', 'id' => $model['id']]); ?>" data-confirm="Вы уверены, что хотите удалить этот элемент?" class="cabinet__like-block--company-remove">удалить</a>

</div>
<p class="cabinet__like-block--company-views">Дата проведения: <?= $model['dt_event'];?></p>
<p class="cabinet__like-block--company-views">Добавлено компанией: <?= $model['company']->name;?></p>
<!--

    <div class="cabinet__pkg-descr">

        <a href="" class="cabinet__like-block--photo">
            <img src="<?/*= $model['photo']; */?>" alt="">
        </a>

        <h3 class="cabinet__like-block--company-name"><?/*= $model['title']; */?></h3>

        <a href="<?/*= \yii\helpers\Url::to(['/promotions/promotions/update', 'id' => $model['id']]) */?>" class="cabinet__like-block--company-edit">редактировать</a>
        <a data-method="post" href="<?/*= \yii\helpers\Url::to(['/promotions/promotions/delete', 'id' => $model['id']]) */?>" class="cabinet__like-block--company-remove">удалить </a>

        <p class="cabinet__like-block--company-address"><?/*= \yii\helpers\StringHelper::truncate($model['descr'], 200)*/?></p>

        <div class="cabinet__like-block--company-views">
            <p>Дата проведения:
                <span><?/*= $model['dt_event']*/?></span>
            </p>
            <p>Добавлено компанией:
                <span><?/*=  $model['company']->name; */?></span>
            </p>
        </div>


    </div>

    <div class="cabinet__pkg-block">




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