<?php

use yii\helpers\Url;

?>
<section class="news-slider-index">
    <div class="container">
        <h3 class="main-title">популярное чтиво</h3>
        <span class="separator"></span>
        <?php /*\common\classes\Debug::prn(array_combine(range(1, count($news)), $news))*/?>
        <div class="news-slider-wrap">
            <?php
            $slider1 = '';
            $slider2 = '';
            $slider3 = '';
            $slider4 = '';
            foreach ($news as $key=> $item):
                //\common\classes\Debug::prn($key);
                if(empty($item)){ break; }

                $url = Url::to(['/news/default/view', 'slug' => $item->slug]);
                $img = $item->photo  . '?width=600';
                $view = $item->views;
                $comments = \common\models\db\News::getCommentsCount($item->id);
                $share = \frontend\widgets\Share::widget([
                    'url' => \yii\helpers\Url::base(true) . '/news/' . $item->slug,
                    'title' => $item->title,
                    'description' => $item->content,
                ]);
                $title = $item->title;
                $content = strip_tags($item->content);

                $sliderOne = "<a href=\"$url\" class=\"item\">
                        <img src=\"$img\" alt=\"\">
                        <div class=\"content-item\">
                            <div class=\"content-row\">

                                <span>Чтиво</span>
                                <span><small class=\"view-icon\"></small> $view</span>
                                <span>
                                    <small class=\"comments-icon\"></small>
                                    $comments</span>
                                $share
                            </div>
                            <div class=\"item__info\">
                                <h4>$title</h4>
                                <p>$content</p>
                            </div>

                        </div>
                    </a>";

                ?>
                <?php if($key%4 == 0 ){
                    $slider1 .= $sliderOne;
                }?>
                <?php if($key%4 == 1 ){
                    $slider2 .= $sliderOne;
                }?>

                <?php if($key%4 == 2 ){
                    $slider3 .= $sliderOne;
                }?>

                <?php if($key%4 == 3 ){
                    $slider4 .= "<a href=\"$url\" class=\"item\">
                        <img
                                src=\"$img\" alt=\"\">
                    </a>";
                }?>
            <?php endforeach; ?>

            <div class=" js-carousel-1 owl-carousel" id="sync1">

                <?= $slider1; ?>
            </div>
            <div class="js-carousel-2 owl-carousel" id="sync2">

                <?= $slider2; ?>
            </div>
            <div class="js-carousel-3 owl-carousel">
                <?= $slider3; ?>

            </div>
            <div class="js-carousel-4 owl-carousel">
                <?= $slider4?>
            </div>
            <div class="slider-nav">
                <a href="#" class="customPrevBtn"></a>
                <a href="#" class="customNextBtn"></a>
            </div>
        </div>
        <div class="news-slider-index-panel">
            <h3>Важное чтиво дня</h3>
            <div class="buttons-wrap">
                <a href="<?= \yii\helpers\Url::to(['/site/design']); ?>">подписаться</a>
                <a href="<?= \yii\helpers\Url::to(['/news/news']) ?>">посмотреть больше</a>
            </div>
        </div>
    </div>
</section>