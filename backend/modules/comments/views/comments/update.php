<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\comments\models\Comments */

$this->title = Yii::t('comments', 'Update {modelClass}: ', [
    'modelClass' => 'Comments',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('comments', 'Update');
?>
<div class="comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
