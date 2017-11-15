<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\metal\models\Metal */

$this->title = 'Create Metal';
$this->params['breadcrumbs'][] = ['label' => 'Metals', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
