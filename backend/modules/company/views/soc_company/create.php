<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\company\models\SocCompany */

$this->title = 'Создать ссылку на соц. сеть компании';
$this->params['breadcrumbs'][] = ['label' => 'Социальные сети компаний', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soc-company-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
