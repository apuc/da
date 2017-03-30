<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\people_talk\models\PeopleTalk */

$this->title = Yii::t('talk', 'Create');
$this->params['breadcrumbs'][] = ['label' => Yii::t('talk', 'People Talks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="people-talk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
