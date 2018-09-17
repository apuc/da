<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\contacting\models\Contacting */

$this->title = Yii::t('contacting', 'Create Contacting');
$this->params['breadcrumbs'][] = ['label' => Yii::t('contacting', 'Contactings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacting-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
