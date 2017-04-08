<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_poster\models\CategoryPoster */

$this->title = Yii::t('poster', 'Update {modelClass}: ', [
    'modelClass' => 'Category Poster',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('poster', 'Category Posters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('poster', 'Update');
?>
<div class="category-poster-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
