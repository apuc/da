<?php
/**
 * Created by PhpStorm.
 * User: Dmitriy
 * Date: 08.02.2018
 * Time: 14:03
 */

use common\models\db\Currency;
use common\models\db\CurrencyCoin;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

/**
 * @var CurrencyCoin $coin
 * @var array $economicNews
 */


$meta_title = "Детальная информация о криптовалюте {$coin->full_name}";
$meta_descr = "Детальная информация о криптовалюте {$coin->full_name}";

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
            <?= $this->render('_header', ['title' => $meta_title, 'coin' => true]); ?>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2><?= $meta_title ?></h2>
                </div>
                <div class="e-content__wrapper__table">
                    <table>
                        <thead>
                        <tr>
                            <td>Атрибут</td>
                            <td>Значение</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>nominal</td>
                            <td><?= $coin->currency->nominal ?></td>
                        </tr>
                        <tr>
                            <td> code</td>
                            <td><?= $coin->currency->code ?></td>
                        </tr>
                        <?php foreach ($coin as $key => $field): ?>
                            <?php if ($key == 'id' || $key == 'currency_id') continue; ?>
                            <tr>
                                <td><?= $key ?></td>
                                <td><?= $field ?></td>
                            </tr>
                        <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <p>
                        Здесь содержится более детальная информация о криптовалюте <?= $coin->full_name ?>
                    </p>
                </div>
            </div>
            <?= $this->render('_finance_news', ['economicNews' => $economicNews]); ?>
        </div>
        <?= $this->render('_all_charts'); ?>
    </div>
</section>
