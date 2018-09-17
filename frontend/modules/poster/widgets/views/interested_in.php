<?php if (is_array($interestedInPosters) && !empty($interestedInPosters)) : ?>
    <div class="interested">
        <h3>Вас может заинтересовать</h3>
        <div class="afisha-events__wrap js-interested-cats">
            <?php foreach ($interestedInPosters as $key => $interestedInPoster) : ?>
                <a href="" class="interested__item" data-interested-index="<?= $key; ?>">
                    <img src="<?= $interestedInPoster->thumb; ?>" alt="">
                    <div class="interested__item_title">
                        <span><?= $interestedInPoster->count; ?></span>
                        <h4><?= $interestedInPoster->title; ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php if ($interestedInPostersCount > 4) : ?>
            <a href="" class="show-more js-interested-in-more">загрузить БОЛЬШЕ</a>
        <?php endif; ?>
        <div class="afisha-events__wrap js-interested-posters" style="display: none;">

        </div>
        <a href="" class="show-more js-interested-posters-back" style="display: none;">Назад</a>
    </div>
<?php endif; ?>