<?php
/**
 * @var $model \frontend\modules\shop\models\Products
 */
?>

<a href="" class="cabinet__like-block--section">Товар</a>

<a href="" class="cabinet__like-block--photo">
    <?php if (!empty($model['cover'])): ?>
        <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['cover']); ?>" alt="<?= $model['title']; ?>">
    <?php else: ?>
        <?php if(!empty($model['images'][0]->img_thumb)): ?>
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($model['images'][0]->img_thumb); ?>">
        <?php else:?>
            <img src="<?= \common\models\UploadPhoto::getImageOrNoImage( $model['cover']); ?>" alt="<?= $model['title']; ?>">
        <?php endif; ?>
        <!--<img src="<?/*= \common\models\UploadPhoto::getImageOrNoImage('/' . $model['images'][0]->img_thumb); */?>">-->
    <?php endif; ?>
</a>

<a href="<?= \yii\helpers\Url::to(['/shop/shop/show', 'slug' => $model['slug']])?>" class="cabinet__like-block--comment-descr"><?= $model['title']; ?></a>


<div class="cabinet__pkg-block">

    <?php if($model['status'] == '1'): ?>
        <h3>Товар <span>опубликован</span></h3>
    <?php endif; ?>

    <?php if($model['status'] == '0'): ?>
        <h3>Товар <span>на модерации</span></h3>
    <?php endif; ?>



    <a href="<?= \yii\helpers\Url::to(['/shop/products/update', 'id' => $model['id']]); ?>" class="cabinet__like-block--company-edit">редактировать</a>
    <a data-method="post" href="<?= \yii\helpers\Url::to(['/shop/products/delete', 'id' => $model['id'], 'page' => Yii::$app->request->get('page')]); ?>" data-confirm="Вы уверены, что хотите удалить этот элемент?" class="cabinet__like-block--company-remove">удалить</a>

</div>
<!--<p class="cabinet__like-block--company-views">Дата проведения: <?/*= $model['dt_event'];*/?></p>-->
<p class="cabinet__like-block--company-views">Добавлено компанией: <?= $model['company']->name;?></p>

<?php
//\common\classes\Debug::prn($model);