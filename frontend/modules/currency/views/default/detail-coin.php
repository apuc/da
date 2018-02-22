<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 08.02.2018
 * Time: 14:03
 */

use common\models\db\Currency;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * @var array $economicNews
 */


$meta_title = 'Детальная информация о криптовалютах';
$meta_descr = 'Детальная информация о криптовалютах';

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);
$this->params['breadcrumbs'][] = ['label' => 'Биржа', 'url' => Url::to(['/finance'])];
$this->params['breadcrumbs'][] = ['label' => 'Курсы криптовалют', 'url' => Url::to(['/currency', 'type' => Currency::TYPE_COIN])];
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
<section class="exchange-rates">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $meta_title]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'full_name',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return Html::a($model->full_name, Url::to(['/currency/default/view-coin', 'id' => $model->id]));
                        },
                    ],
                    'algorithm',
                    'proof_type',
                    'fully_premined',
                    'total_coin_supply',
                    'sort_order',
                    'sponsored',
                ],
            ]); ?>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2><?= $meta_title ?></h2>
                </div>

                <div class="e-content__wrapper__info">
                </div>

                <div class="e-content__wrapper__table">
                </div>

                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <p>
                        Здесь содержится более детальная информация о криптовалютах
                    </p>
                </div>
            </div>
            <?= $this->render('_finance_news', ['economicNews' => $economicNews]); ?>
        </div>
        <?= $this->render('_all_charts'); ?>
    </div>
</section>
