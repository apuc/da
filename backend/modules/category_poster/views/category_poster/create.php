<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category_poster\models\CategoryPoster */

$this->title = Yii::t('poster', 'Create Category Poster');
$this->params['breadcrumbs'][] = ['label' => Yii::t('poster', 'Category Posters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-poster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
