<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocCompany */

$this->title = 'Create Soc Company';
$this->params['breadcrumbs'][] = ['label' => 'Soc Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
