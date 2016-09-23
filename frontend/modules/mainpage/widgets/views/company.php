<?php
/**
 * @var $category \backend\modules\category_company\models\CategoryCompany
 * @var $company \common\models\db\Company
 */
use yii\helpers\Url;

?>

<div class="title">
    <h2>каталог предприятий</h2>
    <div class="title-right">
        <a href="" class="all-news">все предпреиятия</a>
    </div>
</div>
<div class="category">
    <div class="category-list-block">
        <ul class="category-list">
            <?php foreach ($category as $item): ?>
                <li class="company_list_item"><a href="#" data-id="<?= $item->id ?>"><?= $item->title ?></a></li>
            <?php endforeach; ?>
        </ul>
        <!--<ul class="category-list-hide">
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
            <li><a href="">бытовая техника</a></li>
            <li><a href="">городские службы, учереждения</a></li>
            <li><a href="">флора и фауна</a></li>
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
        </ul>
        <span class="more-categories"><b></b><b></b><b></b>еще рубрики</span>-->
    </div>
    <!--<div class="category-list-block-mob">
        <ul class="category-list">
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
            <li><a href="">бытовая техника</a></li>
            <li><a href="">городские службы, учереждения</a></li>
            <li><a href="">флора и фауна</a></li>
            <li><a href="">Авто</a></li>
        </ul>
        <ul class="category-list-hide-mob">
            <li><a href="">Бизнес услуги</a></li>
            <li><a href="">бытовая техника</a></li>
            <li><a href="">городские службы, учереждения</a></li>
            <li><a href="">флора и фауна</a></li>
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
            <li><a href="">бытовая техника</a></li>
            <li><a href="">городские службы, учереждения</a></li>
            <li><a href="">флора и фауна</a></li>
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
            <li><a href="">бытовая техника</a></li>
            <li><a href="">городские службы, учереждения</a></li>
            <li><a href="">флора и фауна</a></li>
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
            <li><a href="">бытовая техника</a></li>
            <li><a href="">городские службы, учереждения</a></li>
            <li><a href="">флора и фауна</a></li>
            <li><a href="">Авто</a></li>
            <li><a href="">Бизнес услуги</a></li>
        </ul>
        <span class="more-categories"><b></b><b></b><b></b>еще рубрики</span>
    </div>-->
    <div class="category-items ">
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

        <!--<a href="#" class="category-items-item">
            <div class="thumb">
                <img src="/theme/portal-donbassa/img/pic-item.png" alt="">
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
                <img src="/theme/portal-donbassa/img/pic-item.png" alt="">
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
                <img src="/theme/portal-donbassa/img/pic-item.png" alt="">
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
                <img src="/theme/portal-donbassa/img/pic-item.png" alt="">
            </div>
            <div class="info">
                <h2>Art-Noks, торговая компания</h2>
                <p>50 лет СССР, 168</p>
                <small>135 предприятий</small>
            </div>
            <div class="contacts">
                <span>+380 (66) 555 44 32</span>
            </div>
        </a>-->
    </div>
</div>