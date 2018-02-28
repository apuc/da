<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPosts */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Twitter Потсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tw-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
