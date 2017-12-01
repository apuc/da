<?php
use yii\helpers\Url;
?>
<section class="header-second-menu">
    <div class="container">
        <div class="second-menu-wrapper">
            <ul class="menu-lvl-1">
                <?php
                foreach ($categoryTopArr as $key => $item): ?>
                    <?php
                        if($key == 'catId'){break;}
                    ?>
                    <li>
                        <a href="<?= Url::to(['/company/company/view-category', 'slug' => $item['slug']]) ?>"><?= $item['title']; ?></a>
                        <div class="submenu-wrapper">
                            <ul class="owl-carousel owl-header-second-menu">
                        <?php foreach ($item['childs'] as $value): ?>
                                <li>
                                    <a href="<?= Url::to(['/company/company/view-category', 'slug' => $value['slug']]) ?>">
                                        <img src="<?= $value['icon']; ?>" alt="">
                                        <span><?= $value['title']; ?></span>
                                    </a>
                                </li>
                        <?php endforeach; ?>
                            </ul>
                        </div>
                    </li>
                <?php endforeach; ?>

                <li class="yet">
                    <a href="#" class="actives">Еще</a>
                    <div class="submenu-wrapper-yet">
                        <ul>
                            <?php foreach ($categoryAllArr as $item): ?>
                            <li>
                                <a href="<?= Url::to(['/company/company/view-category', 'slug' => $item['slug']]) ?>"><?= $item['title']; ?></a>
                                <?php if(isset($item['childs'])): ?>
                                    <ul class="menu-lvl-2">
                                    <?php foreach ($item['childs'] as $value): ?>
                                        <li>
                                            <a href="<?= Url::to(['/company/company/view-category', 'slug' => $value['slug']]) ?>">
                                                <?= $value['title']; ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>


<!-- start mobile-second-menu.html-->
<section class="button-second-menu">
    <div class="container">
        <a class="button-second-menu" href="#"><i class="fa fa-list" aria-hidden="true"></i> Меню категорий</a>
    </div>
</section>
<section class="mobile-second-menu">
    <div class="mobile-second-menu__header">
        <div class="header-m-arrow"></div><span>Каталог</span>
        <a href="#" class="header-close"><img src="/theme/portal-donbassa/img/second-menu/close.svg" alt=""></a>
    </div>
    <div class="mobile-second-menu__wrap">
        <ul class="mobile-menu-lvl-1">
            <?php foreach ($categoryMob as $item): ?>
                <li data-menu-id="<?= $item['id']; ?>">
                    <a href="#">
                        <img src="<?= $item['icon']; ?>" alt=""><?= $item['title']; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php foreach ($categoryMob as $item): ?>
            <?php if(isset($item['childs'])): ?>
                <ul class="mobile-menu-lvl-2" data-menu-id="<?= $item['id']; ?>">
                    <?php foreach ($item['childs'] as $val): ?>
                        <li>
                            <a href="<?= Url::to(['/company/company/view-category', 'slug' => $val['slug']]) ?>">
                                <?= $val['title']?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        <?php endforeach; ?>


    </div>

</section>
<!-- end mobile-second-menu.html-->