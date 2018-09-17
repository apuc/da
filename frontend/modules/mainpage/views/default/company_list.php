<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 08.09.2016
 * Time: 15:25
 * @var $company \common\models\db\Company
 */
use yii\helpers\Url;

?>
<?php foreach($company as $item): ?>
    <a href="<?= Url::to(['/company/default/view', 'slug' => $item->slug]) ?>" class="category-items-item">
        <div class="thumb">
            <img src="<?= $item->photo ?>" alt="">
        </div>
        <div class="info">
            <h2><?= $item->name ?></h2>
            <p><?= $item->address ?></p>
            <small>135 предприятий</small>
        </div>
        <div class="contacts">
            <span><?= $item->phone ?></span>
        </div>
    </a>
<?php endforeach; ?>
