<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\NewsComments */

$this->title = Yii::t('comments', 'Create News Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'News Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
