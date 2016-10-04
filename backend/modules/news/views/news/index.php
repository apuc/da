<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\news\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('news', 'News');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('news', 'Create News'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            /*'content:ntext',*/
            [
                'attribute' => 'dt_add',
                'format' => 'text',
                'value' => function($model){
                    return date('Y-m-d H:i', $model->dt_add);
                }
            ],
            [
                'attribute' => 'dt_update',
                'format' => 'text',
                'value' => function($model){
                    return date('Y-m-d H:i', $model->dt_update);
                }
            ],
            //'dt_add',
            //'dt_update',
            // 'slug',
            // 'tags',
            // 'photo',
            [
                'attribute' => 'status',
                'format' => 'text',
                'value' => function($model){
                    $st = 0;
                    switch($model->status){
                        case 0: $st = 'Опубликована';
                            break;
                        case 1: $st = 'На модерации';
                            break;
                        case 3: $st = 'Отложена';
                            break;
                    }
                    return $st;
                }
            ],
            // 'user_id',
            // 'lang_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
