<?php
/**
 * @var $category
 */
//\common\classes\Debug::prn($category);
?>



<div class="check-category">
    <div class="check-thumb">
        <img src="http://rub-on.ru<?= $category[0];?>" />
    </div>
    <div class="check-title myBtn1">
        <?php
        array_shift($category);
        foreach($category as $key=>$item):
        ?>
        <?= $item; ?> <?= ($key == count($category)-1) ? '' : '-'?>
        <!--Детский мир - Детская одежда - Одежда для мальчиков-->
        <?php endforeach;
        ?>
    </div>
</div>

<div class="btnCategoryEdit"><span class="select-category-add">Изменить</span></div>
