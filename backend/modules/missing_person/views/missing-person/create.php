<?php

use backend\modules\missing_person\MissingPerson;
use yii\helpers\Html;

/* @var $this yii\web\View */
/** @var $model MissingPerson */

$this->title = Yii::t('news', 'Create News');
$this->params['breadcrumbs'][] = ['label' => Yii::t('missing-person', 'MissingPerson'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div>
    <h1>Добавить Сообщение</h1>

    <?=  $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>