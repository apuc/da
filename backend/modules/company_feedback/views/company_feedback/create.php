<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\company_feedback\models\CompanyFeedback */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Отзывы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-feedback-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
