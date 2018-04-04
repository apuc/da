<?php

use backend\modules\vk\models\VkStream;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\comments\models\VkStreamCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('comments', 'Vk Stream Comments');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-stream-comments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= Html::a('Отметить все', ['multi-moder-checked-ajax'], [
        'id' => 'btn-multi-moder-checked',
        'class' => 'btn btn-success',
    ]);
    ?>

    <?= Html::a('Опубликовать все', ['multi-published-ajax'], [
        'id' => 'btn-multi-published',
        'class' => 'btn btn-success',
    ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model) {
                    return ['value' => $model->id, 'data-type' => 'vk_stream'];
                }
            ],
            //id
            'content:ntext',
            [
                'attribute' => 'vk_stream_id',
                'format' => 'raw',
                'label' => Yii::t('comments', 'Vk Stream ID'),
                'value' => function ($model) {
                    if (empty($model->vk_stream_id)) {
                        $html = 'Нет';
                    } else {
                        $result = VkStream::find()->where(['id' => $model->vk_stream_id])->one();
                        if (empty($result->title)) {
                            $html = 'Нет';
                        } else {
                            $html = Html::a($result['title'],
                                Yii::$app->urlManagerFrontend->createUrl(['stream/' . $result['slug']]),
                                ['target' => '_blank']);
                        }
                    }
                    return $html;
                },
            ],
            [
                'attribute' => 'user_id',
                'format' => 'text',
                'label' => Yii::t('comments', 'User ID'),
                'value' => function ($model) {
                    if ($model->user_id == 0) {
                        return 'Нет';
                    }
                    $user = User::find()->where(['id' => $model->user_id])->one();
                    return isset($user->username) ? $user->username : '';
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'user_id',
                    ArrayHelper::map(User::find()->all(),
                        'id',
                        'username'),
                    ['class' => 'form-control', 'prompt' => '']),
            ],
            [
                'attribute' => 'moder_checked',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->moder_checked == 0) {
                        $btn = Html::a(
                            'Не отмечено',
                            Url::to(['update-moder-checked', 'id' => $model->id]),
                            ['class' => 'btn btn-success moder_checked']
                        );
                    } else {
                        $btn = Html::a(
                            'Отмечено',
                            Url::to(['update-moder-checked', 'id' => $model->id]),
                            ['class' => 'btn btn-info moder_checked']
                        );
                    }
                    return $btn;
                },
                'filter' => Html::activeDropDownList($searchModel, 'moder_checked', [0 => 'Не отмечено', 1 => 'Отмечено'], ['class' => 'form-control', 'prompt' => '']),
            ],
            [
                'attribute' => 'published',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->published == 0) {
                        $btn = Html::a(
                            'На модерации',
                            Url::to(['update-published', 'id' => $model->id]),
                            ['class' => 'btn btn-success published']
                        );
                    } else {
                        $btn = Html::a(
                            'Опубликовано',
                            Url::to(['update-published', 'id' => $model->id]),
                            ['class' => 'btn btn-info published']
                        );
                    }
                    return $btn;
                },
                'filter' => Html::activeDropDownList($searchModel, 'published', [0 => 'На модерации', 1 => 'Опубликовано'], ['class' => 'form-control', 'prompt' => '']),
            ],
            [
                'attribute' => 'verified',
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->verified == 0) {
                        $btn = Html::a(
                            'Не проверено',
                            Url::to(['update-verified', 'id' => $model->id]),
                            ['class' => 'btn btn-danger verified']
                        );
                    } else {
                        $btn = Html::a(
                            'Проверено',
                            Url::to(['update-verified', 'id' => $model->id]),
                            ['class' => 'btn btn-info verified']
                        );
                    }
                    return $btn;
                },
                'filter' => Html::activeDropDownList($searchModel,
                    'verified',
                    [
                        '0' => 'Не проверено',
                        '1' => 'Проверено'
                    ],
                    ['class' => 'form-control', 'prompt' => '']),
            ],

            //'dt_add',
            //'parent_id',
            //'moder_checked',
            //'published',
            //'verified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
