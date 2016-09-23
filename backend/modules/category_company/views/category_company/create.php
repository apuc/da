<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category_company\models\CategoryCompany */

$this->title = Yii::t('company', 'Create Category Company');
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Category Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
