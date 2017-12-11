<?php
$this->title = $meta['main_page_meta_title']->value;
$this->registerMetaTag( [
    'name'    => 'description',
    'content' => $meta['main_page_meta_descr']->value,
] );
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/jquery-ui-1.12.1/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>


<!-- open home-content__wrap -->
<div class="home-content__wrap">
    <!-- СЛАЙДЕР ГЛАВНАЯ СТРАНИЦА -->
    <?= \frontend\widgets\MainSlider::widget(); ?>
    <?= \frontend\modules\mainpage\widgets\ShowHotThemeNews::widget()?>


    <!-- ПОДПИСАТЬСЯ ГЛАВНАЯ СТРАНИЦА -->
    <?php
        if ($this->beginCache('subscribe_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
            echo \frontend\widgets\Subscribe::widget();
        $this->endCache();
        }
    ?>

</div>
<!-- close home-content__wrap -->

<!-- ЛЕНТА ДНЯ -->
<?= \frontend\widgets\DayFeed::widget(); ?>

<?= \frontend\modules\mainpage\widgets\ShowRightSidebar::widget(); ?>
<!-- home-content__sidebar -->
<?php
echo \frontend\widgets\MainPopularSlider::widget();


    echo \frontend\widgets\MainPosters::widget();


echo \frontend\widgets\StreamMain::widget();

echo \frontend\widgets\CompanyMain::widget();



echo \frontend\widgets\MainPhotos::widget();





