<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category_faq\models\CategoryFaq */

$this->title = Yii::t('category_faq', 'Create Category Faq');
$this->params['breadcrumbs'][] = ['label' => Yii::t('category_faq', 'Category Faqs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-faq-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
