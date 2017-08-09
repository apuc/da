<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\vk\models\VkStreamSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vk Streams';
$this->params['breadcrumbs'][] = $this->title;
?>
<?$this->registerJsFile('/secure/js/bootstrap/js/bootstrap.min.js', ['depends' => \yii\web\JqueryAsset::className()])?>
<div class="vk-stream-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'vk_id',
                'format' => 'raw',
                'value' => function ($model) {
                    $domain = \common\models\db\VkGroups::find()->where(['vk_id' => $model->owner_id])->one();
                    if ($domain) {
                        return Html::a('Ссылка',
                            'https://vk.com/' . $domain->domain . '?w=wall' . $model->vk_id,
                            [
                                'target' => '_blank',
                            ]);
                    }

                },
            ],
            //'from_id',
            //'owner_id',
            /*'owner_type',*/
            [
                'attribute' => 'dt_add',
                'value' => function ($model) {
                    return date('Y-m-d H:i', $model->dt_add);
                },
            ],
            // 'post_type',
            [
                'attribute' => 'text',
                'format' => 'raw',
                'value' => function ($model) {
                    $photo = \common\models\db\VkPhoto::find()->where(['post_id' => $model->id])->all();
                    $gif = \common\models\db\VkGif::find()->where(['post_id' => $model->id])->all();
                    $text = '';

                    if(strlen($model->text) > 200)
                    {

                        $string = mb_substr($model->text, 0, 200);
                        $text = '<div>'.$string.'...</div>'.Html::a('Читать далее',['#'], ['class' => 'more']).
                            Html::a('Скрыть',['#'], ['class' => 'closeMore', 'style' => 'display: none']);
                        $text .= '<div class="readMore" style="display: none">'.substr($model->text, strlen($string)).'</div>';
                    }

                    $text .= '<div>';

                    foreach ((array)$photo as $item) {
                        if (!empty($item->photo_807)) {
                            $text .= '<span>' . Html::img($item->photo_807, ['width' => 300]) . '</span>';
                        } elseif (!empty($item->photo_604)) {
                            $text .= '<span>' . Html::img($item->photo_604, ['width' => 300]) . '</span>';
                        } elseif (!empty($item->photo_130)) {
                            $text .= '<span>' . Html::img($item->photo_130, ['width' => 200]) . '</span>';
                        } else {
                            $text .= '<span>' . Html::img($item->photo_75, ['width' => 200]) . '</span>';
                        }
                    }
                    $text .= '</div><div>';

                    foreach ((array)$gif as $item) {

                        if (!empty($item->gif_link)) {
                            $text .= '<span>' . Html::img($item->gif_link, ['width' => 300]) . '</span>';
                        }
                    }

                    $text .= '</div>';
                    return $text;
                },
            ],
            /*[
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model->status === 0){
                        return Html::a('Опубликовать', ['#'], ['data-id' => $model->id, 'data-status' => 1, 'class' => 'publish']);
                    }
                    if($model->status === 1){
                        return Html::a('Снять публикацию', ['#'], ['data-id' => $model->id, 'data-status' => 0, 'class' => 'publish']);
                    }
                },
            ],*/
            [
                'attribute' => 'Comments',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a('Комментарии', ['#'], ['class' => 'comments-stream', 'data-id' => $model->id]).
                        '('.\common\models\db\VkComments::find()->where(['post_id' => $model->id])->count().')';
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a('Удалить', ['#'], ['class' => 'btn btn-danger delete_from_basket', 'data-id' => $model->id]);
                },
            ],
        ],
    ]); ?>
</div>
<div id="myModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <table class="table table-responsive">
                <thead>
                <th>Пользователь</th>
                <th>Комментарий</th>
                <th>Дата</th>
                </thead>
                <tbody class="content-comments">
                </tbody>
            </table>
        </div>
    </div>
</div>