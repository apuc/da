<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkComments */

$this->title = 'Create Vk Comments';
$this->params['breadcrumbs'][] = ['label' => 'Vk Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
