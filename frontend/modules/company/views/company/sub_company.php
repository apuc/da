<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 03.10.2016
 * Time: 16:45
 * @var $sub_company CategoryCompany
 */
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use yii\helpers\Url;

?>
<!--<h2>--><?//= CategoryCompany::find()->where(['id'=>$sub_company[0]->parent_id])->one()->title ?><!--</h2>-->
<?php foreach($sub_company as $sub_item): ?>
    <div class="element">
<!--        <a href="--><?//= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?><!--" class="element-title"><span class="square"></span>--><?//= $sub_item->title ?><!--</a>-->
        <a href="" data-id="<?= $sub_item->id; ?>" class="element-title"><span class="square"></span><?= $sub_item->title ?></a>

        <p class="element-links">
<!--            <a href="--><?//= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?><!--">--><?//= CategoryCompanyRelations::find()->where(['cat_id'=>$sub_item->id])->count() ?><!-- предприятий</a>-->
            <a href="#"><?= CategoryCompanyRelations::find()->where(['cat_id'=>$sub_item->id])->count() ?> предприятий</a>
        </p>
    </div>
<?php endforeach; ?>
