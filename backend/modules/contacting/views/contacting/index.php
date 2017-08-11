<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\contacting\models\ContactingSeacrh */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('contacting', 'Contactings');
$this->params['breadcrumbs'][] = $this->title;
?>
<?$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => \yii\web\JqueryAsset::className()])?>
<div class="contacting-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('contacting', 'Create Contacting'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'email',
            'type',
            'content',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->status)
                    {
                        return
                            Html::a('Посмотреть ответ', ['/contacting/contacting/view', 'id' => $model->id], ['class' => 'btn btn-success send-email']);
                    }else
                    return
                        Html::a('Ответить', ['/contacting/contacting/send-mail', 'id' => $model->id],
                            ['class' => 'btn btn-danger send-email']);

                },
            ],
            [
                'attribute' => 'dt_add',
                'format' => 'raw',
                'value' => function ($model) {
                    return
                        date('d-m-Y H:i:s', $model->dt_add);

                },
            ],

            // 'dt_update',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

