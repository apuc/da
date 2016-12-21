<?php

use common\models\db\Answers;
use common\models\db\PossibleAnswers;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\polls\models\Polls */
/**
 * @var  $pa \common\models\db\PossibleAnswers
 */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Polls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polls-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="pa">
        <hr>
        <p>Варианты ответов:</p>
        <br/>
        <?php foreach ($pa as $variant): ?>
<!--            --><?php //\common\classes\Debug::prn($variant); ?>
            <p><?= $variant['title'] ?> </p><br>
        <?php endforeach; ?>
        <hr>
        <p>Результаты голосования:</p>
        <br/>
        <?php foreach($possible_answers as $item): ?>
            <p><?= $item['answer'] ?> - </p>
            <span><?= $item['val'];?> Голоса;</span>
            <span><?= $item['val_per'];?> %;</span>
            <br/>
<!--            --><?php //\common\classes\Debug::prn($possible_answers); ?>
        <?php endforeach; ?>
    </div>

</div>
