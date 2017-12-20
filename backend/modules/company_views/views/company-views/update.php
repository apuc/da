<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\CompanyViews */

$this->title = Yii::t('company_views', 'Update {modelClass}: ', [
        'modelClass' => Yii::t('company_views', 'Company Views'),
    ]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('company_views', 'Company Views'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('company_views', 'Update');
?>
<div class="company-views-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
