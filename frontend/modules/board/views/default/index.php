<?php
/**
 * @var $ads
 * @var $category
 */


?>

<?php
/*    foreach ($ads as $item):
        //\common\classes\Debug::prn($item);
*/?><!--
        <?/*= \yii\helpers\Html::a($item->title, \yii\helpers\Url::to(['view', 'slug' => $item->slug, 'id' => $item->id])); */?>

    <?/*= $item->content; */?>
    <?/*= $item->price; */?>

    <?php /*if(!empty($item->adsImgs)): */?>
        <img src="<?/*= $item->adsImgs[0]->img_thumb*/?>" alt="">
    <?php /*else: */?>
        нет изображения
    <?php /*endif; */?>
--><?php
/*    endforeach;*/

?>

<!-- start commercial-ads.html-->
<section class="commercial">

    <div class="container">

        <div class="commercial__wrapper">

            <div class="commercial__content">

                <div class="commercial__category">

                    <div class="commercial__trigger">

                            <span class="commercial__trigger--title" data-id="0">
                                    Категории</span>
                        <span class="commercial__trigger--icon"></span>

                    </div>

                    <ul class="commercial__category-list">
                        <?php foreach ($category as $item): ?>
                            <li data-id="<?= $item->id;?>"><?= $item->name; ?></li>
                        <?php endforeach;?>
                    </ul>

                </div>

                <form id="commercial-ads-search-form" class="commercial__search-form">

                    <input type="text">

                    <input class="commercial__content--submit" type="submit" value="Найти">

                </form>

                <div class="commercial__content-sidebar">

                    <form class="commercial__sidebar-filter">

                        <div class="commercial__sidebar-filter--type">

                            <h3 class="title">Тип:</h3>

                            <div class="line-type">
                                <input id="type-2" name="private" type="checkbox" class="input-checkbox">
                                <label for="type-2" class="label-checkbox"></label>
                                <p class="text-type">частные</p>
                            </div>

                            <div class="line-type">
                                <input id="type-3" name="business" type="checkbox" class="input-checkbox">
                                <label for="type-3" class="label-checkbox"></label>
                                <p class="text-type">бизнес</p>
                            </div>

                        </div>

                        <div class="ad-charasteristics-form-priece">

                            <h3 class="ad-charasteristics-form-type-title">Стоимость:</h3>

                            <div id="options">
                                <label for="price">
                                    от
                                    <input type="text" selprice="2" name="minPrice" value="2" id="price" maxlength="10">
                                </label>
                                <label for="price2">
                                    до
                                    <input type="text" selprice="2147483647" name="maxPrice" value="2147483647"
                                           id="price2" maxlength="10">
                                </label>
                                <div id="slider_price"
                                     class="ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"
                                         style="left: 0%; width: 100%;"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"
                                          style="left: 0%;"></span>
                                    <span tabindex="0"class="ui-slider-handle ui-corner-all ui-state-default"
                                          style="left: 100%;"></span>
                                </div>

                            </div>
                        </div>

                        <input class="commercial__sidebar-filter--submit" type="submit" value="применить">

                    </form>

                </div>

                <div class="commercial__ads">

                    <div class="average-ad-item">

                        <a href="#" class="average-ad-item-thumb">
                            <img src="img/business/single-business1.png" alt="">
                        </a>

                        <div class="average-ad-item-content">

                                <span class="average-ad-price">1 500                                    <span class="rubl-icon">
										<svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 510.127 510.127">
											<path d="M34.786,428.963h81.158v69.572c0,3.385,1.083,6.156,3.262,8.322c2.173,2.18,4.951,3.27,8.335,3.27h60.502
												c3.14,0,5.857-1.09,8.152-3.27c2.295-2.166,3.439-4.938,3.439-8.322v-69.572h182.964c3.377,0,6.156-1.076,8.334-3.256
												c2.18-2.178,3.262-4.951,3.262-8.336v-46.377c0-3.365-1.082-6.156-3.262-8.322c-2.172-2.18-4.957-3.27-8.334-3.27H199.628v-42.754
												h123.184c48.305,0,87.73-14.719,118.293-44.199c30.551-29.449,45.834-67.49,45.834-114.125c0-46.604-15.283-84.646-45.834-114.125
												C410.548,14.749,371.116,0,322.812,0H127.535c-3.385,0-6.157,1.089-8.335,3.256c-2.173,2.179-3.262,4.969-3.262,8.335v227.896
												H34.786c-3.384,0-6.157,1.145-8.335,3.439c-2.172,2.295-3.262,5.012-3.262,8.151v53.978c0,3.385,1.083,6.158,3.262,8.336
												c2.179,2.18,4.945,3.256,8.335,3.256h81.158v42.754H34.786c-3.384,0-6.157,1.09-8.335,3.27c-2.172,2.166-3.262,4.951-3.262,8.322
												v46.377c0,3.385,1.083,6.158,3.262,8.336C28.629,427.887,31.401,428.963,34.786,428.963z M199.628,77.179h115.938
												c25.6,0,46.248,7.485,61.953,22.46c15.697,14.976,23.549,34.547,23.549,58.691c0,24.156-7.852,43.733-23.549,58.691
												c-15.705,14.988-36.354,22.473-61.953,22.473H199.628V77.179z"></path>
										</svg>
									</span>
                                </span>
                            <a href="/ads/router-tp-link-940n-novyj" class="average-ad-title">Роутер Tp link 940n НОВЫЙ</a>
                            <p class="average-ad-geo">
                                <span class="geo-space"></span>
                                <a class="addressAds" href="/search?regionFilter=21">ДНР</a> |
                                <a class="addressAds" href="/search?cityFilter=394">Донецк</a>
                            </p>
                            <div class="bottom-content">
                                <p class="average-ad-time">10 июля 2017 г. в 6:21</p>
                                <a href="/obyavleniya/elektronika" class="average-ad-category">Электроника</a>
                                <span class="separatorListCategory">|</span>                                                                        <a href="/obyavleniya/aksessuaryi-i-komplektuyuschie" class="average-ad-category">Аксессуары и комплектующие</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="business__sidebar stock" id="commercial-stock-sidebar">

                <h3>Лучшие предложения</h3>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит
                                <small>с 01.01.2017</small>
                            </p>
                            <!-- <a href="">подробнее</a>-->
                        </div>

                    </div>
                </a>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит
                                <small>с 01.01.2017</small>
                            </p>
                            <!-- <a href="">подробнее</a>-->
                        </div>

                    </div>
                </a>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит
                                <small>с 01.01.2017</small>
                            </p>
                            <!-- <a href="">подробнее</a>-->
                        </div>

                    </div>
                </a>

            </div>

        </div>

    </div>

</section>
<!-- end commercial-ads.html-->
