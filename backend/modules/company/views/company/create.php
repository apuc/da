<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\Company */

$this->title = Yii::t('company', 'Create Company');
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'city' => $city,
        'typeSeti' => $typeSeti,
        'tags' => $tags,
        'tags_selected' => $tags_selected
    ]) ?>

</div>
