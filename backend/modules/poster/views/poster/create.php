<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\poster\models\Poster */

$this->title = Yii::t('poster', 'Create Poster');
$this->params['breadcrumbs'][] = ['label' => Yii::t('poster', 'Posters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poster-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoriesSelected' => $categoriesSelected,
    ]) ?>

</div>
