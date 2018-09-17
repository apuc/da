<?php
$this->title = "Мои коментарии"
?>

<div class="cabinet__inner-box">

    <h3>Мои коментарии</h3>


    <?= \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_list',

        'itemOptions' => [
            'tag' => 'div',
            'class' => 'cabinet__like-block',
        ],
        'emptyText' => '<div class="cabinet__add-element"><p>Раздел пока пуст</p></div>',
        'emptyTextOptions' => [
            'tag' => 'div',
        ],
        'layout' => "{items}<div class=\"pagination\">{pager}</div>",
        'pager' => [
            'options' => [
                'class' => '',
            ],
            'prevPageCssClass' => 'pagination-prew',
            'nextPageCssClass' => 'pagination-next',
            'prevPageLabel' => '',
            'nextPageLabel' => '',
            'activePageCssClass' => 'active',
            'maxButtonCount' => 5,
        ],
    ])?>

</div>
