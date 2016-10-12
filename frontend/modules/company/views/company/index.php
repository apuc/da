<?php
/**
 * @var $company CategoryCompany
 * @var $sub_company CategoryCompany
 */
use common\models\db\CategoryCompany;
use common\models\db\CategoryCompanyRelations;
use yii\helpers\Url;

$this->title = "Предприятия";

?>
<div class="category">
    <div class="category-list">
        <div class="category-list-items">
            <?php foreach ($company as $item):?>
                <div class="element">
                    <a href="#" data-id="<?= $item->id ?>" class="element-title"><span class="square"></span><?= $item->title ?></a>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="clicked-element">
            <h2><?= CategoryCompany::find()->where(['id'=>$sub_company[0]->parent_id])->one()->title ?></h2>
            <?php foreach($sub_company as $sub_item): ?>
                <div class="element">
                    <a href="<?= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?>" class="element-title"><span class="square"></span><?= $sub_item->title ?></a>
                    <p class="element-links">
                        <a href="<?= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?>"><?= CategoryCompanyRelations::find()->where(['cat_id'=>$sub_item->id])->count() ?> предприятий</a>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!--<div class="category-items category-items-organization">
        <a href="#" class="category-items-item">
            <div class="thumb">
                <img src="img/pic-item.png" alt="">
            </div>
            <div class="info">
                <h2>Art-Noks, торговая компания</h2>
                <p>50 лет СССР, 168</p>
                <small>135 предприятий</small>
            </div>
            <div class="contacts">
                <span>+380 (66) 555 44 32</span>
            </div>
        </a>
        <a href="#" class="category-items-item">
            <div class="thumb">
                <img src="img/pic-item.png" alt="">
            </div>
            <div class="info">
                <h2>Art-Noks, торговая компания</h2>
                <p>50 лет СССР, 168</p>
                <small>135 предприятий</small>
            </div>
            <div class="contacts">
                <span>+380 (66) 555 44 32</span>
            </div>
        </a>
        <a href="#" class="category-items-item">
            <div class="thumb">
                <img src="img/pic-item.png" alt="">
            </div>
            <div class="info">
                <h2>Art-Noks, торговая компания</h2>
                <p>50 лет СССР, 168</p>
                <small>135 предприятий</small>
            </div>
            <div class="contacts">
                <span>+380 (66) 555 44 32</span>
            </div>
        </a>
        <a href="#" class="category-items-item">
            <div class="thumb">
                <img src="img/pic-item.png" alt="">
            </div>
            <div class="info">
                <h2>Art-Noks, торговая компания</h2>
                <p>50 лет СССР, 168</p>
                <small>135 предприятий</small>
            </div>
            <div class="contacts">
                <span>+380 (66) 555 44 32</span>
            </div>
        </a>
        <a href="#" class="category-items-item">
            <div class="thumb">
                <img src="img/pic-item.png" alt="">
            </div>
            <div class="info">
                <h2>Art-Noks, торговая компания</h2>
                <p>50 лет СССР, 168</p>
                <small>135 предприятий</small>
            </div>
            <div class="contacts">
                <span>+380 (66) 555 44 32</span>
            </div>
        </a>
    </div>-->
</div>