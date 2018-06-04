<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\GooglePlusUsers */

$this->title = 'Update Google Plus Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Google Plus Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="google-plus-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
