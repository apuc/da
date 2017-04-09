<div class="interested">
    <h3>Вас может заинтересовать</h3>
    <div class="afisha-events__wrap">
        <?php if (is_array($interestedInPosters) && !empty($interestedInPosters)) : ?>
            <?php foreach ($interestedInPosters as $interestedInPoster) : ?>
            <a href="" class="interested__item">
                <img src="<?= $interestedInPoster->thumb; ?>" alt="">
                <div class="interested__item_title">
                    <span><?= $interestedInPoster->count; ?></span>
                    <h4><?= $interestedInPoster->title; ?></h4>
                </div>
            </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <a href="" class="show-more">загрузить БОЛЬШЕ</a>
</div>
