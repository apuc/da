<sectiom class="banner-top">
    <div class="container">
        <img src="<?= $mainBannerPoster->poster_image; ?>" alt="">
        <div class="banner-top__wrap">
            <h2><?= $mainBannerPoster->main_poster_title; ?>"</h2>
            <p><?= $mainBannerPoster->main_poster_subtitle; ?></p>
            <!--<span class="banner-date"><?/*= $mainBannerPoster->main_poster_substrate; */?></span>-->
            <?php if(Yii::$app->user->isGuest): ?>
                <a class="banner-date" href="<?= \yii\helpers\Url::to(['/user/register'])?>">Расказать городу</a>
            <?php else: ?>
                <a class="banner-date" href="<?= \yii\helpers\Url::to(['/poster/default/create'])?>">Расказать городу</a>
            <?php endif; ?>
        </div>
    </div>
</sectiom>