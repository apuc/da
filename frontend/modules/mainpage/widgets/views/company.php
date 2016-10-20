<?php
/**
 * @var $category \backend\modules\category_company\models\CategoryCompany
 * @var $company \common\models\db\Company
 */
use yii\helpers\Url;

?>

<div class="title">
    <div class="title-left-side title-full-width">
        <h2>каталог предприятий</h2>
        <div class="title-right">
            <a href="<?= Url::to(['/company/company/create']) ?>" class="add-organization"><i class="fa fa-plus"></i>Добавить предприятие</a>
            <a href="<?= Url::to(['/company/company']) ?>" class="all-news"><i class="fa fa-users" aria-hidden="true"></i> все предприятия</a>
        </div>
    </div>
</div>
<div class="shape">
    <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
</div>
<div class="category">
    <div class="category-list-block">
        <ul class="category-list">
            <?php foreach ($category as $item): ?>
                <li class="company_list_item"><a href="<?= Url::to(['/company/company/category', 'slug'=>$item->slug]) ?>" data-id="<?= $item->id ?>"><?= $item->title ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="category-items ">
        <?php foreach($company as $item): ?>
            <a href="<?= Url::to(['/company/default/view', 'slug' => $item->slug]) ?>" class="category-items-item">
                <div class="thumb">
                    <img src="<?= $item->photo ?>" alt="">
                </div>
                <div class="info">
                    <h2><?= $item->name ?></h2>
                    <p><?= $item->address ?></p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span><?= $item->phone ?></span>
                </div>
            </a>
        <?php endforeach; ?>

    </div>
</div>