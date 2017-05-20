<?php ?>

<section class="search-panel">

    <div class="container">

        <form action="" class="search-panel__form">

            <h1>Результаты поиска</h1>

            <input class="search-panel__field" type="text" placeholder="<?= $request; ?>">
            <input type="submit" id="search-form-submit" class="search-panel__submit" value="Найти">

        </form>

        <div class="search-panel__result">

            <p><span>По запросу "<?= $request; ?>" найдено <span class="counter"><?= array_sum($resultsCount); ?></span> результатов. Показывать результаты</span><a
                        href="#" class="js-search-option">за все время</a>
                <span class="search-panel__result--option">
                    <a href="#">за все время</a>
                    <a href="#">за год</a>
                    <a href="#">за месяц</a>
                    <a href="#">за неделю</a>
                    <a href="#">за день</a>
                 </span>
                <span class="triangle"></span>
            </p>

        </div>

    </div>

</section>

<section class="search-content">

    <div class="container">

        <div class="search-content__wrapper">

            <ul class="search-content__breadcrumbs">
                <?php //foreach ($resultsCount as $item): ?>


                <li><a href="#">Все материалы <span>4034</span></a></li>
                <li><a href="#">Блог <span>1026</span></a></li>
                <li><a href="#">Документ <span>7</span></a></li>
                <li><a href="#">Опрос <span>17</span></a></li>
                <li><a href="#">Новости <span>2089</span></a></li>
                <li><a href="#">Эфир <span>895</span></a></li>
            </ul>

            <div class="search-content__items">

                <a href="#" class="search-content__item">

                    <p class="search-content__item--title">Новости</p>

                    <div class="search-content__item--img">
                        <img src="/theme/portal-donbassa/img/home-content/1pic.jpg" alt="">
                    </div>

                    <div class="search-content__item--content">

                        <h3>В Крыму ситуация может скоро выйти из под контроля</h3>
                        <span>20 января</span>
                        <p>… крымчане наблюдают уже в российском Крыму. Крым превращается в непонятно что и …
                            референдума.. В последнее время, в Крыму появилось очень много украинских номеров …
                            прекрасно. Фото сделаны напротив Совмина Крыма. Крымчане сейчас не могут ездить …</p>

                    </div>

                </a>

                <a href="#" class="search-content__item">

                    <p class="search-content__item--title">Афиша</p>

                    <div class="search-content__item--img">
                        <img src="/theme/portal-donbassa/img/home-content/2pic.jpg" alt="">
                    </div>

                    <div class="search-content__item--content">

                        <h3>В Крыму Мангал Party в «Ё-Моё»</h3>
                        <span>20 января</span>
                        <p>… крымчане наблюдают уже в российском Крыму. Крым превращается в непонятно что и …
                            референдума.. В последнее время, в Крыму появилось очень много украинских номеров …
                            прекрасно. Фото сделаны напротив Совмина Крыма. Крымчане сейчас не могут ездить …</p>

                    </div>

                </a>

                <a href="#" class="search-content__item">

                    <p class="search-content__item--title">Предприятия</p>

                    <div class="search-content__item--img">
                        <img src="/theme/portal-donbassa/img/home-content/3pic.jpg" alt="">
                    </div>

                    <div class="search-content__item--content">

                        <h3>В Крыму ситуация может скоро выйти из под контроля</h3>
                        <span>20 января</span>
                        <p>… крымчане наблюдают уже в российском Крыму. Крым превращается в непонятно что и …
                            референдума.. В последнее время, в Крыму появилось очень много украинских номеров …
                            прекрасно. Фото сделаны напротив Совмина Крыма. Крымчане сейчас не могут ездить …</p>

                    </div>

                </a>

            </div>

        </div>

    </div>

</section>
