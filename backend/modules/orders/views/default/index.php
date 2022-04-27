<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\orders\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?="" //Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],


            'first_name',
            'last_name',
            'email:email',
            'phone',
            //'address',
             [
                     'attribute'=>"status",
                     'format'=>'raw',
                     'value'=>function($data){
                         switch ($data->status)
                         {
                             case 0: return Html::tag('font','Ожидает обработки',['color'=>'red']);
                              break;
                             case 1: return Html::tag('font','Принят',['color'=>'orange']);
                             break;
                             case 2: return Html::tag('font','Готов',['color'=>'green']);
                         }
                     }
             ],
            //'dt_add',
            //'shop_id',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
