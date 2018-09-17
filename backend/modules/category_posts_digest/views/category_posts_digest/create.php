<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category_posts_digest\models\CategoryPostsDigest */

$this->title = Yii::t('faq', 'Create Category Posts Digest');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Category Posts Digests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-posts-digest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
