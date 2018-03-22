<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company\models\MessengerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('messenger', 'Messengers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="messenger-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('messenger', 'Create Messenger'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'icon',
                'value' => function ($messenger) {
                    return Html::img($messenger->icon, ['style' => 'height:30px']);
                },
                'format' => 'raw'
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
