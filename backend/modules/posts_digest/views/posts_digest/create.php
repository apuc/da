<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\posts_digest\models\PostsDigest */
/* @var $cats_arr array */

$this->title = Yii::t('faq', 'Create Posts Digest');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Posts Digests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-digest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cats_arr' => $cats_arr,
    ]) ?>

</div>
