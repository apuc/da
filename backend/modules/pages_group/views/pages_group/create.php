<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\pages_group\models\PagesGroup */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Группы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-group-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
