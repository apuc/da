<?php

/**
 * @var array $currency
 * @var string $meta_title
 * @var string $meta_descr
 * @var array $economicNews
 * @var string $bottom_descr
 */

use common\classes\Debug;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->title = $meta_title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta_descr,
]);


$this->registerJsFile('/js/converter.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->params['breadcrumbs'][] = ['label' => 'Биржа', 'url' => Url::to(['/finance'])];
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
<section class="currency-converter">
    <div class="container">
        <div class="e-content">
            <?= $this->render('_header', ['title' => $meta_title]); ?>
            <div class="e-content__wrapper">
                <div class="e-content__wrapper__title">
                    <h2>Конвертер валют </h2>
                </div>
                <form action="#" id="currency-converter">

                    <div class="convert-wrap">
                        <label for="convert-sum">Введите сумму</label>
                        <input type="number" min="0" name="sum" id="convert-sum">
                    </div>
                    <a href="#" class="convert-arrow">
                        <i id="arrow" class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                    <div class="convert-wrap">
                        <label for="convert-result">Введите сумму</label>
                        <input type="number" min="0" name="sum" id="convert-result">
                    </div>

                    <div class="convert-wrap">
                        <label for="currency-selection">Конвертировать в</label>
                        <?= Html::dropDownList(
                            '',
                            'RUB',
                            ['RUB' => 'RUB - Российский рубль'],
                            ['id' => 'currency-selection'])
                        ?>
                    </div>
                    <a href="#" class="convert-arrow">
                        <i class="fa fa-exchange" aria-hidden="true"></i>
                    </a>
                    <div class="convert-wrap">
                        <label for="convert-to">Конвертировать в</label>
                        <?= Html::dropDownList(
                            '',
                            'USD',
                            $currency,
                            ['id' => 'convert-to'])
                        ?>
                    </div>

                </form>
                <div class="e-content__wrapper__description">
                    <h3>Описание</h3>
                    <?= $bottom_descr; ?>
                </div>
            </div>
            <?= $this->render('_finance_news', ['economicNews' => $economicNews]); ?>
        </div>
        <?= $this->render('_all_charts'); ?>
    </div>
</section>
