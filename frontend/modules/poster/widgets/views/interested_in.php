<?php if (is_array($interestedInPosters) && !empty($interestedInPosters)) : ?>
    <div class="interested">
        <h3>Вас может заинтересовать</h3>
        <div class="afisha-events__wrap">
            <?php foreach ($interestedInPosters as $interestedInPoster) : ?>
                <a href="" class="interested__item">
                    <img src="<?= $interestedInPoster->thumb; ?>" alt="">
                    <div class="interested__item_title">
                        <span><?= $interestedInPoster->count; ?></span>
                        <h4><?= $interestedInPoster->title; ?></h4>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php if ($interestedInPostersCount > 4) : ?>
            <a href="" class="show-more js-interested-in-more" csrf-token="<?= Yii::$app->request->getCsrfToken() ?>">загрузить БОЛЬШЕ</a>
        <?php endif; ?>
    </div>
<?php endif; ?>