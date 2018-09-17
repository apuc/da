<?php
/**
 * @var $category \frontend\modules\shop\models\CategoryShop
 */
?>

<?php foreach($category as $item): ?>
    <div class="modal-body__container modal-item" data-category="<?= $item->id; ?>" datatype="product">
        <div class="modal-body__container__img thumb">
            <img src="<?= $item->icon; ?>" alt="">
        </div>
        <span class="modal-body__container__subtitle"><?= $item->name; ?></span>
    </div>
<?php endforeach; ?>
