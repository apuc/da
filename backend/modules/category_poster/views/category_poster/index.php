<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\category_poster\models\CategoryPosterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('poster', 'Category Posters');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-poster-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('poster', 'Create Category Poster'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            /*'id',*/
            /*'parent_id',*/
            'title',
            'descr:ntext',
            /*'dt_add',*/
            // 'dt_update',
            // 'icon',
            // 'meta_title',
            // 'meta_descr',
            // 'slug',
            // 'lang_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
