<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\poster\models\Poster */

$this->title = Yii::t('poster', 'Update {modelClass}: ', [
    'modelClass' => 'Poster',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('poster', 'Posters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('poster', 'Update');
?>
<div class="poster-update">
    <? //\common\classes\Debug::prn($tags_selected) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categoriesSelected' => $categoriesSelected,
        'tags_selected' => $tags_selected,
        'tags' => $tags,
    ]) ?>

</div>
