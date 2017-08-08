<?php

use common\models\db\News;
use common\models\db\Pages;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\comments\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('comments', 'Comments');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <? /*= Html::a(Yii::t('comments', 'Create Comments'), ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->

    <!--    --><?php
    //       echo Html::a('Удалить выбранные', ['multi-delete'], [
    //            'id' => 'btn-multi-del',
    //            'class' => 'btn btn-default',
    //            'onclick' => 'setParams()',
    //            'data' => [
    //                'confirm' => 'Вы действительно хотите удалить выбранные элементы?',
    //                'method' => 'post',
    //            ],
    //        ]);
    //         ?>

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
                    return ['value' => $model->id];
                }
            ],

            'content:ntext',
            //'id',
            'post_type',
            //'post_id',
            [
                'attribute' => 'post_id',
                'format' => 'raw',
                'label' => Yii::t('comments', 'Post ID'),
                'value' => function ($model) {
                    if ($model->post_id == 0) {
                        return 'Нет';
                    }
                    if ($model->post_type == 'news') {
                        $result = News::find()->where(['id' => $model->post_id])->one();
                        $html =  Html::a($result->title,
                            Yii::$app->urlManagerFrontend->createUrl(['news/default/view', 'slug'=>$result->slug]),
                            ['target' => '_blank']);

                    }
                    if ($model->post_type == 'page') {
                        $result = Pages::find()->where(['id' => $model->post_id])->one();

                        $html =  Html::a($result->title,
                            Yii::$app->urlManagerFrontend->createUrl(['page/' . $result->slug]),
                            ['target' => '_blank']);
                    }

                    if ($model->post_type == 'vk_post') {
                        $result = \backend\modules\vk\models\VkStream::find()->where(['id' => $model->post_id])->one();

                        $html =  Html::a($result->title,
                            Yii::$app->urlManagerFrontend->createUrl(['stream/' . $result->slug]),
                            ['target' => '_blank']);
                    }

                    return $html;
                },
            ],
            // 'user_id',
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
            // 'dt_add',
            // 'parent_id',

            //'moder_checked',
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

            //'published',
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

            ['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>

</div>
