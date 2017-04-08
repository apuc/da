<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\category_posts_digest\models\CategoryPostsDigest */

$this->title = Yii::t('faq', 'Update {modelClass}: ', [
    'modelClass' => 'Category Posts Digest',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Category Posts Digests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('faq', 'Update');
?>
<div class="category-posts-digest-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
