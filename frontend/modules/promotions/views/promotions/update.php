<?php
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\promotions\models\Stock */

$this->title = 'Редактировать акцию: '.$model->title;
?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form_update', [
        'model' => $model,
        'beforeCreate' => $beforeCreate
    ]) ?>
</div>