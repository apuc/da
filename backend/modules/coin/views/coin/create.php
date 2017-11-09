<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\coin\models\Coin */

$this->title = 'Create Coin';
$this->params['breadcrumbs'][] = ['label' => 'Coins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
