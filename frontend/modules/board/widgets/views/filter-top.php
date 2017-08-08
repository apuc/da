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

        <ul>
            <span class="republic selectCity" city-id="999">Буйнакск</span>
            <span class="republic selectCity" city-id="3012">Каспийск</span>
            <span class="republic selectCity" city-id="1456">Кизляр</span>
            <span class="republic selectCity" city-id="1827">Махачкала</span>
            <span class="republic selectCity" city-id="2513">Хасавюрт</span>
        </ul>

    </div>

    <input type="hidden" name="regionFilter">
    <input type="hidden" name="cityFilter">
    <input type="hidden" name="mainCat">
    <input type="hidden" name="textFilter">
    <button class="button-search searchForm">Найти</button>
</form>