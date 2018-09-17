<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\situation\models\Situation */

$this->title = 'Блок посты';
$this->params['breadcrumbs'][] = ['label' => 'Добавить', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="situation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
