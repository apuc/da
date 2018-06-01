<?php
/**
 * @var int $userRegion
 * @var array $regionList
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

?>

    <section class="header">
    <div class="container">

<?php if (Yii::$app->controller->module->id == 'mainpage'): ?>
    <h1 class="header-logo">
        <img src="/theme/portal-donbassa/img/logo.png" alt="">
    </h1>
<?php else: ?>
    <a href="/" class="header-logo">

        <img src="/theme/portal-donbassa/img/logo.png" alt="">
    </a>
<?php endif; ?>
    <div class="header-ipanel">
    <div class="select">
<?= Html::dropDownList(
    'regionSelectUser',
    $userRegion,
    ArrayHelper::map($regionList, 'id', 'name'),
    ['prompt' => 'Все регионы', 'id' => 'regionSelectUser']
); ?>
<?php
if ($this->beginCache('show_header_widget_end', ['duration' => Yii::$app->params['hours-for-cache']])) {
    ?>
    </div>
    <!-- <?/*= \frontend\widgets\WeatherHeader::widget(); */ ?>
                --><?/*= ExchangeRates::widget() */ ?>
    <div class="fix-button-head" id="fix-button-head">
        <i class="fa fa-plus" aria-hidden="true"></i>
        <span>Добавить на сайт</span>
        <ul class="list">
            <li>
                <a href="<?= \yii\helpers\Url::to(['/company/company/create']); ?>">
                    <img src="/theme/portal-donbassa/img/icons/tag-hover-icon.png" alt="">
                    Предприятие
                </a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/news/news/create']) ?>">
                    <img src="/theme/portal-donbassa/img/icons/stack-hover-icon.png" alt="">
                    Чтиво
                </a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/poster/default/create']) ?>">
                    <img src="/theme/portal-donbassa/img/icons/calendar-cabinet--hover-icon.png" alt="">
                    Афиши
                </a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/promotions/promotions/create']) ?>">
                    <img src="/theme/portal-donbassa/img/icons/bar-graph-hover-icon.png" alt="">
                    Акция
                </a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/board/default/create']) ?>">
                    <img src="/theme/portal-donbassa/img/icons/add-icon.png" alt="">
                    Объявления
                </a>
            </li>
            <li>
                <a href="<?= \yii\helpers\Url::to(['/shop/products/create']) ?>">
                    <img src="/theme/portal-donbassa/img/icons/shopping-cart-hover.png" alt="">
                    Товары
                </a>
            </li>
        </ul>
    </div>
    <form action="<?= Url::to(['/search/search/index']) ?>" method="get">
    <input class="search-input" type="text" placeholder="Поиск" name="request">
    <!--<input type="hidden" name="_csrf" value="<?/*= Yii::$app->request->csrfToken; */
    ?>">-->
    <?php
    $this->endCache();
}
?>
<?php if (Yii::$app->user->isGuest): ?>
    <a href="<?= Url::to(['/user/login']) ?>">
        <span class="autoriz-icon"></span>
        авторизация
    </a>
<?php else: ?>
    <a id="authorized-user-profile" href="<?= Url::to(['/personal-area']) ?>">
        <span class="autoriz-icon"></span>
        <?= Yii::$app->user->identity->username; ?>
    </a>

    <div class="currency-panel__submenu">
        <a href="<?= Url::to('/personal-area') ?>">ПРОФИЛЬ</a>
        <a href="<?= Url::to(['/personal-area/user-news']) ?>">ЧТИВО</a>
        <a href="<?= Url::to(['/personal-area/user-poster']) ?>">АФИШИ</a>
        <a href="<?= Url::to(['/personal-area/user-promotions']) ?>">АКЦИИ</a>
        <a href="<?= Url::to(['/personal-area/user-company']) ?>">ПРЕДПРИЯТИЯ</a>
        <a href="<?= Url::to(['/personal-area/user-comments']) ?>">КОМЕНТАРИИ</a>
        <!--<a href="#">Настройки</a>-->
        <a data-method="post" href="<?= Url::to(['/site/logout']) ?>">выход</a>
    </div>
<?php endif; ?>
<?php
if ($this->beginCache('show_header_widget_menu', ['duration' => Yii::$app->params['hours-for-cache']])) {
    ?>

    </form>
    </div>
    <?php echo \frontend\widgets\MainMenu::widget() ?>

    </div>
    </section>

    <?php
    $this->endCache();
}
?>