<?php

use common\classes\UserFunction;
use yii\grid\GridView;
use yii\helpers\Html;

?>

    <h1>Типы событий</h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?=
 GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        'id',
        'label',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => UserFunction::hasRoles(['admin']) ? '{update} &nbsp&nbsp {delete}' : '',
        ],
        ]
    ]);
 ?>