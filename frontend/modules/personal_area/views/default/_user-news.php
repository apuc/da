<?php

/**
 * @var $userNews \common\models\db\News
 */
use yii\helpers\Html;
?>

<div class="cabinet__inner-box">
    <h3>Мои новости</h3>
    <a href="<?= \yii\helpers\Url::to(\yii\helpers\Url::to(['/news/news/create'])); ?>" class="cabinet__inner-box--add">
        добавить
        <span>
            <img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt="">
        </span>
    </a>
    <?php if(!empty($userNews)): ?>
    <?php foreach ($userNews as $new): ?>
            <div href="#" class="news__wrap_item-sm-hot">
                <!-- thumb -->
                <div class="thumb">

                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($new->photo); ?>" alt="">

                </div>
                <!-- thumb -->
                <div class="hover-wrap">
                    <!--<span class="category"><span class="category-star"></span>ГОРЯЧЕЕ</span>-->
                    <h2><!--<a href="">--><?= $new->title; ?>
                        <!--</a>--></h2>
                </div>

                <div class="cabinet__inner-box--toolth">

                    <a data-method="post" href="<?= \yii\helpers\Url::to(['/news/news/delete', 'id' => $new->id]); ?>">
                        <img src="/theme/portal-donbassa/img/icons/cabinetd-delete-icon.png" alt="" title="Удалить">
                    </a>
                    <a href="">
                        <img src="/theme/portal-donbassa/img/icons/cabinet-edit-icon.png" alt="" title="Редактировать">
                    </a>
                    <a target="_blank" href="<?= \yii\helpers\Url::to(['/news/default/view', 'slug' => $new->slug]); ?>">
                        <img src="/theme/portal-donbassa/img/icons/cabinet-show-icon.png" alt="" title="Посмотреть">
                    </a>

                </div>

            </div>
    <?php endforeach; ?>
    <?php else: ?>
        <div class="cabinet__add-element">
            <p>Раздел пока пуст</p>
            <?= Html::a('Добавить', \yii\helpers\Url::to(['/news/news/create']), ['class' => 'show-more']);?>
        </div>
    <?php endif; ?>

</div>