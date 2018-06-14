<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\ServicePeriods */
/* @var $services common\models\db\Products[] */

$this->title = 'Создать приём';
$this->params['breadcrumbs'][] = ['label' => 'Приёмы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-periods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'services' => $services
    ]) ?>

</div>
