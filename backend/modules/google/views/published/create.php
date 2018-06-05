<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\GooglePlusPosts */

$this->title = 'Create Google Plus Posts';
$this->params['breadcrumbs'][] = ['label' => 'Google Plus Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-plus-posts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
