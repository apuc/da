<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstPhoto */

$this->title = 'Обновить фотографию instagram: ';
$this->params['breadcrumbs'][] = ['label' => 'Inst Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inst-photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
