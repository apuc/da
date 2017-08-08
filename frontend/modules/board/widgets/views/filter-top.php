<div class="commercial__category">
    <div class="commercial__trigger">
        <span class="commercial__trigger--title" data-id="0">Категории</span>
        <span class="commercial__trigger--icon"></span>
    </div>
    <ul class="commercial__category-list">
        <?php foreach ($category as $item): ?>
            <li data-id="<?= $item->id; ?>"><?= $item->name; ?></li>
        <?php endforeach; ?>
    </ul>

</div>

<form class="commercial__search-form" action="" method="get">

    <input type="text" class="input-search textSearch" value="" placeholder="Поиск по объявлениям">

    <div class="region">
        <span class="location-mark"></span>
        <span class="textSelectRegion">Выберите область</span>
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

    <div class="city" style="">
        <span class="hotel-icon"></span>
        <span class="textSelectCity">Выберите город</span>
    </div>

    <div class="city-list">



    </div>


    <button class="button-search searchForm">Найти</button>
</form>