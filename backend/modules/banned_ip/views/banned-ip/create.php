<?php

use backend\modules\banned_ip\BannedIp;

/**
 * @var $model BannedIp
 */
?>

<div>
    <h1>Добавить IP</h1>

    <?=  $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>