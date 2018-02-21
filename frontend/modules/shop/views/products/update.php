<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\news\models\News */
/* @var $userCompany frontend\modules\company\models\Company */

$this->title = 'Редактирование товара';
/*$this->params['breadcrumbs'][] = ['label' => Yii::t('news', 'News'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>

<div class="cabinet__container cabinet__container_white cabinet__inner-box">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="right">
        <?= $this->render('_form-update', [
            /*'model' => $model,
            'userCompany' => $userCompany,*/
        ]) ?>
    </div>


</div>