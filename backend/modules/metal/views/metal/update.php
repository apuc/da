<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\metal\models\Metal */

$this->title = Yii::t('metal', 'Update Metal: ') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('metal', 'Metals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('metal', 'Update');
?>
<div class="metal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
