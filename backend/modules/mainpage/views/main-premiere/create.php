<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\mainpage\models\MainPremiere */

$this->title = 'Create Main Premiere';
$this->params['breadcrumbs'][] = ['label' => 'Main Premieres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-premiere-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'region' => $region,
    ]) ?>

</div>
