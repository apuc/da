<?php

use common\models\db\Currency;
use common\models\db\CurrencyCoin;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model Currency */
/* @var $coin CurrencyCoin */

$this->title = Yii::t('currency', 'Create Currency');
$this->params['breadcrumbs'][] = ['label' => Yii::t('currency', 'Currencies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'coin' => $coin
    ]) ?>

</div>
