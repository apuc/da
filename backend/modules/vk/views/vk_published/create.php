<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkStream */

$this->title = 'Create Vk Stream';
$this->params['breadcrumbs'][] = ['label' => 'Vk Streams', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-stream-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
