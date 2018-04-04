<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\PagesComments */

$this->title = Yii::t('comments', 'Create Pages Comments');
$this->params['breadcrumbs'][] = ['label' => Yii::t('comments', 'Pages Comments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-comments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
