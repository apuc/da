<?php

use common\models\db\CurrencyRate;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model CurrencyRate */

$this->title = Yii::t('currency', 'Create Currency Rate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('currency', 'Currency Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
