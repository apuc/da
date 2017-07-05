<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\jui\DatePicker;

$this->title = 'Заказы компаний на изменения тарифов';

?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'company_id',
        'tariff_id',
        'dt_end_tariff',
        [
            'label' => 'Подключить',
            'format' => 'raw',
            'value' => function($model){
                if($model->dt_end_tariff == 0){

                    /*return '<button class="btn btn-success to_plug--tariff" data-toggle="modal" data-target="#myModal">
                        Подключить
                    </button>';*/

                    return Html::button('Подключить',
                        [
                            'class' => 'btn btn-success to_plug--tariff',
                            'data-id' => $model->id,
                            'company-id' => $model->company_id,
                            'tariff-id' => $model->tariff_id,
                            'data-toggle' => 'modal',
                            'data-target' => '#myModal'
                        ]);
                }else{
                    return '<span class="btn btn-info">Тариф подключен</span>';
                }
            },
        ],

    ],
]); ?>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Название модали</h4>
            </div>
            <div class="modal-body">

                <p>Выберите окончание действия тарифа</p>
                <?= DatePicker::widget([
                //'model' => $model,
                    'name' => 'dt_end_tariff',
                    'id' => 'dt_end_tariff',
                    'attribute' => 'from_date',
                    'language' => 'ru',
                    'dateFormat' => 'dd-MM-yyyy',
                ]);
            ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" id="info--order--tariff" class="btn btn-primary">Сохранить изменения</button>
            </div>
        </div>
    </div>
</div>