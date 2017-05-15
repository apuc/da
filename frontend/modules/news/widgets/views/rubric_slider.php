<section id="go_rubricator" class="rubrick-slider">
    <div class="container">
        <button class="toggle_mnu__rubrick">
        <span class="sandwich">
          <span class="sw-topper"></span>
          <span class="sw-bottom"></span>
          <span class="sw-footer"></span>
        </span>
        </button>
        <div class="rubrick-slider__wrap">
            <?php use yii\helpers\Url;

            foreach ($newsArray as $title => $news):
                if (!empty($news[0])):
                    $firstNew = $news[0];
                    ?>
                    <div class="rubrick-slider__item ">
                        <div class="rubrick-slider__title">
                            <h2><?= $title; ?></h2>
                            <p><?= $firstNew->categoryNewsRelations[0]->cat->descr; ?></p>
                            <a href="<?= Url::to([
                                '/news/news/category',
                                'slug' => $firstNew->categoryNewsRelations[0]->cat->slug,
                            ]); ?>" class="go-rubrick">перейти в рубрику</a>
                        </div>
                        <div class="rubrick-slider__item_wrap">
                            <div class="item__big">
                                <img src="<?= $firstNew->photo; ?>" alt="">
                                <div class="item__big_content">
                                    <h4><a href="<?= Url::to([
                                            '/news/default/view',
                                            'slug' => $firstNew->slug,
                                        ]); ?>"><?= $firstNew->title; ?></a></h4>
                                    <span class="hour-ago"><?= \common\classes\WordFunctions::FullEventDate($firstNew->dt_public); ?></span>
                                    <div class="item__content_panel">
                                        <a href=""><span class="comments-icon"></span>31</a>
                                        <span><small class="view-icon"></small> <?= $firstNew->views; ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php foreach ($news as $key => $new):
                                if ($key == 0) {
                                    continue;
                                }
                                ?>
                                <div class="item__small">
                                    <img src="<?= $new->photo; ?>" alt="">
                                    <div class="item__small_content">
                                        <span class="hour-ago"><?= \common\classes\WordFunctions::FullEventDate($new->dt_public); ?></span>
                                        <div class="item__content_panel">
                                            <a href=""><span class="comments-icon"></span>31</a>
                                            <span><small class="view-icon"></small> <?= $new->views; ?></span>
                                        </div>
                                        <h4><a href="<?= Url::to([
                                                '/news/default/view',
                                                'slug' => $firstNew->slug,
                                            ]); ?>"><?= $new->title; ?></a></h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php
                endif;
            endforeach; ?>

        </div>
        <div id="dotscustom">
            <?php
            foreach ($newsArray as $title => $new): ?>
                <div><?= $title; ?></div>
            <?php endforeach; ?>
        </div>
    </div>


</section>
