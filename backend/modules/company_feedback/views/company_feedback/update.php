<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\company_feedback\models\CompanyFeedback */

$this->title = 'Update Company Feedback: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Feedbacks', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-feedback-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
