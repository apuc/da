<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstAccounts */

$this->title = 'Добавить аккаунт instagram';
$this->params['breadcrumbs'][] = ['label' => 'Inst Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-accounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
