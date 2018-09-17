<?php
    $class = '';
    if(Yii::$app->controller->action->id == 'search-post'){
    $class = 'search-consulting-widget';
} ?>
<div class="consultants__main <?= $class ?>" >
    <form action="<?= \yii\helpers\Url::to(['/consulting/consulting/search-post'])?>" method="get" class="search-block">
        <input type="text" name="q" placeholder="Поиск">
        <button>Найти</button>
    </form>
</div>