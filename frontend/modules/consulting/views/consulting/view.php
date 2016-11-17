<?php use yii\helpers\Url;
$this->title =  $consulting->title;
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
            <?php if($consulting->about_company): ?>
                <li>
                    <a href="<?= Url::to( [ "/consulting/consulting/view", 'slug' => $consulting->slug ] ); ?>" class="active"><span
                            class="marker"></span>О компании</a>
                </li>
            <?php endif; ?>
            <?php if($consulting->documents): ?>
                <li>
                    <a class="parent" href="<?= Url::to( [ '/documents/' . $consulting->slug ] ) ?>"><span class="marker"></span><?= $consulting->title_digest;?></a>
                </li>
            <?php endif; ?>
            <?php if($consulting->posts): ?>
                <li>
                    <a class="parent" href="<?= Url::to( [ '/posts/' . $consulting->slug ] ) ?>"><span class="marker"></span>Статьи</a>
                </li>
            <?php endif; ?>
            <?php if($consulting->faq): ?>
            <li>
                <a class="" faq-id="0" href="<?= Url::to( [ '/faq/' . $consulting->slug ] ) ?>"><span
                        class="marker"></span>Вопрос / ответ</a>
            </li>
            <?php endif; ?>
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
