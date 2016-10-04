<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\top_company\models\TopCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Топ компаний';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-company-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить в топ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/

            [
                'attribute' => 'company_id',
                'label' => 'Компании',
                'format' => 'text',
                'value' => function($model){
                    return \common\models\db\Company::find()->where(['id'=>$model->company_id])->one()->name;
                }
            ],
            'order',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
