<section class="header-second-menu">
    <div class="container">
        <div class="second-menu-wrapper">
            <ul class="menu-lvl-1">
                <?php foreach ($categoryTopArr as $key => $item): ?>
                    <?php
                        if($key == 'catId'){break;}
                    ?>
                    <li>
                        <a href="#"><?= $item['title']; ?></a>
                        <div class="submenu-wrapper">
                            <ul class="owl-carousel owl-header-second-menu">
                        <?php foreach ($item['childs'] as $value): ?>
                                <li>
                                    <a href="#">
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
                                <a href="#"><?= $item['title']; ?></a>
                                <?php if(isset($item['childs'])): ?>
                                    <ul class="menu-lvl-2">
                                    <?php foreach ($item['childs'] as $value): ?>
                                        <li><a href="#"><?= $value['title']; ?></a></li>
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