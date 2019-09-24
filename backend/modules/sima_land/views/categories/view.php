<?php

use Classes\Wrapper\Wrapper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model Wrapper/CategoryItem */

$this->title = $model->name . ' #' . $model->id;
$this->params['breadcrumbs'][] = [ 'label' => 'Категории' , 'url' => [ 'index' ] ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    DetailView::widget(array(
        'model' => $model ,
        'attributes' => array(
            'id' ,
            'sid' ,
            'name' ,
            'full_slug' ,
            'path' ,
            'level' ,
            'type' ,
            'priority' ,
            'priority_home' ,
            'priority_menu' ,
            'photo' ,
            'icon' ,
            'has_loco_slider' ,
            'has_design' ,
            'has_as_main_design' ,
            'is_hidden_in_menu' ,
            'is_adult' ,
            'is_for_mobile_app' ,
            'is_item_description_hidden' ,
            'is_for_mobile_app' ,
            'is_for_mobile_app' ,
        ) ,
    ));
    ?>

</div>
