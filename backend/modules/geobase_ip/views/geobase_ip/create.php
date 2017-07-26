<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\geobase_ip\models\GeobaseIp */

$this->title = 'Create Geobase Ip';
$this->params['breadcrumbs'][] = ['label' => 'Geobase Ips', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geobase-ip-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
