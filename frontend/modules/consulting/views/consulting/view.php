<?php use yii\helpers\Url;

; ?>
<div class="consult-item">
    <div class="consult-item-mnu">
        <!--            <img src="--><? //= $consulting->icon; ?><!--" alt="" class="consult-img">-->
        <p class="consult-img">
            <i class="fa <?= $consulting->icon; ?>"></i>
        </p>
        <h4><?= $consulting->title; ?></h4>
        <div class="shape">
            <img src="/theme/portal-donbassa/img/shape-line.png" alt="">
        </div>
        <ul class="consult-item-mnu-menu">
            <li>
                <a href="<?= Url::to( [ "/consulting/view", 'slug' => $consulting->slug ] ); ?>" class="active"><span
                        class="marker"></span>О компании</a>
            </li>
            <li>
                <a class="parent" href="#"><span class="marker"></span>Нормативно-правовые и законодательные акты</a>
                <ul class="consult-item-mnu-menu inserted">
                    <?php foreach ( $categories_digest as $cat_digest ): ?>
                        <li><a href="#"><?= $cat_digest->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a class="parent" href="#"><span class="marker"></span>Статьи</a>
                <ul class="consult-item-mnu-menu inserted">
                    <?php foreach ( $categories_posts as $cat_posts ): ?>
                        <li><a href="#"><?= $cat_posts->title ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
            <li>
                <a class="parent" href="#"><span class="marker"></span>Налоговый раздел</a>
            </li>
            <li>
                <a class="" faq-id="0" href="<?= Url::to( [ '/faq/' . $consulting->slug ] ) ?>"><span
                        class="marker"></span>Вопрос / ответ</a>
                <?= \frontend\modules\consulting\widgets\GenerateCatTree::widget( [
                    'categories_faq' => $categories_faq,
                    'id_attr'        => 'faq-id',
                    'url'        => $url,
                ] ); ?>

                <!--                    <ul class="consult-item-mnu-menu inserted">-->
                <!--                        --><?php //foreach ($categories_faq as $cat_faq): ?>
                <!--                            <li><a href="#">--><? //= $cat_faq['title']?><!-- [-->
                <? //= $cat_faq['memberCount']; ?><!-- вопросов]</a></li>-->
                <!--                        --><?php //endforeach; ?>
                <!--                    </ul>-->
            </li>
        </ul>
    </div>
    <div class="consult-item-content">
        <h4 class="company-title">"<?= $company->name; ?>"</h4>
        <p class="company-descr"><?= $company->descr; ?></p>
        <!--            <img src="/theme/portal-donbassa/img/map.png" class="company-map" alt="">-->
        <div id="map" style="width: 100%; height: 150px; padding: 0; margin: 0;"></div>
        <p class="company-location"><?= $company->address; ?></p>
        <p class="company-phone"><?= $company->phone; ?></p>
    </div>
</div>
