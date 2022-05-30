<?php

use backend\modules\banned_ip\models\BannedIp;
use backend\modules\missing_person\models\MissingPersonSearch;
use common\classes\UserFunction;
use common\models\db\GeobaseCity;
use common\models\db\MissingPerson;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html; ?>

<div>
    <h1>Сообщения о пропавших</h1>
    <p>
        <?= Html::a(Yii::t('missing-person', 'Добавить сообщение'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    /** @var ActiveDataProvider $dataProvider */
    /** @var MissingPersonSearch $searchModel */


    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => UserFunction::hasRoles(['admin']) ? '{update} &nbsp&nbsp {delete}' : '',
            ],
            'id',
            [
                'attribute' => 'fio',
                'label' => 'ФИО',
                'format' => 'raw',
            ],
            [
                'attribute' => 'date_of_birth',
                'label' => 'Дата рождения',
                'format' => 'text',
                'value' => function ($model) {
                    return date("d.m.Y", $model->date_of_birth);
                }
            ],
            [
                'attribute' => 'city_id',
                'label' => 'Город',
                'value' => function ($model) {
                    return GeobaseCity::findOne($model->city_id)->name;
                },
                'filter' => \kartik\select2\Select2::widget(
                    [
                        'model' => $searchModel,
                        'attribute' => 'city_id',
                        'data' => ArrayHelper::map(GeobaseCity::find()->orderBy('name')->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Select a state ...', 'class' => 'form-control'],
                        'pluginOptions' => [
                            'allowClear' => true,
                        ],
                    ]),
            ],
            [
                'attribute' => 'additional_info',
                'label' => 'Доп. Информация',
                'format' => 'text',
            ],
            'user_id',
            [
                'attribute' => 'user_ip',
                'format' => 'text',
            ],
            [
                'label' => 'БАН',
                'format' => 'raw',
                'value' => function ($model) {
                    if (!isset($model->user_ip)) {
                        return 'Отсутствует IP';
                    } elseif(BannedIp::find()->where(['ip_mask' => $model->user_ip])->exists()) {
                        return '<div class="text-center">
                                    <span class="text-danger">Забанен</span>
                                </div>';
                    } else {
                        return Html::a('Забанить IP',
                            ['delete', 'id' => $model->id, 'ban' => true],
                            [
                                'class' => 'btn btn-xs btn-danger btn-block',
                                'data-method' => 'post',
                                'data-confirm' => 'Забанить IP и удалить все его записи?',
                            ]
                        );
                    }
                }
            ],
            [
                'attribute' => 'moderated',
                'value' => function ($model) {
                    if ($model->moderated) {
                        return Html::a('Заблокировать',
                            ['block', 'id' => $model->id],
                            [
                                'class' => 'btn btn-xs btn-danger btn-block',
                                'data-method' => 'post',
                                'data-confirm' => 'Заблокировать эту запись?',
                            ]
                        );
                    } else {
                        return Html::a('Опубликовать',
                            ['moderate', 'id' => $model->id],
                            [
                                'class' => 'btn btn-xs btn-success btn-block',
                                'data-method' => 'post',
                                'data-confirm' => 'Опубликовать эту запись?',
                            ]
                        );
                    }
                },
                'format' => 'raw',
                'visible' => Yii::$app->getModule('user')->enableConfirmation,
            ],
        ],
    ]); ?>
</div>
