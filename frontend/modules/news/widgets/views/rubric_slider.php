<?php
use common\classes\WordFunctions;
use yii\helpers\Url;
?>

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
            <?php foreach ($newsArray as $news): ?>
                <div class="rubrick-slider__item ">
                    <div class="rubrick-slider__title">
                        <h2><?= $news[0]['titlecat']; ?></h2>
                        <p><?= $news[0]['metadescrcat']; ?></p>
                        <a href="<?= Url::to([
                            '/news/news/category',
                            'slug' => $news[0]['slugcat'],
                        ]); ?>" class="go-rubrick">перейти в рубрику</a>
                    </div>

                    <div class="rubrick-slider__item_wrap">
                        <a href="<?= Url::to([
                            '/news/default/view',
                            'slug' => $news[0]['slugnews'],
                        ]); ?>" class="item__big">
                            <?php if(stristr($news[0]['photonews'], 'http')):?>
                                <img src="<?= $news[0]['photonews']; ?>" alt="">
                            <?php else: ?>
                                <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($news[0]['photonews']); ?>" alt="">
                            <?php endif;?>
                            <div class="item__big_content">
                                <h4><?= $news[0]['titlenews']; ?></h4>
                                <span class="hour-ago"><?= WordFunctions::FullEventDate($news[0]['dt_public']); ?></span>
                                <div class="item__content_panel">
                                    <span><small class="view-icon"></small><?= $news[0]['views']; ?></span>
                                    <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($news[0]['idnews']); ?></span>
                                </div>
                            </div>
                        </a>

                        <?php foreach ($news as $key => $new):
                            if ($key == 0) {
                                continue;
                            }
                            ?>
                            <a href="<?= Url::to([
                                '/news/default/view',
                                'slug' => $new['slugnews'],
                            ]); ?>" class="item__small">
                                <?php if(stristr($new['photonews'], 'http')):?>
                                    <img src="<?= $new['photonews']; ?>" alt="">
                                <?php else: ?>
                                    <img src="<?= \common\models\UploadPhoto::getImageOrNoImage($new['photonews']); ?>" alt="">
                                <?php endif;?>
                                <div class="item__small_content">
                                    <span class="hour-ago"><?= WordFunctions::FullEventDate($new['dt_public']); ?></span>
                                    <div class="item__content_panel">
                                        <span><small class="view-icon"></small><?= $new['views']; ?></span>
                                        <span><small class="comments-icon"></small><?= \common\models\db\News::getCommentsCount($new['idnews']); ?></span>
                                    </div>
                                    <h4><?= $new['titlenews']; ?></h4>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div id="dotscustom">
            <?php
            foreach ($newsArray as $new): ?>
                <div><?= $new[0]['titlecat']; ?></div>
            <?php endforeach; ?>
        </div>
    </div>


</section>
