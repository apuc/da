<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\site_error\models\SiteError */

$this->title = 'Update Site Error: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Site Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="site-error-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
