<?php
/** @var Stock $model */

use common\classes\GeobaseFunction;
use frontend\modules\promotions\models\Stock;
use frontend\widgets\CompanyRight;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => Url::to(['/promotions'])];
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="breadcrumbs-wrap">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>
    </div>
</section>
<section class="single-actions">
    <div class="container">
        <div class="single-actions__wrapper">
            <div class="all-actions__header">
                <h1 class="all-actions__title"><?= $model->title ?></h1>
                <form action="#">
                    <button class="all-actions__button-search"></button>
                    <input type="search" class="all-actions__search" placeholder="Поиск">
                </form>
            </div>
            <div class="single-actions__single-item">
                <div class="all-actions__img">
                    <img src="<?= $model->photo ?>" alt="">
                    <span class="single-actions__prom-cod">ПРОМО КОД: 27-12-16</span>
                </div>
                <a href="#">
                    <div class="all-actions__company">
                        <div class="all-actions__company--img">
                            <img src="<?= $model->company->photo ?>" alt="">
                        </div>
                        <h3 class="all-actions__company--title">
                            <a href="<?= Url::to(['/company/company/view', 'slug' => $model->company->slug]); ?>">
                                <?= $model->company->name ?>
                            </a></h3>
                        <div class="all-actions__company--addres">
                            <?php
                            if ($model->company->region_id != 0)
                                echo GeobaseFunction::getRegionName($model->company->region_id) . ', ' . GeobaseFunction::getCityName($model->company->city_id) . ', ' . $model->company->address;
                            else
                                echo $model->company->address;
                            ?>
                        </div>
                    </div>
                </a>
                <div class="single-actions__wrap">
                    <h2 class="all-actions__title-item">Описание акции
                        <span class="all-actions__title-item--view">5</span>
                    </h2>
                    <p class="single-actions__desc">
                        <?= $model->short_descr ?>
                    </p>
                </div>
                <div class="single-actions__contacts">
                    <h2 class="all-actions__title-item">Контакты</h2>
                    <span class="single-actions__name"><?= $model->company->name ?></span>
                    <?php if (!empty($phones)): ?>
                        <?php foreach ($phones as $phone): ?>
                            <span class="single-actions__phone"><?= $phone->phone ?></span>
                        <?php endforeach; ?>
                    <?php elseif (!empty($model->phone)): ?>
                        <?php $phones = explode(' ', $model->phone) ?>
                        <?php foreach ($phones as $phone): ?>
                            <span class="single-actions__phone"><?= $phone ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="all-actions__bottom">
                    <a href="#" class="all-actions__bottom--comments">Добавить коментарий</a>
                    <span class="all-actions__bottom--sale"><?= $model->dt_event; ?></span>
                </div>
                <div class="all-actions__favorites"></div>
            </div>
            <h2 class="all-actions__title">ВОЗМОЖНО ВАС ЗАИНТЕРЕСУЕТ</h2>

            <div class="single-actions__interested">
                <?php
                foreach ($stocks as $item): ?>
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
                                <a href="#" class="all-actions__bottom--more">Подробнее</a>
                                <a href="#" class="all-actions__bottom--comments">Добавить коментарий</a>
                                <span class="all-actions__bottom--sale"><?= $item->dt_event; ?></span>
                            </div>
                            <div class="all-actions__favorites"></div>
                        </div>
                    </a>
                <?php endforeach; ?>
                <div class="more-block">
                    <a href="#" data-step="1" id="load-more-company" class="show-more">загрузить больше</a>
                </div>
            </div>

        </div>

        <?= CompanyRight::widget(); ?>
    </div>
</section>
