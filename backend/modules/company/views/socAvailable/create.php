<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocAvailable */

$this->title = 'Create Soc Available';
$this->params['breadcrumbs'][] = ['label' => 'Soc Availables', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-available-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
