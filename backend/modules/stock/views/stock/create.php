<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\stock\models\Stock */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Акции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
