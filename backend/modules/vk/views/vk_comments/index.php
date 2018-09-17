<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vk\models\VkCommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vk Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vk-comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Vk Comments', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'vk_id',
            'from_id',
            'owner_id',
            'post_id',
            // 'dt_add',
            // 'text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
