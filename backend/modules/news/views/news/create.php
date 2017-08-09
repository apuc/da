<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\news\models\News */
/* @var $lang \common\models\db\Lang */
/* @var $cats_arr array */

$this->title = Yii::t('news', 'Create News');
$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lang' => $lang,
        'cats_arr' => [],
        'tags' => $tags,
        'tags_selected' => $tags_selected,
    ]) ?>

</div>
