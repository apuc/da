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
            [
                'attribute' => 'text',
                'format' => 'raw',
                'value' => function ($model) {
                    $photo = \common\models\db\VkPhoto::find()->where(['post_id' => $model->id])->all();
                    $text = $model->text;
                    $text .= '<div>';
                    foreach ((array)$photo as $item){
                        if(!empty($item->photo_807)){
                            $text .= '<span>' . Html::img($item->photo_807, ['width'=>300]) . '</span>';
                        }
                        elseif(!empty($item->photo_604)){
                            $text .= '<span>' . Html::img($item->photo_604, ['width'=>300]) . '</span>';
                        }
                        elseif(!empty($item->photo_130)){
                            $text .= '<span>' . Html::img($item->photo_130, ['width'=>200]) . '</span>';
                        }
                        else {
                            $text .= '<span>' . Html::img($item->photo_75, ['width'=>200]) . '</span>';
                        }
                    }
                    $text .= '</div>';
                    return $text;
                },
            ],
            // 'from_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
