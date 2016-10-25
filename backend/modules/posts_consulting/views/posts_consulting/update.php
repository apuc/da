<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\posts_consulting\models\PostsConsulting */

$this->title = Yii::t('faq', 'Update {modelClass}: ', [
    'modelClass' => 'Posts Consulting',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Posts Consultings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('faq', 'Update');
?>
<div class="posts-consulting-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
