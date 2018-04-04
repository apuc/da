<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\VkStreamComments */
/* @var $users array */

$this->title = Yii::t('comments', 'Update Vk Stream Comments: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Vk Stream Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('comments', 'Update');
?>
<div class="vk-stream-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
    ]) ?>

</div>
