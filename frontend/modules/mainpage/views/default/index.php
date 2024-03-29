<?php
$this->title = $meta['main_page_meta_title']->value;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $meta['main_page_meta_descr']->value,
]);
$this->registerJsFile('/theme/portal-donbassa/js/jquery-2.1.3.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile('/js/jquery-ui-1.12.1/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

?>
<?=
// ПОИСК ПРОПАВШИХ ЛЮДЕЙ
\frontend\modules\mainpage\widgets\ShowSearchMissingPeopleForm::widget();
?>

    <section class="home-content">
        <div class="container">
            <!-- open home-content__wrap -->
            <div class="home-content__wrap">
                <!-- СЛАЙДЕР ГЛАВНАЯ СТРАНИЦА -->
                <?= \frontend\widgets\MainSlider::widget(); ?>

                <!-- ГОРЯЧИЕ ТЕМЫ -->
                <?= \frontend\modules\mainpage\widgets\ShowHotThemeNews::widget(['useReg' => $useReg]) ?>
                <!-- ПОДПИСАТЬСЯ ГЛАВНАЯ СТРАНИЦА -->
                <?php
                //if ($this->beginCache('subscribe_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
                echo \frontend\widgets\Subscribe::widget();
                //$this->endCache();
                //}
                ?>
            </div>
            <!-- ЛЕНТА ДНЯ -->
            <?= \frontend\widgets\DayFeed::widget(['useReg' => $useReg]); ?>
            <div class="home-content__sidebar">
                <?= \frontend\widgets\Consultation::widget(); ?>
                <?= \frontend\modules\mainpage\widgets\EditorChoice::widget(); ?>
                <!--        --><?//= \frontend\modules\mainpage\widgets\ShowRightSidebar::widget(); ?>
            </div>
            <!-- close home-content__wrap -->


            <!-- home-content__sidebar -->
        </div>
    </section>
<?php
//echo \frontend\widgets\MainPopularSlider::widget(['useReg' => $useReg]);


echo \frontend\widgets\MainPosters::widget(['useReg' => $useReg]);


echo \frontend\widgets\StreamMain::widget();

echo \frontend\widgets\CompanyMain::widget(['useReg' => $useReg]);


echo \frontend\widgets\MainPhotos::widget(['useReg' => $useReg]);





