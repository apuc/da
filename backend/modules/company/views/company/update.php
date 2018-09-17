<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model backend\modules\company\models\Company
 * @var $companyPhotos array
 * @var $companyPhotosStr string
 * @var array $city
 * @var $tags
 * @var $tags_selected
 * @var $phones
 * @var array $socials
 * */

$this->title = Yii::t('company', 'Update Company: ', [
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
        'tags' => $tags,
        'tags_selected' => $tags_selected,
        'phones' => $phones,
        'socials' => $socials
    ]) ?>

</div>
