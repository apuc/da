<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\company\models\Company */

$this->title = 'Вы редактируете: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('company', 'Update');
?>
<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3><?= Html::encode($this->title) ?></h3>
    <div class="right">
        <?= $this->render('_form-update', [
            'model' => $model,
            //'selectCat' => $selectCat,
            'companyRel' => $companyRel,
            //'selectParentCat' => $selectParentCat,
            'services' => $services,
            'img' => $img,
            'typeSeti' => $typeSeti,
            'socCompany' => $socCompany,
            'city' => $city,
            'categoryCompanyAll' => $categoryCompanyAll,
        ]) ?>
    </div>

</div>
