<?php
/* @var $this yii\web\View */
/* @var $model backend\modules\banned_ip\BannedIp */
?>
<div class="news-update">

    <h1>Редактировать IP-маску</h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>