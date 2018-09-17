<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\Messenger */

$this->title = Yii::t('messenger', 'Create Messenger');
$this->params['breadcrumbs'][] = ['label' => Yii::t('messenger', 'Messengers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messenger-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
