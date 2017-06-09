<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocAvailable */

$this->title = 'Update Soc Available: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Soc Availables', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soc-available-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
