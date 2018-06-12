<?php
/* @var $this yii\web\View */

/* @var $model \common\models\db\Journal */

use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Журналы', 'url' => Url::to(['/journal/journal'])];
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs'],
        ]); ?>
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $model->iframe ?>
    </div>