<?php
/** @var Stock $item
 * @var array $stock
 */

use common\classes\GeobaseFunction;
use frontend\modules\promotions\models\Stock;
use frontend\widgets\CompanyRight;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = "Акции - DA Info";
$this->registerJsFile('/js/stock.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->params['breadcrumbs'][] = 'Акции';

?>

<section class="breadcrumbs-wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
    </div>
</section>
<section class="all-actions">
    <div class="container">
        <div class="all-actions__wrapper">
            <div class="all-actions__header">
                <h1 class="all-actions__title">Все акции компаний</h1>
                <form action="#">
                    <button class="all-actions__button-search"></button>
                    <input type="search" class="all-actions__search" placeholder="Поиск">
                    <ul class="all-actions__select">
                        <li class="init">Текущие и будущие акции</li>
                        <li data-value="value 1">Акции за вчера: 25 января</li>
                        <li data-value="value 2">Акции за сегодня: 26 января</li>
                        <li data-value="value 3">Акции за завтра: 27 января</li>
                        <li>Акции на
                            <input type="text" placeholder="26-01-20">
                            <button>Применить</button>
                        </li>
                    </ul>
                </form>

            </div>
            <div class="all-actions__content">
                <div class="all-actions__desc">
                    У нас Вы найдете информацию об акциях и скидках компаний на электронику, бытовую технику,
                    строительные материалы, мебель, косметику, товары для дома и офиса, услуги и многое другое, то есть
                    всё, что продается в магазинах Вашего города.
                </div>
                <?php
                $k = 1;

                foreach ($stock as $item): ?>
                    <!--                --><?php //Debug::prn($item); if(in_array($k, $placeStock)):?>
                    <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>">
                        <div class="all-actions__item">
                            <div class="all-actions__img">
                                <img src="<?= $item->photo ?>" alt="">
                            </div>
                            <h2 class="all-actions__title-item"><?= $item->title; ?>
                                <span class="all-actions__title-item--view"><?= $item->view; ?></span>
                            </h2>
                            <div class="all-actions__company">
                                <div class="all-actions__company--img">
                                    <img src="<?= $item->company->photo ?>" alt="">
                                </div>
                                <h3 class="all-actions__company--title">
                                    <a href="<?= Url::to(['/company/company/view', 'slug' => $item['company']->slug]); ?>">
                                        <?= $item->company->name ?>
                                    </a>
                                </h3>
                                <div class="all-actions__company--addres">
                                    <?php
                                    if ($item->company->region_id != 0)
                                        echo GeobaseFunction::getRegionName($item->company->region_id) . ', ' . GeobaseFunction::getCityName($item->company->city_id) . ', ' . $item->company->address;
                                    else
                                        echo $item->company->address;
                                    ?>
                                </div>
                            </div>
                            <div class="all-actions__description"><?= $item->short_descr; ?></div>
                            <div class="all-actions__bottom">
                                <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $item->slug]) ?>"
                                   class="all-actions__bottom--more">Подробнее</a>
                                <a href="#" class="all-actions__bottom--comments">Добавить коментарий</a>
                                <span class="all-actions__bottom--sale"><?= $item->dt_event; ?></span>
                            </div>
                            <div class="all-actions__favorites"></div>
                        </div>
                    </a>
                    <!--                    --><?php //endif; ?>
                    <?php $k++; endforeach; ?>


                <a href="" data-step="1" id="load-more-company" class="show-more">загрузить больше</a>

            </div>

        </div>

        <?= CompanyRight::widget(); ?>

    </div>
</section>

