<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\site_error\models\SiteError */

$this->title = 'Create Site Error';
$this->params['breadcrumbs'][] = ['label' => 'Site Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-error-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
