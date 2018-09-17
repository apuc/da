<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 10:13
 * @var $company \common\models\db\CategoryCompanyRelations
 * @var $cat \common\models\db\CategoryCompany
 * @var $pages \yii\data\Pagination
 */
use yii\helpers\Url;

$this->title = $cat->title;

?>
<div class="category">
    <div class="category-items category-items-organization">
        <?php foreach($company as $item): ?>
            <a href="<?= Url::to(['/company/default/view', 'slug'=>$item['company']->slug]) ?>" class="category-items-item">
                <div class="thumb">
                    <img src="<?= $item['company']->photo ?>" alt="">
                </div>
                <div class="info">
                    <h2><?= $item['company']->name ?></h2>
                    <p><?= $item['company']->address ?></p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span><?= $item['company']->phone ?></span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
