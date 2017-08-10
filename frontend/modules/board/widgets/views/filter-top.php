<?php
?>

<div class="commercial__category">
    <div class="commercial__trigger">
        <span class="commercial__trigger--title" data-id="<?= empty($currentCategory) ? 0 : $currentCategory->id; ?>?>">
            <?php
            if(empty($currentCategory)){
                echo 'Выбрать категорию';
            }else{
                echo $currentCategory->name;
            } ?>
        </span>
        <span class="commercial__trigger--icon"></span>
    </div>
    <ul class="commercial__category-list">
        <?php foreach ($category as $item): ?>
            <li data-id="<?= $item->id; ?>"><?= $item->name; ?></li>
        <?php endforeach; ?>
    </ul>

</div>

<form class="commercial__search-form" action="" method="get">

    <input type="text" class="input-search textSearch" value="<?= (isset($get['textFilter'])) ? $get['textFilter'] : ''?>" placeholder="Поиск по объявлениям">

    <div class="region">
        <span class="location-mark"></span>
        <span class="textSelectRegion">
            <?php if(empty($currentRegion)): ?>
                Выберите область
            <?php else:?>
                <?= $currentRegion->name; ?>
            <?php endif; ?>
        </span>
    </div>

    <div class="region-list">

        <span class="republic selectRegion" reg-id="21">ДНР</span>
        <span class="republic selectRegion" reg-id="19">ЛНР</span>
        <span class="russia">Россия</span>

        <div class="russia-list">
            <ul>
                <?php foreach ($region as $item): ?>
                    <span class="republic selectRegion" reg-id="<?= $item->id; ?>"><?= $item->name; ?></span>
                <?php endforeach;?>
            </ul>
        </div>
    </div>

    <div class="city" style="<?= (Yii::$app->request->get('regionFilter')) ? 'display: inline-block;' : ''?>">
        <span class="hotel-icon"></span>
        <span class="textSelectCity">
            <?php if(empty($currentCity)): ?>
                Выберите город
            <?php else:?>
                <?= $currentCity->name; ?>
            <?php endif; ?>
        </span>
    </div>

    <div class="city-list">

        <ul>
            <?php if(!empty($cityList)): ?>
                <?php foreach ($cityList as $item): ?>
                    <span class="republic selectCity" city-id="<?= $item->id?>"><?= $item->name; ?></span>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

    </div>


    <button class="button-search searchForm">Найти</button>
</form>