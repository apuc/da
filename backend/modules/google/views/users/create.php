<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\GooglePlusUsers */

$this->title = 'Create Google Plus Users';
$this->params['breadcrumbs'][] = ['label' => 'Google Plus Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-plus-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
