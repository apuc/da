<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 16:02
 * @var $parent_category array
 * @var $sub_category_by_parent array
 */
use common\models\db\CategoryCompany;
use yii\helpers\Url;

?>

<div class="business__sidebar" id="business-sidebar">

    <a href="<?= Url::to(['/site/design']);?>" class="business__sidebar--add">Добавить предприятие</a>

    <div id="business-sidebar-main" class="business__sidebar--items">

        <?php foreach ($parent_category as $item): ?>
            <ul>
                <?php foreach ($item as $category): ?>
                    <li><a href="" data-id="<?= $category->id ?>"><?= $category->title ?></a></li>
                <?php endforeach; ?>
            </ul>

        <?php endforeach; ?>

    </div>
    <?php foreach ($sub_category_by_parent as $id => $item): ?>
        <?php $item = array_chunk($item, count($item) / 2) ?>
        <div id="business-sidebar-hover-<?= $id ?>" class="business__sidebar--hover-items">

            <div href="#" class="business__sidebar--hover-title"><?= CategoryCompany::findOne($id)->title ?>

                <a href="#" class="business__sidebar--hover-trigger"></a>

            </div>
            <ul>
                <?php foreach ($item[0] as $sub_cat): ?>
                    <li>
                        <a href="<?= Url::to(['/company/company/view-category', 'slug' => $sub_cat['slug']]) ?>">
                            <?= $sub_cat['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <ul>
                <?php foreach ($item[1] as $sub_cat): ?>
                    <li>
                        <a href="<?= Url::to(['/company/company/view-category', 'slug' => $sub_cat['slug']]) ?>">
                            <?= $sub_cat['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
    <?php endforeach; ?>
</div>
