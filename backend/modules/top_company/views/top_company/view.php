<?php

use common\models\db\Company;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\top_company\models\TopCompany */
$cn = Company::find()->where(['id'=>$model->company_id])->one()->name;
$this->title = $cn;
$this->params['breadcrumbs'][] = ['label' => 'Top Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [                      // the owner name of the model
                'attribute' => 'company_id',
                'label' => 'Компания',
                'value' => $cn,
            ],
            'order',
        ],
    ]) ?>

</div>
