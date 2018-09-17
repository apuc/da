<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\tw\models\TwPages */

$this->title = 'Добавить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Twitter страницы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tw-pages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
