<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\PagesComments */
/* @var $users array */

$this->title = Yii::t('comments', 'Update Pages Comments: {nameAttribute}', [
    'nameAttribute' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Pages Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('comments', 'Update');
?>
<div class="pages-comments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
    ]) ?>

</div>
