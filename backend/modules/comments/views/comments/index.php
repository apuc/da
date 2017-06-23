<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\comments\models\CommentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('comments', 'Comments');
$this->params['breadcrumbs'][] = $this->title;

/*$script = "
        function setParams(){
        console.log(123);
            var keyList = $('#grid').yiiGridView('getSelectedRows');
            console.log(keyList);
            
            if(keyList != '') {
                $('#btn-multi-del').attr('data-params', JSON.stringify({keyList}));
            } else {
                $('#btn-multi-del').removeAttr('data-params');
            }
        };";
$this->registerJs($script, yii\web\View::POS_BEGIN);*/

?>
<div class="comments-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <? /*= Html::a(Yii::t('comments', 'Create Comments'), ['create'], ['class' => 'btn btn-success']) */ ?>
    </p>-->

    <?php
/*    echo Html::a('Удалить выбранные', ['multi-delete'], [
        'id' => 'btn-multi-del',
        'class' => 'btn btn-default',
        'onclick' => 'setParams()',
        'data' => [
            'confirm' => 'Вы действительно хотите удалить выбранные элементы?',
            'method' => 'post',
        ],
    ]);
    */?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            /*[
                /*'class' => 'yii\grid\CheckboxColumn',*/
                /*'checkboxOptions' => function ($model, $key, $index, $column) {
                    return ['value' => $model->id];
                }
            ],*/

            'content:ntext',
            //'id',
            'post_type',
            'post_id',
            'user_id',

            // 'dt_add',
            // 'parent_id',
            'moder_checked',
            'published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
