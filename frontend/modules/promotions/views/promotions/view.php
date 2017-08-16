<? $this->title = $model->title ?>

<section class="business">

    <div class="container">

        <div class="business__wrapper">

            <div class="stock__box business__single-content">

                <!--<form action="" class="search-panel__form">

                    <input class="search-panel__field" type="text" placeholder="Крым">
                    <input type="submit" id="search-form-submit" class="search-panel__submit" value="Найти">

                </form>-->

                <?// \common\classes\Debug::prn($model) ?>

                <h3 class="stock__title"><?= $model->title?></h3>

                <div class="stock__content--right">

                    <div class="stock__sm-item--header">

                        <a href="<?= \yii\helpers\Url::to(['/company/company/view', 'slug' => $model->company['slug']])?>" class="title"><?= $model->company['name'] ?></a>

                        <span class="views"><?= $model->view?></span>

                    </div>

                    <div class="stock__content--banner">
                        <img src="<?= $model->photo?>" alt="">
                    </div>

                </div>

                <div class="stock__content--left">

                    <div class="stock__sm-item--time">

                        <p><?= $model->dt_event?></p>

                    </div>

                    <a href="#" class="show-more">в избранное</a>

                </div>

                <div class="stock__content--descr">

                    <h3>Описание акции</h3>

                    <p><?= $model->descr?></p>

                    <h3>Контакты</h3>

                    <p><?= $model->company['name']?></p>

                    <? if(!empty($phones)): ?>

                        <? foreach ($phones as $phone): ?>
                            <p><?= $phone->phone?></p>
                        <?endforeach;?>
                        <!--<p>+38 (066) 702-91-22</p>
                        <p>+38 (063) 811-45-25</p>-->
                    <? elseif(!empty($model->company['phone'])): ?>
                        <? $phones = explode(' ', $model->company['phone']) ?>
                    <? foreach ($phones as $phone): ?>
                        <p><?= $phone?></p>
                    <?endforeach;?>
                    <? endif; ?>

                </div>

            </div>



            <!--<div class="business__sidebar stock" id="#business-sidebar">

                <h3>Лучшие предложения</h3>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит <small>с 01.01.2017</small> </p>

                        </div>

                    </div>
                </a>

                <a href="#" class="stock__item">
                    <div class="stock__item_visible">
                        <div class="thumb">
                            <img src="img/home-content/stock-pic-1.png" alt="">
                            <span class="time-icon"></span>
                        </div>
                        <div class="stock__item_label">
                            <p>Грандиозное снижение цен на шкафы - 20%</p>
                        </div>
                        <div class="content">
                            <p> Акция проходит <small>с 01.01.2017</small> </p>

                        </div>

                    </div>
                </a>

            </div>-->
            <?= \frontend\widgets\ShowRightRecommend::widget(); ?>
        </div>

    </div>

</section>

