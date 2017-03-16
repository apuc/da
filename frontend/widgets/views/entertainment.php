<div class="home-content__wrap_enterprises">
    <div class="title">
        <h3 class="main-title">Где отдохнуть</h3>
        <a href=""><span class="add-icon"></span>Зарегистрировать заведение</a>
    </div>
    <div class="enterprises__wrap">
        <?php foreach ($companySmall as $item): ?>
            <a href="" class="item-small">
                <div class="thumb">
                    <img src="<?= $item->photo; ?>" alt="">
                </div>
                <div class="content">
                    <h4><?= $item->name; ?></h4>
                    <!--<p>--><? //= $item->address;?><!--</p>-->
                    <p><?= explode(';', $item->phone)[0]; ?></p>
                </div>
            </a>
        <?php endforeach; ?>
        <a href="" class="item-large">
            <div class="thumb">
                <img src="<?= $companyBig->photo; ?>" alt="">
            </div>
            <div class="content">
                <h4><?= $companyBig->name; ?></h4>
                <!--<p>--><? //= $companyBig->address;?><!--</p>-->
                <p><?= explode(';', $companyBig->phone)[0]; ?></p>
            </div>
        </a>
        <!-- close item -->
        <a href="" class="show-enterprises">смотреть все заведения<span class="red-arrow"></span></a>
    </div>
</div>