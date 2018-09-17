<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\CategoryNews */

$this->title = Yii::t('category_news', 'Update {modelClass}: ', [
    'modelClass' => 'Category News',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('category_news', 'Category News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('category_news', 'Update');
?>
<div class="category-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lang' => $lang,
        'all_cat' => $all_cat
    ]) ?>

</div>
