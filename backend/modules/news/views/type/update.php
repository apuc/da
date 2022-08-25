<?php

/** @var NewsType $model */

use backend\modules\news\models\NewsType;

?>
<div style="width: 30%">
    <h1>Редактировать</h1>

    <?=  $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>