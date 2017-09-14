<?php
/**
* @var $ads
*/

use yii\widgets\LinkPager;

$this->title = 'Объявления';
?>

<section class="content">
    <div class="stock-index">

        <h1><?= $this->title; ?></h1>

        <div id="w0" class="grid-view">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Заголовок</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($ads as $item): ?>
                    <tr>
                        <td><?= $item->title; ?></td>
                        <td>
                            <?php
                                switch ($item->status){
                                    case 1: echo 'На модерации';break;
                                    case 2: echo 'Опубликованно';break;
                                    case 3: echo 'Удалено';break;
                                    case 4: echo 'VIP';break;
                                    case 5: echo 'Снято с публикации';break;
                                    case 6: echo 'Снято с публикации (модератор)';break;

                                }
                            ?>
                        </td>
                        <td><a href="<?= \yii\helpers\Url::to(['view', 'id' => $item->id])?>">Посмотреть</a></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
            <div class="pagination">
                <?= LinkPager::widget(
                    [
                        'pagination' => $pagination,
                        'options' => [
                            'class' => '',
                        ],
                        'prevPageCssClass' => 'pagination-prew',
                        'nextPageCssClass' => 'pagination-next',
                        'prevPageLabel' => '',
                        'nextPageLabel' => '',
                        'activePageCssClass' => 'active',

                    ]) ?>
            </div>
        </div>
    </div>
</section>