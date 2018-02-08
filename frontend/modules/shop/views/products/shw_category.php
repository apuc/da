<?php
/**
 * @var $category
 * @var $title
 */
?>
<h3 class="title title-change"><?= $title; ?></h3>
<div class="obvertka style-scroll">
<?php

foreach ($category as $item) :?>
    <span class="heading heading-change" data-category="<?= $item->id?>" datatype="product">
        <?= $item->name; ?>
    </span>
<?php endforeach; ?>
</div>