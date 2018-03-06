<?php
/**
 * @var array $stocks
 * @var array $placeStock
 * @var \common\models\db\Stock $stock
 */

use common\classes\GeobaseFunction;
use yii\helpers\Url;

?>

<?php
foreach ($stocks as $stock): ?>
    <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $stock->slug]) ?>">
        <div class="all-actions__item">
            <div class="all-actions__img">
                <img src="<?= $stock->photo ?>" alt="">
            </div>
            <h2 class="all-actions__title-item"><?= $stock->title; ?>
                <span class="all-actions__title-item--view"><?= $stock->view; ?></span>
            </h2>
            <div class="all-actions__company">
                <div class="all-actions__company--img">
                    <img src="<?= $stock->company->photo ?>"
                         alt="<?= !empty($stock->company->alt) ? $stock->company->alt : $stock->company->name ?>">
                </div>
                <h3 class="all-actions__company--title">
                    <a href="<?= Url::to(['/company/company/view', 'slug' => $stock['company']->slug]); ?>">
                        <?= $stock->company->name ?>
                    </a>
                </h3>
                <div class="all-actions__company--addres">
                    <?php
                    if ($stock->company->region_id != 0)
                        echo GeobaseFunction::getRegionName($stock->company->region_id) . ', ' . GeobaseFunction::getCityName($stock->company->city_id) . ', ' . $stock->company->address;
                    else
                        echo $stock->company->address;
                    ?>
                </div>
            </div>
            <div class="all-actions__description">
                <?php
                if ($stock->short_descr) echo $stock->short_descr;
                elseif (!empty($stock->descr)) echo mb_substr($stock->descr, 0, 110) . '...';
                ?>
            </div>
            <div class="all-actions__bottom">
                <a href="<?= Url::to(['/promotions/promotions/view', 'slug' => $stock->slug]) ?>"
                   class="all-actions__bottom--more">Подробнее</a>
                <a href="#" class="all-actions__bottom--comments">Добавить коментарий</a>
                <span class="all-actions__bottom--sale"><?= $stock->dt_event_description; ?></span>
            </div>
            <?php if ($stock->recommended == 1): ?>
                <div class="all-actions__favorites"></div>
            <?php endif; ?>
        </div>
    </a>
<?php endforeach; ?>