<?php
/**
 * @var $category
 * @var $title
 */
use common\classes\AdsCategory;
?>
<h3 class="title title-change"><?= $title; ?></h3>
<div class="obvertka style-scroll">
<?php

foreach ($category as $item) :?>
    <span class="heading heading-change" data-category="<?= $item->id?>">
        <?= $item->name; ?>
    </span>
<?php endforeach; ?>
</div>