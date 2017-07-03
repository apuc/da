<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\services\models\Services */

$this->title = Yii::t('comments', 'Create Services');
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Services'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
