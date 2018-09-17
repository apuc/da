<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\top_company\models\TopCompany */

$this->title = 'Добавить в топ';
$this->params['breadcrumbs'][] = ['label' => 'Top Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
