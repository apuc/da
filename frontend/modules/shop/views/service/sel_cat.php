<?php
/**
 * @var $category
 * @var $parent_category
 * @var $title
 */

?>

<div class="column column-change column-modal header-rubric" data-parent="0" >
    <h3 class="title">Рубрики</h3>
    <div class="obvertka obvertka-first style-scroll">
        <?php foreach($category as $item): ?>
            <span class="heading heading-change <?= ($item->id == $id) ? 'active' : ''?>" data-category="<?= $item->id?>" datatype="product">
                <?= $item->name; ?>
            </span>
        <?php endforeach;?>
    </div>
</div>
<div class="column column-change column-modal" data-parent="1">
    <h3 class="title title-change"><?= $title; ?></h3>
    <div class="obvertka style-scroll second-change-column">
        <?php foreach($parent_category as $item): ?>
            <span class="heading heading-change" data-category="<?= $item->id?>" datatype="product">
                <?= $item->name; ?>
            </span>
        <?php endforeach;?>
    </div>
</div>
<div class="column column-change column-modal last-change-column" data-parent="2">
    <!--<h3 class="title title-change">заголовок</h3>

    <span class="heading heading-change">рубрика<span class="caret"></span></span>-->
</div>
