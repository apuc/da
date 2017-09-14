<?php
/**
 * @var $ads
 */
//\common\classes\Debug::prn($ads);
?>

<p>
    <a class="btn btn-success"
       href="<?= \yii\helpers\Url::to(['edit-status', 'status' => 2, 'id' => $ads->id])?>">
        Опубликовать
    </a>
    <a class="btn btn-warning"
       href="<?= \yii\helpers\Url::to(['edit-status', 'status' => 6, 'id' => $ads->id])?>">
        Снять с публикации
    </a>
    <a class="btn btn-danger"
       href="<?= \yii\helpers\Url::to(['edit-status', 'status' => 3, 'id' => $ads->id])?>">
        Удалить
    </a>
</p>

<table id="w0" class="table table-striped table-bordered detail-view">
    <tbody>
    <tr>
        <th>Категория</th>
        <td>
            <?php
            $listcat = \frontend\modules\board\models\BoardFunction::getCategoryById($ads->category_id, []);
            $listcat = array_reverse($listcat);
            $k = 1;
            foreach ($listcat as $val): ?>
                <?= $val->name; ?>
                <?= ($k == count($listcat)) ? '' : '<span class="separatorListCategory">|</span>' ?>
                <?php $k++; endforeach ?>
        </td>
    </tr>
    <tr>
        <th>Заголовок</th>
        <td><?= $ads->title; ?></td>
    </tr>
    <tr>
        <th>Описание</th>
        <td><?= $ads->content; ?></td>
    </tr>
    <tr>
        <th>Цена</th>
        <td><?= $ads->price; ?></td>
    </tr>
    <tr>
        <th>Телефон</th>
        <td><?= $ads->price; ?></td>
    </tr>
    </tbody>
</table>

<div>
    <h2>Дополнительные поля</h2>
    <div class="ad-info">
        <?php
        if (!empty($ads->adsFieldsValues)):
            foreach ($ads->adsFieldsValues as $item):
                ?>
                <div class="commercial__ads-descr--row">
                    <span><?= \frontend\modules\board\models\BoardFunction::getLabelAdditionalField($item->ads_fields_name) ?></span>
                    <span><?= $item->value ?></span>
                </div>

                <?php
            endforeach;
        endif; ?>
    </div>
</div>

<div>
    <h2>Изображения</h2>
    <?php if (!empty($ads->adsImgs)): ?>
        <?php
        foreach ($ads->adsImgs as $item):
            ?>
            <div class="ads_img">
                <img src="<?= $item->img; ?>" alt="">
                <a href="#" data-id="<?= $item->id; ?>" class="deleteImgBack deleteImgAjax"></a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Пользователь не загрузил фото</p>
    <?php endif; ?>
</div>
