<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\classes\Debug;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\stock\models\StockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Акции';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stock-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            'title',
            [
                'attribute' => 'photo',
                'format' => 'html',
                'value' => function($model){
                    return Html::img($model->photo, ['width'=>'100px']);
                }
            ],
            'short_descr:ntext',
            //'descr:ntext',
            // 'dt_add',
            // 'dt_update',
            [
                'attribute' => 'status',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    $st = 0;
                    switch ( $model->status ) {
                        case 0:
                            $st = 'Опубликована';
                            break;
                        case 1:
                            $st = 'На модерации';
                            break;
                    }

                    return $st;
                },
                'filter'    => Html::activeDropDownList( $searchModel, 'status', [
                    '0' => 'Опубликована',
                    '1' => 'На модерации',
                ], [ 'class' => 'form-control', 'prompt' => 'Выбрать статус...' ] ),
            ],
            // 'dt_event',
            // 'link',
            // 'main',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
