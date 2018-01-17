<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\Company */
/* @var $companyPhotos array */
/* @var $companyPhotosStr string */

$this->title = Yii::t('company', 'Update {modelClass}: ', [
    'modelClass' => 'Company',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('company', 'Update');
?>
<div class="company-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'companyPhotos' => $companyPhotos,
        'companyPhotosStr' => $companyPhotosStr,
        'city' => $city,
        'typeSeti' => $typeSeti,
        'socCompany' => $socCompany,
        'tags' => $tags,
        'tags_selected' => $tags_selected,
        'phones' => $phones
    ]) ?>

</div>
