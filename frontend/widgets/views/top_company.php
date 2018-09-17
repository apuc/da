<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 16:35
 * @var $top_company \common\models\db\TopCompany
 */
?>

<?php foreach($top_company as $item): ?>
    <a href="<?= \yii\helpers\Url::to(['/company/default/view', 'slug'=>$item->company['slug']]) ?>">
        <div class="right-bar__ad_items">
            <img src="<?= $item->company['photo'] ?>" alt="">
            <h4><?= $item->company['name'] ?></h4>
            <span><?= $item->company['address'] ?></span>
        <span class="rb-separator"></span>
        </div>
    </a>
<?php endforeach; ?>
