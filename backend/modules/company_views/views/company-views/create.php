<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\CompanyViews */

$this->title = Yii::t('company_views', 'Create Company Views');
$this->params['breadcrumbs'][] = ['label' => Yii::t('company_views', 'Company Views'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-views-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
