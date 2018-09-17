<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\products\models\ProductFields */

$this->title = 'Новое поле';
$this->params['breadcrumbs'][] = ['label' => 'Доп.поля', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
