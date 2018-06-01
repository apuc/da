<nav class="header__navigation">

    <button class="toggle_mnu">

              <span class="sandwich">
                <span class="sw-topper"></span>
                <span class="sw-bottom"></span>
                <span class="sw-footer"></span>
              </span>

    </button>

    <ul class="header-menu">
        <li><a href="/">Info Pro</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/all-new'])?>">Чтиво</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/all-company'])?>">Компании</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/board/default'])?>">Объявления</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/all-poster'])?>">Афиша</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/promotions'])?>">Акции</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/stream'])?>">В соцсетях</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/finance'])?>">Биржа</a></li>
        <li><a href="<?= \yii\helpers\Url::to(['/dnr'])?>">ДНР</a></li>
    </ul>

    <!--<div class="header-menu__sub">

        <button class="header-menu__sub_button">
            <span></span>
            <span></span>
            <span></span>
        </button>

        <ul class="header-menu__sub_list">
            <li><a href="<?/*= \yii\helpers\Url::to(['/consulting'])*/?>">Консультации</a></li>

            <li><a href="">Пункт3</a></li>
            <li><a href="">Пункт4</a></li>
            <li><a href="">Пункт5</a></li>
        </ul>
    </div>-->
</nav>