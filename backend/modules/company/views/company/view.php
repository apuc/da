<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\Company */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('company', 'Companies'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('company', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('company', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('company', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',*/
            'name',
            'address',
            [
                'attribute' => 'phone',
                'value' => function($model)
                {
                    $result = '';
                    $phones = \common\models\db\Phones::find()->where(['company_id' => $model->id])->all();
                    foreach ($phones as $phone)
                    {
                        $result .= $phone->phone."; ";
                    }
                    return $result;
                }
            ],
            'email:email',
            [                      // the owner name of the model
                'attribute' => 'photo',
                'format' => 'html',
                'value' => "<img src='$model->photo' width='200px'>",
            ],
            /*'dt_add',*/
            /*'dt_update',*/
            'descr:ntext',
            /*'status',*/
            'slug',
            /*'lang_id',*/
        ],
    ]) ?>

</div>
