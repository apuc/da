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