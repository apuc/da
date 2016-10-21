<?php

use common\models\db\Company;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\consulting\models\ConsultingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = Yii::t( 'consulting', 'Consultings' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consulting-index">

    <h1><?= Html::encode( $this->title ) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a( Yii::t( 'consulting', 'Create Consulting' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
    </p>
    <?= GridView::widget( [
        'dataProvider' => $dataProvider,
        'filterModel'  => $searchModel,
        'columns'      => [
            [ 'class' => 'yii\grid\SerialColumn' ],

//            'id',
            'title',
//            'company_id',
            [
                'attribute' => 'company_id',
                'format'    => 'text',
                'value'     => function ( $model ) {
                    if ( $model->company_id == 0 ) {
                        return 'Нет';
                    }

                    return Company::find()->where( ['id'=>$model->company_id])->one()->name;
                }
            ],
            'descr:ntext',
//            'dt_add',
//            'dt_update',
            // 'slug',
            // 'icon',
            // 'views',

            [ 'class' => 'yii\grid\ActionColumn' ],
        ],
    ] ); ?>
</div>
