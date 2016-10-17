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
                    <a href="#" data-id="<?= $item->id ?>" class="element-title main-elem"><span class="marker"></span><span class="square"></span><?= $item->title ?></a>
                </div>
                <div data-id="<?= $item->id ?>" class="clicked-element">
                    <!--            <h2>--><?//= CategoryCompany::find()->where(['id'=>$sub_company[0]->parent_id])->one()->title ?><!--</h2>-->
                    <?php foreach($sub_company as $sub_item): ?>
                        <div class="element">
                            <a href="<?= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?>" class="element-title"><span class="square"></span><?= $sub_item->title ?></a>
                            <p class="element-links">
                                <a href="<?= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?>"><?= CategoryCompanyRelations::find()->where(['cat_id'=>$sub_item->id])->count() ?> предприятий</a>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="category-items ">
            <a href="/company/gggg" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/Organivation/ewkfnh.png" alt="">
                </div>
                <div class="info">
                    <h2>gggg</h2>
                    <p>333</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>444</span>
                </div>
            </a>
            <a href="/company/gosudarstvennaa-inspekcia-po-voprosam-sobludenia-zakonodatelstva-o-trude-dnr" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/Предприятия/ewkfnh.png" alt="">
                </div>
                <div class="info">
                    <h2> Государственная инспекция по вопросам соблюдения законодательства о труде ДНР</h2>
                    <p>г. Донецк, улица Маршака, 2.</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>+38(071) 312-17-86; +38(093) 915-85-83; +38(062) 300-23-62</span>
                </div>
            </a>
            <a href="/company/komissia-po-okazaniu-pomosi-postradavsim-v-sledstvie-voennyh-dejstvij-v-dnr" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/Предприятия/днр_.jpeg" alt="">
                </div>
                <div class="info">
                    <h2>Комиссия по оказанию помощи пострадавшим в следствие военных действий в ДНР</h2>
                    <p>г. Донецк, улица Университетская, 91</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>+38(099) 452-11-59; +38(066) 217-85-19; +38(071) 323-29-12</span>
                </div>
            </a>
            <a href="/company/fond-socialnogo-strahovania-na-slucaj-vremennoj-netrudosposobnosti-i-v-svazi-s-materinstvom-dnr" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/Предприятия/фонд.png" alt="">
                </div>
                <div class="info">
                    <h2> Фонд социального страхования на случай временной нетрудоспособности и в связи с материнством ДНР</h2>
                    <p>г. Донецк, улицы Розы Люксембург, 9</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>+38(062) 334-14-65</span>
                </div>
            </a>
            <a href="/company/fond-socialnogo-strahovania-ot-nescastnyh-slucaev-na-proizvodstve-i-professionalnyh-zabolevanij-dnr" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/%D0%9F%D1%80%D0%B5%D0%B4%D0%BF%D1%80%D0%B8%D1%8F%D1%82%D0%B8%D1%8F/%D1%84%D0%BE%D0%BD%D0%B4%20%D1%81%D0%BE%D1%86%20%D1%81%D1%82%D1%80%D0%B0%D1%85.png" alt="">
                </div>
                <div class="info">
                    <h2>Фонд социального страхования от несчастных случаев на производстве и профессиональных заболеваний ДНР</h2>
                    <p>г. Донецк, улица 50-летия СССР, 149</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>+3(071)-319-79-85</span>
                </div>
            </a>
            <a href="/company/respublikanskij-protezno-ortopediceskij-centr-dnr" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/Предприятия/фонд соц страх.png" alt="">
                </div>
                <div class="info">
                    <h2>Республиканский протезно-ортопедический центр ДНР</h2>
                    <p>г. Донецк, проспект Освобождения Донбасса, 11а</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>+3(062) 311-68-63; +38(062) 311-68-65; +38(071) 314-47-49</span>
                </div>
            </a>
            <a href="/company/respublikanskij-centr-zanatosti-dnr" class="category-items-item">
                <div class="thumb">
                    <img src="/media/upload/Предприятия/труд.png" alt="">
                </div>
                <div class="info">
                    <h2>Республиканский центр занятости ДНР</h2>
                    <p>г. Донецк, улица Ф.Зайцева, 46д</p>
                    <!--<small>135 предприятий</small>-->
                </div>
                <div class="contacts">
                    <span>+38(062) 303-39-39</span>
                </div>
            </a>

        </div>
<!--        <div class="clicked-element">-->
<!--            <h2>--><?////= CategoryCompany::find()->where(['id'=>$sub_company[0]->parent_id])->one()->title ?><!--<!--</h2>-->
<!--            --><?php //foreach($sub_company as $sub_item): ?>
<!--                <div class="element">-->
<!--                    <a href="--><?//= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?><!--" class="element-title"><span class="square"></span>--><?//= $sub_item->title ?><!--</a>-->
<!--                    <p class="element-links">-->
<!--                        <a href="--><?//= Url::to(['/company/company/category', 'slug'=>$sub_item->slug]) ?><!--">--><?//= CategoryCompanyRelations::find()->where(['cat_id'=>$sub_item->id])->count() ?><!-- предприятий</a>-->
<!--                    </p>-->
<!--                </div>-->
<!--            --><?php //endforeach; ?>
<!--        </div>-->
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