<?php
    $this->title = "Мои компании";
?>

<div class="cabinet__inner-box">

    <h3>Мои компании</h3>

    <a href="<?= \yii\helpers\Url::to(['/company/company/create']); ?>" class="cabinet__inner-box--add">
        добавить
        <span>
            <img src="/theme/portal-donbassa/img/icons/add-pkg-icon.png" alt="">
        </span>
    </a>

    <div class="cabinet__inner-box--hover">
        <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_list',

            'itemOptions' => [
                'tag' => 'div',
                'class' => 'cabinet__like-block',
            ],
            'emptyText' => '<div class="cabinet__add-element"><p>Раздел пока пуст</p><a href="'. \yii\helpers\Url::to(['/company/company/create']) .'" class="show-more">добавить</a></div>',
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
</div>