<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\category\models\CategoryNews */
/* @var $lang \common\models\db\Lang */
/* @var $all_cat \backend\modules\category\models\CategoryNews */

$this->title = Yii::t('category_news', 'Create Category News');
$this->params['breadcrumbs'][] = ['label' => Yii::t('category_news', 'Category News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'lang' => $lang,
        'all_cat' => $all_cat
    ]) ?>

</div>
