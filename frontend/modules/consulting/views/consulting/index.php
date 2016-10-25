<section class="content">
    <div class="container">
        <div class="consulting">
            <div class="consulting-items">
                <?php foreach ($consulting as $item) :?>
                    <div class="consulting-item">
                        <img class="consulting-icon" src="<?=$item->icon ; ?>" alt="">
                        <h4><?= $item->title; ?></h4>
                        <span class="line"></span>
                        <a href="#" class="link">Подробнее</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
