<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\db\CompanyViews */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('company_views', 'Company Views'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-views-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('company_views', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('company_views', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('company_views', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => \yii\helpers\ArrayHelper::getValue($model, 'user.username')
            ],
            [
                'attribute' => 'company_id',
                'value' => \yii\helpers\ArrayHelper::getValue($model, 'company.name')
            ],
            'date',
            [
                'attribute' => 'ip_address',
                'value' => function ($model) {
                    return long2ip($model->ip_address);
                },
            ],
            'count',
        ],
    ]) ?>

</div>
