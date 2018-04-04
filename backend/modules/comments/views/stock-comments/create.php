<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\StockComments */

$this->title = Yii::t('comments', 'Create Stock Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Stock Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
