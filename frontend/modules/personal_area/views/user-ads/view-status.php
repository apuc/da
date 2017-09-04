<?php //\common\classes\Debug::prn($status);

if ($status == 1):?>
    <div class="cabinet__company-box--mess">
        <span>Объявление</span>
        <span>на модерации</span>
        <p>Ваше объявление будет опубликовано как только пройдет модерацию</p>
    </div>
<?php endif;

if ($status == 2):?>
    <div class="cabinet__company-box--mess2">
        <span>ОПУБЛИКОВАНО</span>
        <p>Ваше объявление уже размещено на нашем сайте
            <!--<a >RUB-ON.RU</a>-->
        </p>
    </div>
<?php endif;

if ($status == 6):?>
    <div class="cabinet__company-box--mess2">
        <span>Объявление</span>
        <span>на модерации</span>
        <p>Ваше объявление не прошло модерацию
            <!--<a >RUB-ON.RU</a>-->
        </p>
    </div>
<?php endif;
