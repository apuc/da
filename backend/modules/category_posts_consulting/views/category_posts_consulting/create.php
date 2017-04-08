<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category_posts_consulting\models\CategoryPostsConsulting */

$this->title = Yii::t('faq', 'Create Category Posts Consulting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Category Posts Consultings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-posts-consulting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
