<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */

$this->title = Yii::t('news', 'Create News');
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<!--<div class="news-create">

    <h1><?/*= Html::encode($this->title) */?></h1>

    <?/*= $this->render('_form', [
        'model' => $model,
    ]) */?>

</div>-->


<div class="cabinet__inner-box">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


</div>