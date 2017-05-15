<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vk\models\VkStreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vk Streams';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-stream-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vk Stream', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'vk_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $groupId = $model->owner_id * -1;
                    $domain = \common\models\db\VkGroups::find()->where(['vk_id' => $groupId])->one();
                    if ($domain) {
                        return Html::a('Ссылка',
                            'https://vk.com/' . $domain->domain . '?w=wall' . $model->vk_id,
                            [
                                'target' => '_blank',
                            ]);
                    }

                },
            ],
            //'from_id',
            //'owner_id',
            /*'owner_type',*/
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date('Y-m-d H:i', $model->dt_add);
                },
            ],
            // 'post_type',
            'text:ntext',
            // 'from_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
