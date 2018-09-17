<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\Messenger */

$this->title = Yii::t('messenger', 'Update Messenger: {nameAttribute}', [
    'nameAttribute' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('messenger', 'Messengers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('messenger', 'Update');
?>
<div class="messenger-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
