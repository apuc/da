<?php

use backend\modules\banned_ip\models\BannedIpSearch;
use common\classes\UserFunction;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

/** @var ActiveDataProvider $dataProvider */
/** @var BannedIpSearch $searchModel */

?>
<div>
    <h1>Забаненные IP</h1>
    <p>
        <?= Html::a('Добавить IP', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=

    \yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
            'id',
            'ip_mask',
        ]
    ]);

    ?>
</div>
