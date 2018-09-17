<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\GooglePlusPosts */

$this->title = 'Update Google Plus Posts: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Google Plus Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="google-plus-posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
