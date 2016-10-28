<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 16:35
 * @var $top_company \common\models\db\TopCompany
 */
?>
<?php //echo \common\classes\Debug::prn($top_company); ?>
<?php //foreach($top_company as $top_company): ?>
<!--    <a href="--><?//= \yii\helpers\Url::to(['/company/default/view', 'slug'=>$item->slug]) ?><!--">-->
<!--        <div class="right-bar__ad_items">-->
<!--            <img src="--><?//= $item->photo ?><!--" alt="">-->
<!--            <h4>--><?//= $item->name ?><!--</h4>-->
<!--            <span>--><?//= $item->address ?><!--</span>-->
<!--        </div>-->
<!--    </a>-->
<?php //endforeach; ?>
<?php foreach($top_company as $item): ?>
<!--    <a href="--><?//= Url::to(['/company/default/view', 'slug' => $item->slug]) ?><!--" class="category-items-item">-->
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
