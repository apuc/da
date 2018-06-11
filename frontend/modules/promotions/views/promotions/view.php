<?php
/** @var Stock $model
 * @var Stock $stock
 * @var array $stocks
 */

use common\classes\GeobaseFunction;
use frontend\modules\promotions\models\Stock;
use frontend\widgets\CompanyRight;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\models\User;
use common\classes\DateFunctions;

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
                <form action="<?= Url::to(['/promotions/promotions/index']); ?>" method="post">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <button class="all-actions__button-search"></button>
                    <input type="search" name="search" class="all-actions__search" placeholder="Поиск">
                </form>
            </div>
            <div class="single-actions__single-item">
                <div class="all-actions__img">
                    <img src="<?= $model->photo ?>" alt="">
                    <!--<span class="single-actions__prom-cod">-->
                    <?php //if (!empty($model->short_descr)) echo $model->short_descr; ?><!--</span>-->
                </div>
                <a href="#">
                    <div class="all-actions__company">
                        <div class="all-actions__company--img">
                            <img src="<?= $model->company->photo ?>"
                                 alt="<?= !empty($model->company->alt) ? $model->company->alt : $model->company->name ?>">
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
                        <span class="all-actions__title-item--view"><?= $model->view; ?></span>
                    </h2>
                    <div class="single-actions__desc">
                        <?php
                        if (!empty($model->descr)) echo $model->descr;
                        else echo $model->short_descr;
                        ?>
                    </div>
                </div>
                <div class="single-actions__contacts">
                    <h2 class="all-actions__title-item">Контакты</h2>
                    <span class="single-actions__name"><?= $model->company->name ?></span>
                    <?php if (!empty($phones)): ?>
                        <?php foreach ($phones as $phone): ?>
                            <span class="single-actions__phone"><?= $phone->phone ?></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="all-actions__bottom">
                    <span class="all-actions__bottom--sale"><?= $model->dt_event; ?></span>
                </div>
                <div class="content-single-wrapper"></div>
                <?= \frontend\widgets\Comments::widget([
                    'pageTitle' => 'Комментарии',
                    'postType' => 'promotion',
                    'postId' => $model->id,
                ]); ?>

                <div class="all-actions__favorites"></div>
            </div>
            <h2 class="all-actions__title">ВОЗМОЖНО ВАС ЗАИНТЕРЕСУЕТ</h2>

            <div class="single-actions__interested">
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
                                         alt="<?= !empty($model->company->alt) ? $model->company->alt : $model->company->name ?>">
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
                <div class="more-block">


                </div>
            </div>

        </div>

        <?= CompanyRight::widget(); ?>
    </div>
</section>
