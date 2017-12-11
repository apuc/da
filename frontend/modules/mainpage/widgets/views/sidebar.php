<?php
?>

<div class="home-content__sidebar">

    <?php
    if ($this->beginCache('sidebar_discussed_widget', ['duration' => Yii::$app->params['hours-for-cache']])) {
        ?>
        <!-- start sidebar-discussed-russ.html-->
        <div class="sidebar-discussed">
            <?php foreach ($news as $key => $val): ?>
                <?php if ($key == 0): ?>
                    <div class="sidebar-discussed__big-item">

                        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['news']->slug]); ?>">
                            <h2>САМОЕ ОБСУЖДАЕМОЕ</h2>
                            <div class="sidebar-discussed__big-item__img">
                                <img src="<?= $val['news']['photo'] . '?width=300' ?>" alt="">
                            </div>
                            <div class="sidebar-discussed__big-item__text">
                                <p>
                                    <?= \yii\helpers\StringHelper::truncate(strip_tags($val['news']['content']), 400, '...'); ?>
                                </p>
                            </div>
                            <div class="sidebar-discussed__big-item__comments">
                                <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['news']->slug]); ?>">
                                    <img src="/theme/portal-donbassa/img/russ-home/comment.svg" alt="">
                                    <span><?= count($val['news']['comments']) ?></span>
                                </a>
                            </div>
                        </a>

                    </div>
                <?php else: ?>
                    <div class="sidebar-discussed__small-item">
                        <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['news']->slug]); ?>">
                            <div class="sidebar-discussed__small-item__img">
                                <img src="<?= $val['news']['photo'] . '?width=155' ?>" alt="">
                            </div>
                            <div class="sidebar-discussed__small-item__text">
                                <p>
                                    <?= $val['news']->title; ?>
                                </p>
                                <div class="sidebar-discussed__small-item__text__comments">
                                    <a href="<?= \yii\helpers\Url::to(["/news/default/view", "slug" => $val['news']->slug]); ?>">
                                        <img src="/theme/portal-donbassa/img/russ-home/comment.svg" alt="">
                                        <span><?= count($val['news']['comments']) ?></span>
                                    </a>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <?php
        $this->endCache();
    }
    ?>
    <!--<div class="guests-city">
        <h2>ГОСТЯМ ГОРОДА</h2>
        <div class="guests-city__links">
            <a href="#">Гостиницы /</a>
            <a href="#">Мотели /</a>
            <a href="#">Хостелы</a>
        </div>
        <div class="guests-city__learn-more">
            <div class="guests-city__learn-more--price">
                <span>от 999 руб./сутки</span>
                <span> до 2599 руб./сутки</span>
            </div>
            <a href="#" class="guests-city__learn-more--button">подробнее</a>
        </div>
    </div>-->
    <div class="social-news-rus">
        <h2>социальные новости</h2>
        <div class="social-news-rus__public">
            <a href="<?= \yii\helpers\Url::to(['/stream/default/view', 'slug' => $post[0]->slug]) ?>">
                <div class="social-news-rus__public__avatar">
                    <div class="img">
                        <img src="<?= $post[0]->group->getPhoto() ?>" alt="">
                    </div>
                    <div>
                        <h3><?= $post[0]->group->name ?></h3>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="social-news-rus__public__text">
                    <p>
                        <?= $post[0]->title; ?>
                    </p>
                </div>
                <div class="social-news-rus__public__img">
                    <?php if (!empty($post[0]->photo)): ?>
                        <img src="<?= $post[0]->photo[0]->getLargePhoto() . '?width=300' ?>" alt="">
                    <?php elseif (!empty($post[0]->gif)): ?>
                        <img src="<?= $post[0]->gif[0]->getLargePreview() . '?width=300' ?>" alt="">
                    <?php endif; ?>
                </div>
            </a>
        </div>
    </div>


    <!-- end sidebar-discussed-russ.html-->

</div>