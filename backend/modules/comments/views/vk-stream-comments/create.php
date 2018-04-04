<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\VkStreamComments */

$this->title = Yii::t('comments', 'Create Vk Stream Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Vk Stream Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-stream-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
