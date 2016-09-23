<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('news', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('news', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('news', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            /*'id',*/
            'title',
            'content:html',
            [                      // the owner name of the model
                'attribute' => 'dt_add',
                'label' => 'Дата добавления',
                'value' => date('Y-m-d H:i', $model->dt_add),
            ],
            [                      // the owner name of the model
                'attribute' => 'dt_update',
                'label' => 'Дата редактирования',
                'value' => date('Y-m-d H:i', $model->dt_update),
            ],
            'slug',
            'tags',
            [                      // the owner name of the model
                'label' => 'photo',
                'format' => 'html',
                'value' => Html::img($model->photo, ['width'=>'200px']),
            ],
            [                      // the owner name of the model
                'label' => 'Автор',
                'attribute' => 'photo',
                'value' => \common\models\User::find()->where(['id'=>$model->user_id])->one()->username,
            ],
            /*'status',*/
            /*'user_id',*/
            /*'lang_id',*/
        ],
    ]) ?>
    <?php
    $st = strip_tags($model->content);
    $st = preg_replace("/\s{2,}/"," ",$st);
    ?>
    <a onclick="Share.vkontakte('<?= 'http://'.$_SERVER['HTTP_HOST'] . '/news/' . $model->slug ?>','<?= $model->title ?>','<?= 'http://'.$_SERVER['HTTP_HOST'] . $model->photo?>','<?= $st ?>')">VK</a>
    <a onclick="Share.facebook('<?= 'http://'.$_SERVER['HTTP_HOST'] . '/news/' . $model->slug ?>','<?= $model->title ?>','<?= 'http://'.$_SERVER['HTTP_HOST'] . $model->photo?>','<?= $st ?>')">FB</a>
</div>
