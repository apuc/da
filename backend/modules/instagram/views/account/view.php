<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\instagram\models\InstAccounts */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Inst Accounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inst-accounts-view">

    <h1><?= Html::encode($model->username) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверенны что хотите удалить этого пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'account_id',
            'username',
            [
                'format' => 'raw',
                "attribute"=>"profile_img",
                "value"=>function($data){
                    return Html::img($data->profile_img);
                }
            ],
            'iprofile_link:url',
        ],
    ]) ?>

</div>
