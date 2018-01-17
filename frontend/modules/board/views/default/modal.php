<?php
/**
 * @var $category
 */
?>

<?php foreach($category as $item): ?>
    <div class="modal-body__container modal-item" data-category="<?= $item->id; ?>">
        <div class="modal-body__container__img thumb">
            <img src="http://rub-on.ru<?= $item->icon; ?>" alt="">
        </div>
        <span class="modal-body__container__subtitle"><?= $item->name; ?></span>
    </div>
<?php endforeach; ?>
