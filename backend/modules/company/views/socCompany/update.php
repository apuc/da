<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocCompany */

$this->title = 'Update Soc Company: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Soc Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soc-company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
