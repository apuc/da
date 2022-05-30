<?php

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
        ]
    ]);
 ?>