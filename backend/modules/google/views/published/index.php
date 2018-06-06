<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Google Plus Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="google-plus-posts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Google Plus Posts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'Google+',
                'format' => 'raw',
                'value' => function ($model) {
                    $user = \common\models\db\GooglePlusUsers::find()->where(['id' => $model->user_id])->one();
                    if ($user) {
                        return Html::a($user->display_name,
                            $model->url,
                            [
                                'target' => '_blank',
                            ]);
                    }

                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\db\VkGroups::find()->all(), 'vk_id', 'name')
            ],
            'dt_publish',
            [
                'attribute' => 'Content',
                'format' => 'raw',
                'value' => function ($model) {
                    $images = \common\models\db\GooglePlusPhoto::find()
                        ->where(['post_id' => $model->id])->all();
                    $result = $model->title . '<br/>';
                    if($images){
                        foreach($images as $image){
                            $result .= Html::img($image->url, ['width' => 300]);
                        }
                    }
                    return $result;

                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\db\VkGroups::find()->all(), 'vk_id', 'name')
            ],
            [
                'attribute' => 'Status',
                'format' => 'raw',
                'value' => function ($model) {
                        return Html::a('Снять с публикации', ['#'], ['data-id' => $model->id, 'data-status' => 2, 'class' => 'btn btn-xs btn-success google_stream_edit']);
                },
                'filter' => \yii\helpers\ArrayHelper::map(\common\models\db\VkGroups::find()->all(), 'vk_id', 'name')
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
