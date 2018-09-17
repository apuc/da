<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\consulting\models\Consulting */

$this->title = Yii::t('consulting', 'Create Consulting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('consulting', 'Consultings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consulting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
