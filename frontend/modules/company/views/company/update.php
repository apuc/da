<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model frontend\modules\company\models\Company
 * @var $companyRel
 * @var $services
 * @var $img
 * @var $city
 * @var $categoryCompanyAll
 * @var $socials
 *
 */

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
            'companyRel' => $companyRel,
            'services' => $services,
            'img' => $img,
            'city' => $city,
            'categoryCompanyAll' => $categoryCompanyAll,
            'socials' => $socials
        ]) ?>
    </div>

</div>
