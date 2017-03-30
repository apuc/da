<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\people_talk\models\PeopleTalk */

$this->title = Yii::t('talk', 'Update', [
    'modelClass' => 'People Talk',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('talk', 'People Talks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('talk', 'Update');
?>
<div class="people-talk-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
