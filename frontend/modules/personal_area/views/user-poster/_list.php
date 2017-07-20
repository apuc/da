

<a href="<?= \yii\helpers\Url::to(['/poster/default/view', 'slug' => $model['slug']])?>" class="cabinet__like-block--section">Новости</a>

<a href="<?= \yii\helpers\Url::to(['/poster/default/view', 'slug' => $model['slug']])?>" class="cabinet__like-block--photo">
    <img src="<?= $model['photo']; ?>" alt="">
</a>

<a href="<?= \yii\helpers\Url::to(['/poster/default/view', 'slug' => $model['slug']])?>" class="cabinet__like-block--comment-descr"><?= $model['title']; ?></a>

<div class="cabinet__pkg-block">

    <?php if($model['status'] == '0'): ?>
        <h3>Афиша <span>опубликована</span></h3>
    <?php endif; ?>

    <?php if($model['status'] == '1'): ?>
        <h3>Афиша <span>на модерации</span></h3>
    <?php endif; ?>

    <span class="views"><?= $model->views; ?></span>

    <?php if($model['dt_event'] > time()):?>
        <a class="cabinet__like-block--company-edit">редактировать</a>
        <a data-method="post" href="<?= \yii\helpers\Url::to(['/poster/default/delete', 'id' => $model['id']]); ?>" class="cabinet__like-block--company-remove">удалить</a>
    <?php endif; ?>

    <?php if($model['dt_event_end'] < time()):?>
        <a data-method="post" href="<?= \yii\helpers\Url::to(['/poster/default/delete', 'id' => $model['id']]); ?>" class="cabinet__like-block--company-remove">удалить</a>
    <?php endif; ?>

    <?php if($model['dt_event'] < time() && $model['dt_event_end'] > time()): ?>
        <p>Управление афишей запрещено т.к. мероприятие сейчас идет</p>
    <?php endif;?>

</div>



