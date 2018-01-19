<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\DefaultFieldsValue */

$this->title = 'добавить значение по умолчанию для поля';
$this->params['breadcrumbs'][] = ['label' => 'Default Fields Values', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="default-fields-value-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
