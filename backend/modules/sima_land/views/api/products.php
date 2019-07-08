<?php

use yii\data\ArrayDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\company\models\CompanySearch */
/* @var $dataProvider yii\data\ArrayDataProvider */

$this->title = Yii::t('sima_land', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'name',
            [
//              'name' => 'Категория',
              'value' =>  function($model)
              {
                  $tmp = \common\models\db\SimaCategory::getCategoryName($model['category_id']);
                  return $tmp[0]['name'];
              },
//                'filter' => \kartik\select2\Select2::widget([
//                        'model' => $searchModel,
//                        'attribute' => 'category_id',
//                        'data' => \yii\helpers\ArrayHelper::map(\common\models\db\SimaCategory::getAllCategory()),
//                        'options' => ['placeholder' => 'Select a state ...','class' => 'form-control'],
//                        'pluginOptions' => [
//                             'allowClear' => true
//                         ],
//                ])
            ],
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <p>
        <?= Html::a('Предыдущая страница', ['/sima_land/api/products' , 'page' => $page - 1 ], ['class' => 'btn btn-success']) ?>
        <?= Html::label('Текущая страница: ' . $page) ?>
        <?= Html::a('Следующая страница', ['/sima_land/api/products' , 'page' => $page + 1], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <form action="<?= \yii\helpers\Url::to('/secure/sima_land/api/products')?>" method="get">
        <input type="text" name="page" placeholder="Введите номер страницы">
        <input type="submit">
    </form>
    </p>
</div>

