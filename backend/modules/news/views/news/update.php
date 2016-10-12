<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $lang \common\models\db\Lang */
/* @var $cats_arr array */

$this->title = Yii::t('news', 'Update {modelClass}: ', [
    'modelClass' => 'News',
]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('news', 'Update');
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lang' => $lang,
        'cats_arr' => $cats_arr,
    ]) ?>

</div>
