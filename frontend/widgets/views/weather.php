<?php ?>
<div class="home-content__sidebar_weather">

    <h3>погода</h3>
    <div class="home-content__sidebar_weather__slider">
        <?php foreach ($weather as $day => $item): ?>
            <div class="home-content__sidebar_weather__slider--item">
                <div class="home-content__sidebar_weather__slider--img">
                    <img src="/theme/portal-donbassa/img/home-content/photo-img-1.png" alt="">
                </div>

                <p class="city">Донецк</p>

                <p class="date"><?= \common\classes\WordFunctions::getDayOfWeekAndDayOfMonth($day);?></p>

                <p class="weather-val"><?= \common\classes\WordFunctions::getWeatherArray()[$item['header_img']];?></p>

                <div class="home-content__sidebar_weather__slider--icon">
                                <span class="icon">
                                    <img src="/theme/portal-donbassa/img/header_weather/<?= $item['header_img']; ?>.png" alt="">
                                </span>
                    <span class="degrees"><?= $item['header_temp'];?>°C</span>
                </div>

                <div class="home-content__sidebar_weather__slider--content">

                    <p><?= $item['header_temp'];?>°C</p>

                    <p><?= \common\classes\WordFunctions::getDayOfWeekAndDayOfMonth($day);?></p>

                </div>

            </div>
            <?php endforeach; ?>
    </div>
</div>
