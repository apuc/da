<?php
/**
 * @var $category \frontend\modules\shop\models\CategoryShop
 */

use yii\helpers\Html;
use yii\helpers\Url;

//\common\classes\Debug::prn($category);
?>
<?php
if ($this->beginCache('show_category_shop', ['duration' => Yii::$app->params['hours-for-cache']])){
    echo Html::a('text', Url::to(['/shop/shop/category', 'category' => ['elektronika', '1231'] ]));
    echo "<br>";
    echo Html::a('text', Url::to(['/shop/shop/product', 'slug' => 'shop']));
?>
<div class="shop__categories">

    <div class="shop__categories--title">
        <span>Категории</span>
        <a href="#">Смотреть все ></a>
    </div>

    <ul class="shop__categories--list">
        <?php foreach ($category[0] as $cat): ?>
        <li>
            <a href="<?= Url::to(['/shop/shop/category', 'category' => [$cat->slug] ])?>"><?= $cat->name; ?></a>
            <?php if (isset($category[$cat->id])): ?>
            <div class="shop__categories--sub-menu">
                <?php foreach ($category[$cat->id] as $catLv2): ?>
                <div class="column-sub-menu">
                    <a class="column-sub-menu__title" href="<?= Url::to(['/shop/shop/category', 'category' => [$cat->slug, $catLv2->slug] ])?>"><?= $catLv2->name; ?></a>
                    <?php if($category[$catLv2->id]): ?>
                    <div class="column-sub-menu__link">
                        <?php foreach ($category[$catLv2->id] as $catLv3): ?>
                            <a href="<?= Url::to(['/shop/shop/category', 'category' => [$cat->slug, $catLv2->slug, $catLv3->slug] ])?>"><?= $catLv3->name; ?></a>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </li>
        <?php endforeach;?>
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