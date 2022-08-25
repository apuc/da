<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstPhoto */

$this->title = 'Create Inst Photo';
$this->params['breadcrumbs'][] = ['label' => 'Inst Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-photo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
