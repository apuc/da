<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 08.02.2018
 * Time: 14:03
 */

use common\models\db\Currency;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/** @var Currency $coin */


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

            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2><?= $meta_title ?></h2>
                </div>
                <div class="e-content__wrapper__info">
                    <!--                    --><?php //foreach ($top_rates as $rate): ?>
                    <!--                        <p>--><? //= $rate[0] ?><!-- — <span> -->
                    <? //= $rate[1] ?><!--</span></p>-->
                    <!--                    --><?php //endforeach; ?>
                </div>
                <div class="e-content__wrapper__table">
                    <table>
                        <thead>
                        <tr>
                            <?php foreach ($coin[0]->coin as $key => $item): ?>
                                <?php if ($key == 'id'
                                    || $key == 'currency_id'
                                    || $key == 'url'
                                    || $key == 'image_url'
                                    || $key == 'symbol'
                                    || $key == 'pre_mined_value'
                                    || $key == 'total_coins_free_float'
                                ) continue; ?>
                                <td><?= $key ?></td>
                            <?php endforeach; ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($coin as $k => $item): ?>
                            <tr>
                                <?php foreach ($item->coin as $key => $i): ?>
                                    <?php if ($key == 'id'
                                        || $key == 'currency_id'
                                        || $key == 'url'
                                        || $key == 'image_url'
                                        || $key == 'symbol'
                                        || $key == 'pre_mined_value'
                                        || $key == 'total_coins_free_float'
                                    ) continue; ?>
                                    <td>
                                        <div>
                                            <span><?= $i ?></span>
                                        </div>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
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
