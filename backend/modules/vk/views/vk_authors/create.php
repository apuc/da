<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\vk\models\VkAuthors */

$this->title = 'Create Vk Authors';
$this->params['breadcrumbs'][] = ['label' => 'Vk Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-authors-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
