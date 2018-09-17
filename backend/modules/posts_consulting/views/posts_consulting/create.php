<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\posts_consulting\models\PostsConsulting */

$this->title = Yii::t('faq', 'Create Posts Consulting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('faq', 'Posts Consultings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-consulting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
