<?php
if (!empty($stock)): ?>

<h3 class="main-title">следите за акциями</h3>

<div class="dev__elements--news">
    <?php foreach ($stock as $item): ?>
    <a href="<?= $item->link ?>" class="stock__item">
        <div class="stock__item_visible">
            <div class="thumb">
                <img src="<?= $item->photo ?>" alt="">
                <span class="time-icon"></span>
            </div>
            <div class="stock__item_label">
                <p><?= $item->short_descr ?></p>
            </div>
            <div class="content"><p><?= $item->dt_event ?></p>

                <!--<p> Акция проходит <small>с 01.01.2017</small> </p>-->
                <!-- <a href="">подробнее</a>-->
            </div>

        </div>
    </a>
    <?php endforeach; ?>
</div>
<?php
endif;