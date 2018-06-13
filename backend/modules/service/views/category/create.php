<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\CategoryShop */
/* @var $category \backend\modules\products\models\CategoryProduct[] */

$this->title = 'Создать категорию';
$this->params['breadcrumbs'][] = ['label' => 'Категории', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-shop-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'category' => $category
    ]) ?>

</div>
