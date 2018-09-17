<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPosts */

$this->title = 'Редактировать: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Twitter  посты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="tw-posts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
