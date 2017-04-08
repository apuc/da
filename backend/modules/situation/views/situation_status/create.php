<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\situation\models\SituationStatus */

$this->title = 'Добавить статус';
$this->params['breadcrumbs'][] = ['label' => 'Ситуации на блок постах', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situation-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
