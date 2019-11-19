<?php
/**
 * @var $category \frontend\modules\shop\models\CategoryShop
 */

use yii\helpers\Html;
use yii\helpers\Url;

//\common\classes\Debug::prn($category);
?>


<?php
if ($this->beginCache('show_category_shop', ['duration' => Yii::$app->params['hours-for-cache']])) {
    /*echo Html::a('text', Url::to(['/shop/shop/category', 'category' => ['elektronika', '1231'] ]));
    echo "<br>";
    echo Html::a('text', Url::to(['/shop/shop/product', 'slug' => 'shop']));*/
    ?>
    <section class="mobile-second-menu">
        <button class="change-shop-categories jsChangeShopCategoriesMob">
            <span class="jsChangeTextMob">Категории магазинов ДНР</span>
            <img src="/theme/portal-donbassa/img/refresh.svg" alt="">
        </button>
        <div class="mobile-second-menu__header">
            <div class="header-m-arrow"></div>
            <span>Каталог</span> <a href="#" class="header-close"><img
                        src="/theme/portal-donbassa/img/second-menu/close.svg" alt=""></a>
        </div>
        <div class="mobile-second-menu__wrap jsShopCategoriesMob">
            <ul class="mobile-menu-lvl-1">

                <?php
                $categ = [];
                foreach ($category[0] as $cat): ?>
                    <?php
                    if (isset($category[$cat->id])) {
                        $categ[$cat->id]['child'] = $cat->id;
                        $categ[$cat->id]['slug'] = $cat->slug;
                    }
                    ?>
                    <li data-menu-id="<?= $cat->id; ?>">
                        <a href="<?= Url::to(['/shop/shop/category', 'category' => [$cat->slug]]) ?>">
                            <img src="/theme/portal-donbassa/img/second-menu/icon1.svg" alt="">
                            <?= $cat->name; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php
            if (!empty($categ)) {
                $categChild = [];
                foreach ($categ as $item): ?>

                    <ul class="mobile-menu-lvl-2" data-menu-id="<?= $item['child']; ?>">
                        <?php foreach ($category[$item['child'] ] as $value): ?>
                            <?php
                            if (isset($category[$value->id])) {
                                $categChild[$value->id]['child'] = $value->id;
                                $categChild[$value->id]['slug'] = $value->slug;
                                $categChild[$value->id]['parent-slug'] = $categ[$value->parent_id]['slug'];
                            }
                            ?>
                            <li data-menu-id=<?=$value->id?>>
                                <a href="<?= Url::to(['/shop/shop/category', 'category' => [$item['slug'],$value->slug]]) ?>">
                                    <?= $value->name; ?>
                                </a>
                            </li>
                        <?php endforeach ;
                        ?>

                    </ul>
                <?php endforeach;
            }
            ?>
            <?php if (!empty($categChild)) {
                foreach ($categChild as $item): ?>
                    <ul class="mobile-menu-lvl-3" data-menu-id="<?= $item['child']?>">
                        <?php foreach ($category[$item['child']] as $val): ?>
                            <li>
                                <a href="<?= Url::to(['/shop/shop/category', 'category' => [$item['parent-slug'], $item['slug'], $val->slug]]) ?>">
                                    <?= $val->name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endforeach;
            } ?>
        </div>

    </section>
    <div class="shop__categories">

        <button class="change-shop-categories jsChangeShopCategories">
            <span class="jsChangeText">Категории магазинов ДНР</span>
            <img src="/theme/portal-donbassa/img/refresh.svg" alt="">
        </button>

        <div class="shop__categories--title">
            <span>Категории</span>
            <a href="<?= Url::to(['/shop/shop/index']); ?>">Смотреть все ></a>
        </div>

        <ul class="shop__categories--list jsShopCategories">
            <?php foreach ($category[0] as $cat): ?>
                <li>
                    <a href="<?= Url::to(['/shop/shop/category', 'category' => [$cat->slug]]) ?>"><?= $cat->name; ?></a>
                    <?php if (isset($category[$cat->id])): ?>
                        <div class="shop__categories--sub-menu">
                            <?php foreach ($category[$cat->id] as $catLv2): ?>
                                <div class="column-sub-menu">
                                    <a class="column-sub-menu__title" href="<?= Url::to([
                                        '/shop/shop/category',
                                        'category' => [$cat->slug, $catLv2->slug],
                                    ]) ?>"><?= $catLv2->name; ?></a>
                                    <?php if (!empty($category[$catLv2->id])): ?>
                                        <div class="column-sub-menu__link">
                                            <?php foreach ($category[$catLv2->id] as $catLv3): ?>
                                                <a href="<?= Url::to([
                                                    '/shop/shop/category',
                                                    'category' => [$cat->slug, $catLv2->slug, $catLv3->slug],
                                                ]) ?>"><?= $catLv3->name; ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
            <!--<li>
                <a href="#">Электроника</a>
                <div class="shop__categories--sub-menu">
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Аксессуары для телефонов</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Избранные бренды</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                </div>
            </li>
            <li>
                <a href="#">Бытовая техника</a>
                <div class="shop__categories--sub-menu">
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Аксессуары для телефонов</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Избранные бренды</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>


                </div>
            </li>
            <li><a href="#">Телефоны и аксессуары</a>
                <div class="shop__categories--sub-menu">
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Аксессуары для телефонов</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Избранные бренды</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                </div>
            </li>
            <li><a href="#">Одежда для женщин</a>
                <div class="shop__categories--sub-menu">
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Аксессуары для телефонов</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Избранные бренды</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>


                </div>
            </li>
            <li><a href="#">Одежда для мужчин</a>
                <div class="shop__categories--sub-menu">
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Аксессуары для телефонов</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Избранные бренды</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>

                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title" href="#">Популярные категории</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Куртки и пальто</a>
                        <div class="column-sub-menu__link menu-brands">
                            <a href="#">
                                <img src="img/shop/brands/1.png" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/2.png" alt="">
                            </a>
                            <a href="#" >
                                <img src="img/shop/brands/3.jpg" alt="">
                            </a>
                            <a href="#">
                                <img src="img/shop/brands/4.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="column-sub-menu">
                        <a class="column-sub-menu__title hot" href="#">Tmall | Доставка от 2 дней</a>
                        <div class="column-sub-menu__link">
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                            <a href="#">Lorem ipsum.</a>
                        </div>
                    </div>

                </div></li>
            <li><a href="#">Бижутерия и часы</a></li>
            <li><a href="#">Сумки и обувь</a></li>
            <li><a href="#">Для дома и сада</a></li>
            <li><a href="#">Автотовары</a></li>
            <li><a href="#">Красота и здоровье</a></li>
            <li><a href="#">Спорт и развлечения</a></li>-->

        </ul>


    </div>

    <?php
    $this->endCache();
}