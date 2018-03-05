<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPages */

$this->title = 'Редактировать страницу: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Twitter страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="tw-pages-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
