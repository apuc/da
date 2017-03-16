<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\situation\models\Situation */

$this->title = 'Редактировать пост: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блок посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="situation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
