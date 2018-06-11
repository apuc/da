<?php
/* @var $this yii\web\View */

/* @var $model \common\models\db\Journal */

use common\classes\Debug;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use common\classes\WordFunctions;
$this->title = $model->title;
?>
    <div class="container">

        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class' => 'breadcrumbs']
        ]) ?>

        <h1><?= $model->title ?></h1>
        <?= $model->iframe ?>
    </div>