<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocCompany */

$this->title = $model->company->name;
$this->params['breadcrumbs'][] = ['label' => 'Социальные сети компаний', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить элемент?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'company_id',
            [
                'attribute' =>  'company_id',
                'value'     =>  function($data){
                    return $data->company->name;
                }
            ],
            //'link',
            [
                'attribute'=>'link',
                'value'=>function ($data){
                    return '<a href="'.$data->link.'">'.$data->link.'</a>';
                },
                'format'=>'html'
            ],
            //'soc_type',
            [
                'attribute' =>  'soc_type',
                'value'     =>  function($data){
                    return '<img src="'.$data->socType->icon.'">';
                },
                'format'=>'html'
            ],
        ],
    ]) ?>

</div>
